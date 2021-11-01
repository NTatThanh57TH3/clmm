<?php

namespace App\Console\Commands;

use App\Http\Repositories\AttendanceSessionRepository;
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
        try {
            $attendanceSetting        = $this->attendanceSessionRepository->getAttendanceSetting();
            $attendanceSessionCurrent = $this->attendanceSessionRepository->getDataAttendanceSession()['current'];
            $usersAttendance          = $this->attendanceSessionRepository->getUsersAttendanceSession($attendanceSessionCurrent);
            $phoneUserAttendance      = $usersAttendance->pluck('phone')->toArray();
            $botRate                  = $attendanceSetting['bot_rate'] ?? 10;
            $bots                     = $this->attendanceSessionRepository->getRandomBotsAttendance($botRate, $phoneUserAttendance);
            $phoneBots                = collect($bots)->pluck("phone")->toArray();
            $botHandled               = [];
            for ($i = 0; $i <= 500; $i++) {
                if (count($botHandled) == count($bots)) {
                    continue;
                }
                $numberBotInsert = random_int(1, 5);
                $botsHandle      = collect($phoneBots)->take($numberBotInsert)->toArray();
                foreach ($botsHandle as $index => $phoneBot) {
                    UserAttendanceSession::insert([
                        'phone'      => $phoneBot,
                        'session_id' => $attendanceSessionCurrent->id,
                    ]);
                    unset($phoneBots[array_search($phoneBot, $phoneBots)]);
                }
                $botHandled = array_merge($botHandled, $botsHandle);
                sleep(random_int(2, 10));
            }
            var_dump("Xu ly xong luc: ".Carbon::now()->toTimeString());
            return Command::SUCCESS;
        } catch (\Throwable $throwable) {
            Log::info($throwable);
        }
    }

}
