<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Order;
use App\Models\Outcome;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $cre = $request->only('email', 'password'); ///['email'=>'',pas]

        if (auth()->guard('admin')->attempt($cre)) {
            return redirect('/admin/');
        }
        return 'email and password dont match';
    }

    public function dashboard()
    {

        $thisMonth = date('m');
        $thisYear = date('Y');

        //for sale
        $saleMonths = [date('F')]; //setmp
        $saleMonthNumber = [date('m')]; //09
        $initSaleData =  Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->count();
        $saleData = [$initSaleData];

        //for inout
        $dayList = [date('d')];
        $initIncomeData =  Income::whereYear('created_at', $thisYear)->whereDay('created_at', date('d'))->sum('price');
        $initOutcomeData =  Outcome::whereYear('created_at', $thisYear)->whereDay('created_at', date('d'))->sum('price');
        $incomeData = [$initIncomeData];
        $outcomeData = [$initOutcomeData];

        for ($i = 1; $i <= 5; $i++) {
            $saleMonthNumber[] = date('m', strtotime("-$i month"));
            $saleMonths[] = date('F', strtotime("-$i month"));

            $dayList[] = date('d', strtotime("-$i day"));
        }

        foreach ($dayList as $dl) {
            $incomeData[] = Income::whereYear('created_at', $thisYear)->whereMonth('created_at', date('m'))->whereDay('created_at', $dl)->sum('price');
            $outcomeData[] = Outcome::whereYear('created_at', $thisYear)->whereMonth('created_at', date('m'))->whereDay('created_at', $dl)->sum('price');
        }

        foreach ($saleMonthNumber as $sm) {
            $saleData[] =   Order::whereMonth('created_at', $sm)->whereYear('created_at', $thisYear)->count();
        }

        $todayIncome = Income::whereYear('created_at', $thisYear)->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->sum('price');
        $todayOutcome = Outcome::whereYear('created_at', $thisYear)->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->sum('price');

        $userCount = User::count();
        $orderCount = Order::count();
        return view('admin.dashboard', compact('saleMonths', 'saleData', 'incomeData', 'dayList', 'outcomeData', 'todayIncome', 'todayOutcome', 'userCount', 'orderCount'));
    }
}
