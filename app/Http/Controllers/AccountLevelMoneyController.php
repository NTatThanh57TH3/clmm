<?php

namespace App\Http\Controllers;


use App\Http\Repositories\AccountMomoRepository;
use App\Models\AccountMomo;
use Illuminate\Support\Facades\Config;
use stdClass;

class AccountLevelMoneyController extends Controller
{

    public function __construct()
    {
    }

    //
    public function index()
    {
        $GetSetting              = new stdClass;
        $accountMomoRepo         = new AccountMomoRepository();
        $accounts                = $accountMomoRepo->getListAccountMomosLevels();
        $accountsMomo            = $accountMomoRepo->getListAccountMomos();
        $GetSetting->namepage    = 'Quản lý hạn mức SĐT';
        $GetSetting->title       = 'Quản lý hạn mức SĐT';
        $GetSetting->description = 'Quản lý hạn mức SĐT';
        $GetSetting->description = 'Tạo mới';
        $titleModal              = 'Tạo mới';
        $types                   = Config::get('constant.list_game');
        return view('AdminPage.AccountLevelMoney.index',
            compact('GetSetting', 'titleModal', 'accounts', 'accountsMomo', 'types'));
    }

}
