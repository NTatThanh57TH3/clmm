<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuChoiMomo extends Model
{
    use HasFactory;
    protected $table = "lich_su_choi_momos";
    protected $fillable = [
        'sdt',
        'sdt_get',
        'magiaodich',
        'tiencuoc',
        'tiennhan',
        'trochoi',
        'noidung',
        'ketqua',
        'status',
    ];
    public function accountMomo()
    {
        return $this->hasOne(AccountMomo::class, 'sdt', 'sdt')->where('status', STATUS_ACTIVE);
    }
}
