<?php

namespace App\Console\Commands;

use App\Http\Repositories\AttendanceSessionRepository;
use App\Models\AttendanceSetting;
use App\Models\LichSuChoiMomo;
use App\Models\Setting;
use App\Traits\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandleUserWinAttendanceSession extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:handle-user-win-attendance-session';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var \App\Http\Repositories\AttendanceSessionRepository
     */
    protected $attendanceSessionRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->attendanceSessionRepository = new AttendanceSessionRepository();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        var_dump("Bat dau xu ly luc: ".Carbon::now()->toTimeString());
        try {
            $isTurnOn = $this->attendanceSessionRepository->checkTurOnAttendance();
            if ($isTurnOn) {
                $config    = $this->attendanceSessionRepository->getAttendanceSetting();
                $startTime = isset($config['start_time']) ? Carbon::parse($config['start_time']) : Carbon::parse(TIME_START_ATTENDANCE);
                $endTime   = isset($config['end_time']) ? Carbon::parse($config['end_time']) : Carbon::parse(TIME_END_ATTENDANCE);
                $now       = Carbon::now();
                if ($now->between($startTime, $endTime)) {
                    $currentAttendanceSession = $this->attendanceSessionRepository->getCurrentAttendanceSession();
                    $this->attendanceSessionRepository->createNewAttendanceSession($currentAttendanceSession);
                    $randomInt = random_int(1, 10);
                    $billCode  = 'ATTSS-'.bin2hex(random_bytes(3)).'-ME';
                    $amount    = random_int(MONEY_MIN_WIN_ATTENDANCE, MONEY_MAX_WIN_ATTENDANCE);
                    $winRate   = isset($config['win_rate']) ? $config['win_rate'] / 10 : ATTENDANCE_WIN_RATE_DEFAULT;
                    if ($randomInt > $winRate) {
                        $phoneBots = $this->attendanceSessionRepository->getPhoneAttendanceSessionBots();
                        $phoneWin  = $phoneBots[random_int(0, count($phoneBots) - 1)];
                    } else {
                        $phoneWin = $this->handleUserWin($currentAttendanceSession, $billCode, $amount);
                    }
                    $currentAttendanceSession->update([
                        'phone'     => $phoneWin,
                        'amount'    => $amount,
                        'bill_code' => $billCode,
                    ]);
                }
            }
            var_dump("Xu ly xong luc: ".Carbon::now()->toTimeString());

            return Command::SUCCESS;
        } catch (\Throwable $throwable) {
            Log::info($throwable);
        }
    }

    /**
     * @return mixed
     */
    public function getUserLichSuMomo()
    {
        return LichSuChoiMomo::where('created_at', '>=', Carbon::today())->with('accountMomo')->get();
    }

    /**
     * @param $currentAttendanceSession
     * @param  string  $billCode
     * @param  int  $amount
     *
     * @return mixed|null
     * @throws \Exception
     */
    private function handleUserWin($currentAttendanceSession, string $billCode, int $amount)
    {
        $phoneNumber               = new PhoneNumber();
        $usersAttendance           = $this->attendanceSessionRepository->getUsersAttendanceSession($currentAttendanceSession);
        $usersAttendance           = $usersAttendance->transform(function ($userAtten) use ($phoneNumber) {
            $userAtten->phone = $phoneNumber->convert($userAtten->phone);
            return $userAtten;
        });
        $usersMomo                 = $this->getUserLichSuMomo();
        $usersMomo                 = $usersMomo->transform(function ($user) use ($phoneNumber) {
            $user->phone = $phoneNumber->convert($user->sdt);
            return $user;
        })->filter(function ($user) {
            return !is_null($user->accountMomo);
        });
        $usersMomoPhone            = $usersMomo->pluck('phone')->unique()->toArray();
        $usersAttendance           = $usersAttendance->filter(function ($userAttendance) use (
            $usersMomoPhone
        ) {
            return in_array($userAttendance->phone, $usersMomoPhone);
        });
        $phoneUsersAttendance      = $usersAttendance->pluck('phone')->toArray();
        $countPhoneUsersAttendance = count($phoneUsersAttendance) > 0 ? count($phoneUsersAttendance) - 1 : 0;
        $phoneWin                  = $phoneUsersAttendance[random_int(0,
                $countPhoneUsersAttendance)] ?? "*";
        DB::table('lich_su_choi_momos')->insert([
            'sdt'        => $phoneWin,
            'sdt_get'    => $phoneWin,
            'magiaodich' => $billCode,
            'tiencuoc'   => 0,
            'tiennhan'   => $amount,
            'trochoi'    => "DIEM DANH",
            'noidung'    => "DD",
            'ketqua'     => 1,
            'status'     => STATUS_LSMOMO_CHUA_THANH_TOAN,
        ]);
        return $phoneWin;
    }

}
