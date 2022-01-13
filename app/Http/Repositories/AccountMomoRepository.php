<?php
/**
 *File name : AccountMomoRepository.php / Date: 1/4/2022 - 8:55 PM
 *Code Owner: Thanhnt/ Email: Thanhnt@omt.com.vn/ Phone: 0384428234
 */

namespace App\Http\Repositories;

use App\Models\AccountLevelMoney;
use App\Models\AccountMomo;
use App\Models\LichSuBank;
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
        $levelAccounts = AccountLevelMoney::where('status', STATUS_ACTIVE)->get()->map(function($account){
            $account->game = $account->getGameAttribute();
            return $account;
        })->toArray();
        //        $phoneAccounts  = collect($accounts)->pluck('sdt')->toArray();
        Cache::put('cache_list_account_momos_active', $levelAccounts, Carbon::now()->addMinutes(60));
        return $levelAccounts;
    }

    public function getListAccountMomos($forCreate = false)
    {
        $phones = [];
        if (!$forCreate) {
            $accountListMomoLevel = $this->getListAccountMomosLevels();
            $phones               = collect($accountListMomoLevel)->pluck('sdt')->toArray();
        }
        $query =  AccountMomo::where([
            'status' => STATUS_ACTIVE,
        ]);
        $query = !empty($phones) ? $query->whereIn('sdt', $phones) : $query;
        return $query->get()->unique('sdt')->take(5)->toArray();
    }

    public function getListAccountMomosGroupType()
    {
        $accounts          = collect($this->getListAccountMomosLevels());
        $phones            = $accounts->pluck('sdt')->unique()->toArray();
        $LichSuBank        = new LichSuBank;
        $LichSuBanks       = $LichSuBank->whereDate('created_at', \Illuminate\Support\Carbon::today())->get();
        $sumTienCuocPhones = [];
        foreach ($phones as $index => $phone) {
            $sumTienCuocPhones[] = [
                'phone' => $phone,
                'sum'   => DB::table('lich_su_choi_momos')
                    ->whereDate('created_at', Carbon::today())
                    ->where('ketqua', 1)
                    ->where('sdt_get', $phone)
                    ->sum('tiennhan'),

            ];
        }
        return $accounts->map(function($account) use ($sumTienCuocPhones, $LichSuBanks) {
            $sumTienCuocPhone     = collect($sumTienCuocPhones)->where('phone', $account['sdt'])->first();
            $account['sumTienCuoc'] = is_null($sumTienCuocPhone) ? 0 : $sumTienCuocPhone['sum'];
            $getLichSuBank        = $LichSuBanks->where('sdtbank', $account['sdt']);
            $countbank            = 0;
            $responseLichSuBank   = $getLichSuBank->pluck('response')->toArray();
            foreach ($responseLichSuBank as $response) {
                $j = json_decode($response, true);
                if (isset($j['status']) && $j['status'] == 200) {
                    $countbank++;
                }
            }
            $account['countbank'] = $countbank;
            return $account;
        })->groupBy('type')->map(function($accountList) {
            return $accountList->unique('phone');
        });
    }

}