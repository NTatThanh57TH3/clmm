<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttendanceSession extends Model
{
    use HasFactory;
    protected $table = "users_attendance_session";
    protected $fillable = [
        'session_id',
        'user_id',
        'phone',
        'status',
    ];

}
