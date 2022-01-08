<?php
/**
 *File name : AccountMomoRepository.php / Date: 1/4/2022 - 8:55 PM
 *Code Owner: Thanhnt/ Email: Thanhnt@omt.com.vn/ Phone: 0384428234
 */

namespace App\Http\Repositories;

use App\Models\AccountLevelMoney;
use App\Models\AccountMomo;
use App\Models\LichSuChoiMomo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AccountMomoRepository
{

    public function getListAccountMomosLevels()
    {
        $cache = Cache::get('cache_list_account_momos_active');
        $cache = null;
        if (!is_null($cache)) {
            return $cache;
        }
        //        $accounts       = AccountMomo::where('status', STATUS_ACTIVE)->get()->toArray();
        //        $phoneAccounts  = collect($accounts)->pluck('sdt')->toArray();
        $levelAccounts = AccountLevelMoney::all()->toArray();
        Cache::put('cache_list_account_momos_active', $levelAccounts, Carbon::now()->addMinutes(60));
        return $levelAccounts;
    }

    public function getListAccountMomos()
    {
        return AccountMomo::all()->toArray();
    }

    public function getListAccountMomosGroupType()
    {
        $accounts          = AccountLevelMoney::all();
        $phones            = $accounts->pluck('sdt')->unique()->toArray();
        $sumTienCuocPhones = [];
        foreach ($phones as $index => $phone) {
            $sumTienCuocPhones[] = [
                'phone' => $phone,
                'sum'   => DB::table('lich_su_choi_momos')
                    ->whereDate('created_at', Carbon::today())
                    ->where('ketqua', 1)
                    ->where('sdt_get', $phone)
                    ->sum('tiencuoc'),
            ];
        }
        return $accounts->map(function($account) use ($sumTienCuocPhones) {
            $sumTienCuocPhone     = collect($sumTienCuocPhones)->where('phone', $account->sdt)->first();
            $account->sumTienCuoc = is_null($sumTienCuocPhone) ? 0 : $sumTienCuocPhone['sum'];
            return $account;
        })->groupBy('type');
    }

}