<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    //

    public function index(Request $request){

       // $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
       $todayDate = Carbon::now()->setTimezone('Africa/Cairo')->format('Y-m-d');
       $orders =Order::when($request->date !=null , function($q) use ($request){
                return $q->whereDate('created_at', '=', $request->date);
       }, function($q) use ($todayDate){
        return $q->whereDate('created_at', '=', $todayDate);
    })
    ->when($request->status !=null,function($q) use ($request){
        return $q->where('status_message', '=', $request->status);
    })
    ->paginate(10);


    //    Order::whereDate('created_at', '=', $todayDate)->paginate(8);
        return view('back.orders.index',compact('orders'));



    }
    public function show($orderId){

        // $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $order = Order::where('id',$orderId)->first();
        if($order){
         return view('back.orders.view',compact('order'));
        }

        else{
              return redirect('back/orders')->with('message','No Orders found');
             }



     }

     public function updateOrderStatus(int $orderId,Request $request){
        $order = Order::where('id',$orderId)->first();
        if($order){
           $order->update(['status_message'=>$request->order_status]);
           return redirect('back/orders/'.$orderId)->with('message','Order status updated successfully');
        }

        else{
              return redirect('back/orders/'.$orderId)->with('message','No Orders found');
             }

     }

  public function viewInvoice(int $orderId){

       $order=Order::findOrfail($orderId);
       return view('back.invoices.generate-invoice',compact('order'));

  }
  public function generateInvoice(int $orderId){

    $order=Order::findOrfail($orderId);
    $data=['order'=>$order];
    $pdf = Pdf::loadView('back.invoices.generate-invoice', $data);
    $todayDate=Carbon::now()->format('d-m-Y');
    return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');


}
















//      public function show($orderId)
// {
//     $order = Order::with('orderItems.product', 'orderItems.productColor.color')->find($orderId);

//     if ($order) {
//         return view('back.orders.view', compact('order'));
//     } else {
//         return redirect()->back()->with('message', 'No Orders found');
//     }
// }
//      public function todayOrders()
//   {
//     $startOfDay = Carbon::now()->startOfDay();
//     $endOfDay = Carbon::now()->endOfDay();

//     $orders = Order::whereBetween('created_at', [$startOfDay, $endOfDay])->paginate(8);
//     return view('back.orders.today', compact('orders'));
//    }

     public function todayOrders()
     {
         $todayDate = Carbon::now()->setTimezone('Africa/Cairo')->format('Y-m-d');
         $orders = Order::whereDate('created_at', '=', $todayDate)->paginate(8);
         return view('back.orders.today', compact('orders'));
     }
    //  public function thisMonthOrders(){

    //     $todayDate=Carbon::now()->format('m');
    //     $orders=Order::whereDate('created_at',$todayDate)->paginate(8);
    //     return view('back.orders.month',compact('orders'));

    //  }
    //  public function thisYearOrders(){

    //     $todayDate=Carbon::now()->format('Y');
    //     $orders=Order::whereDate('created_at',$todayDate)->paginate(8);
    //     return view('back.orders.index',compact('orders'));

    //  }

    public function thisMonthOrders()
{
    $currentDate = Carbon::now()->setTimezone('Africa/Cairo')->format('Y-m');
    $orders = Order::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentDate'")
        ->paginate(8);
    return view('back.orders.month', compact('orders'));
}

public function thisYearOrders()
{
    $currentYear = Carbon::now()->setTimezone('Africa/Cairo')->format('Y');
    $orders = Order::whereRaw("YEAR(created_at) = '$currentYear'")
        ->paginate(8);
    return view('back.orders.index', compact('orders'));
}
}
