<?php
/**
 *File name : AttendanceSessionRepository.php / Date: 10/26/2021 - 9:39 PM
 *Code Owner: Thanhnt/ Email: Thanhnt@omt.com.vn/ Phone: 0384428234
 */

namespace App\Http\Repositories;

use App\Models\AttendanceSession;
use App\Models\UserAttendanceSession;
use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AttendanceSessionRepository extends Repository
{

    public function __construct()
    {
    }

    public function getSecondsRealtime()
    {
        $now       = Carbon::now();
        $hour      = $now->hour;
        $minute    = (int)floor($now->minute);
        $timeStart = Carbon::parse($hour.":".$minute);

        return TIME_EACH_ATTENDANCE_SESSION - (int)($now->timestamp - $timeStart->timestamp);
    }

    public function getDataAttendanceSession()
    {
        $records = AttendanceSession::where('date', Carbon::today()->toDateString())
            ->orderBy('created_at')
            ->with(['usersAttendanceSession'])
            ->get();
        if (count($records) == 0) {
            return [
                'current'          => AttendanceSession::create([
                    'date' => Carbon::today()->toDateString(),
                ]),
                'phone_win_latest' => "*",
                'sessions_past'    => collect(),
            ];
        }
        $current      = $records->where('status', STATUS_ACTIVE)->last();
        $sessionsPast = $records->sortByDesc('created_at')->except($current->id)->take(5);
        return [
            'current'          => $current,
            'phone_win_latest' => count($sessionsPast) > 0 ? $sessionsPast->last()->getPhone() : "*",
            'sessions_past'    => count($sessionsPast) > 0 ? $sessionsPast : collect(),
        ];
    }

    public function getCurrentAttendanceSession()
    {
        return $this->getDataAttendanceSession()['current'];
    }

    public function getTotalAmountAttendanceSession()
    {
        return DB::table('attendance_session')->sum('amount');
    }

    public function getUsersAttendanceSession($attendanceSessionCurrent = null)
    {
        $attendanceSessionCurrent = !is_null($attendanceSessionCurrent) ? $attendanceSessionCurrent : $this->getDataAttendanceSession()['current'];
        return $attendanceSessionCurrent->usersAttendanceSession;
    }


    public function insertUsersAttendanceSession($data)
    {
        $attendanceSessionCurrent = $this->getDataAttendanceSession()['current'];
        return UserAttendanceSession::create([
            'session_id' => $attendanceSessionCurrent->id,
            'phone'      => $data['phone'],
        ]);
    }

    public function queryUsersAttendanceByPhone($phone)
    {
        $attendanceSessionCurrent = $this->getDataAttendanceSession()['current'];
        return UserAttendanceSession::where('phone', $phone)->where('session_id', $attendanceSessionCurrent->id)->get();
    }

    public function createNewAttendanceSession($currentAttendanceSession)
    {
        $currentAttendanceSession->update(['status' => STATUS_DE_ACTIVE]);
        return AttendanceSession::create(['date' => Carbon::today()->toDateString()]);
    }

    public function getPhoneAttendanceSessionBots()
    {
        $cache = Cache::get('cache_phone_attendance_session_bots');
        if (!is_null($cache)) {
            return $cache;
        }
        $phones = collect(DB::table('attendance_session_bots')->select('phone')->get());
        $phones = $phones->pluck('phone')->toArray();
        Cache::put('cache_phone_attendance_session_bots', $phones, Carbon::now()->addDay());
        return $phones;
    }

}