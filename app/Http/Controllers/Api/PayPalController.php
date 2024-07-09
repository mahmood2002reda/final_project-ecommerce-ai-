<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MyPurchases;
use App\Models\Order;
use App\Models\Orderitems;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    private $provider;
    private $userId;

    public function __construct(ExpressCheckout $provider)
    {
        $this->provider = $provider;
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::id();
    
            return $next($request);
        });
    }

    public function payment(Request $request)
    {
       

        $order = Order::where('user_id',  $this->userId)->get();
        $items = [];

        foreach ($order as $o) {
            foreach ($o->orderitems as $item) {
                $items[] = [
                    'price' => $item->price,
                    'qty' => $item->qty,
                    'name' =>' $item->product->name',
                ];
            }
        }

        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data = [
            'items' => $items,
            'invoice_id' => 1,
            'invoice_description' => "Order #1 Invoice",
            'return_url' => 'http://localhost:8000/api/payment/success',
            'cancel_url' => 'http://localhost:8000/api/payment/cancel',
            'total' => $total,
        ];

        $response = $this->provider->setExpressCheckout($data, true);

        if (isset($response['paypal_link'])) {
            return response()->json(['success' => true, 'redirect_url' => $response['paypal_link']]);
        } else {
            return response()->json(['success' => false, 'message' => 'Unable to create PayPal payment.'], 500);
        }
    }

    public function cancel()
    {
        return response()->json('Payment canceled', 404);
    }

    public function success(Request $request)
    {
        $response = $this->provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $orders = Order::where('user_id',  $this->userId)->get();

            foreach ($orders as $order) {
                $orderItems = $order->orderitems;
                foreach ($orderItems as $orderItem) {
                    $mypurchases = MyPurchases::create([
                        'user_id' =>  $this->userId,
                        'product_id' => $orderItem->product_id,
                        'qty' => $orderItem->qty,
                        'price' => $orderItem->price,
                    ]);
                }
            }

            foreach ($orders as $order) {
                $order->delete();
            }
            return response()->json('Payment successful');
        }

        return response()->json('Failed payment');
    }
}