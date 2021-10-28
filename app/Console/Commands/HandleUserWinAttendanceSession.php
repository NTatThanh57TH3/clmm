<?php

namespace App\Console\Commands;

use App\Http\Repositories\AttendanceSessionRepository;
use App\Models\LichSuChoiMomo;
use App\Traits\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
//        $secondRealTime = $this->attendanceSessionRepository->getSecondsRealtime();
        $startTime = Carbon::parse(TIME_START_ATTENDANCE);
        $endTime   = Carbon::parse(TIME_END_ATTENDANCE);
        $now       = Carbon::now();
        if ($now->between($startTime, $endTime)) {
            $phoneNumber              = new PhoneNumber();
            $currentAttendanceSession = $this->attendanceSessionRepository->getCurrentAttendanceSession();
            $this->attendanceSessionRepository->createNewAttendanceSession($currentAttendanceSession);
            $usersAttendance           = $this->attendanceSessionRepository->getUsersAttendanceSession($currentAttendanceSession);
            $usersAttendance           = $usersAttendance->transform(function($userAtten) use ($phoneNumber) {
                $userAtten->phone = $phoneNumber->convert($userAtten->phone);
                return $userAtten;
            });
            $usersMomo                 = LichSuChoiMomo::where('created_at', '>=', Carbon::today())->get();
            $usersMomo                 = $usersMomo->transform(function($user) use ($phoneNumber) {
                $user->phone = $phoneNumber->convert($user->sdt_get);
                return $user;
            });
            $usersMomoPhone            = $usersMomo->pluck('phone')->unique()->toArray();
            $usersAttendance           = $usersAttendance->filter(function($userAttendance) use ($usersMomoPhone) {
                return in_array($userAttendance->phone, $usersMomoPhone);
            });
            $phoneUsersAttendance      = $usersAttendance->pluck('phone')->toArray();
            $countPhoneUsersAttendance = count($phoneUsersAttendance) > 0 ? count($phoneUsersAttendance) - 1 : 0;
            $phoneWin                  = $phoneUsersAttendance[random_int(0, $countPhoneUsersAttendance)] ?? null;
            $currentAttendanceSession->update([
                'phone'     => $phoneWin,
                'amount'    => random_int(MONEY_MIN_WIN_ATTENDANCE, MONEY_MAX_WIN_ATTENDANCE),
                'bill_code' => 'ATTSS-'.bin2hex(random_bytes(3)).'-ME',
            ]);
        }
        var_dump("Xu ly xong luc: ".Carbon::now()->toTimeString());

        return Command::SUCCESS;
    }

}
