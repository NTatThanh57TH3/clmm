<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLevelMoney extends Model
{
    use HasFactory;
    protected $table = "account_level_money";
    protected $fillable = [
        'sdt',
        'type',
        'min',
        'max',
    ];
}
