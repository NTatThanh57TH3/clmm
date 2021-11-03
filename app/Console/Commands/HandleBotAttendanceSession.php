<?php

namespace App\Console\Commands;

use App\Http\Repositories\AttendanceSessionRepository;
use App\Models\AttendanceSession;
use App\Models\AttendanceSetting;
use App\Models\LichSuChoiMomo;
use App\Models\Setting;
use App\Models\UserAttendanceSession;
use App\Traits\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandleBotAttendanceSession extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:handle-bot-attendance-session';

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
        $config    = $this->attendanceSessionRepository->getAttendanceSetting();
        $startTime = isset($config['start_time']) ? Carbon::parse($config['start_time']) : Carbon::parse(TIME_START_ATTENDANCE);
        $endTime   = isset($config['end_time']) ? Carbon::parse($config['end_time']) : Carbon::parse(TIME_END_ATTENDANCE);
        $now       = Carbon::now();
        if ($now->between($startTime, $endTime)) {
            try {
                $attendanceSetting        = $this->attendanceSessionRepository->getAttendanceSetting();
                $attendanceSessionCurrent = AttendanceSession::where('date', Carbon::today()->toDateString())
                    ->orderBy('created_at', "DESC")
                    //                    ->where('status', STATUS_ACTIVE)
                    ->first();
                $usersAttendance          = $this->attendanceSessionRepository->getUsersAttendanceSession($attendanceSessionCurrent);
                $phoneUserAttendance      = $usersAttendance->pluck('phone')->toArray();
                $botRate                  = $attendanceSetting['bot_rate'] ?? 10;
                $bots                     = $this->attendanceSessionRepository->getRandomBotsAttendance($botRate,
                    $phoneUserAttendance);
                $randomNumberTakeBot      = random_int(60, 100);
                $phoneBots                = collect($bots)
                    ->take(round(($randomNumberTakeBot / 100) * count($bots)))
                    ->pluck("phone")
                    ->toArray();
                $botHandled               = [];
                sleep(3);
                for ($i = 0; $i <= 500; $i++) {
                    if (count($botHandled) == count($bots)) {
                        return Command::SUCCESS;
                    }
                    if ($countBot < 50) {
                        $numberBotInsert = random_int(1, 3);
                    } else {
                        $numberBotInsert = random_int(2, 5);
                    }
                    $botsHandling = collect($phoneBots)->take($numberBotInsert)->toArray();
                    foreach ($botsHandling as $index => $phoneBot) {
                        DB::table('users_attendance_session')->insert([
                            'phone'      => $phoneBot,
                            'session_id' => $attendanceSessionCurrent->id,
                        ]);
                        unset($phoneBots[array_search($phoneBot, $phoneBots)]);
                    }
                    $botHandled = array_merge($botHandled, $botsHandling);
                    if ($countBot < 50) {
                        sleep(random_int(2, 5));
                    }else{
                        sleep(random_int(1, 3));
                    }
                }
                var_dump("Xu ly xong luc: ".Carbon::now()->toTimeString());
                return Command::SUCCESS;
            } catch (\Throwable $throwable) {
                Log::info($throwable);
            }
        }
    }

}
