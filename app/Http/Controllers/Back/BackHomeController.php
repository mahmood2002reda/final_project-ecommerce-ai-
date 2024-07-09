<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BackHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalProducts=Product::count();
        $totalCategories=Category::count();
        $totalBrands=Brand::count();
        $totalAdmins=Admin::count();
        $totalUsers=User::count();
        $totalVendors=Vendor::count();
        $totalOrders=Order::count();
        $todayDate=Carbon::now()->setTimezone('Africa/Cairo')->format('Y-m-d');
        $thisMonthDate=Carbon::now()->setTimezone('Africa/Cairo')->format('m');
        $thisYearDate=Carbon::now()->setTimezone('Africa/Cairo')->format('Y');
        $todayOrders=Order::whereDate('created_at','=',$todayDate)->count();
        $thisMonthOrders=Order::whereMonth('created_at',  $thisMonthDate)->count();
        $thisYearOrders=Order::whereYear('created_at', $thisYearDate)->count();
        return view("back.home",compact('totalProducts','totalCategories','totalBrands','totalAdmins','todayOrders','thisMonthOrders','thisYearOrders','totalOrders','totalUsers','totalVendors'));
    }
}
