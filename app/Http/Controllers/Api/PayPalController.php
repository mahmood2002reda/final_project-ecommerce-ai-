<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment(Request $request)
    {

        $id = Auth::id();
    
        $cartItems = ShoppingCart::where('user_id', $id)->get();
        $items = [];

        foreach ($cartItems as $cartItem) {
            $item = [
                'name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'desc' => $cartItem->product->description,
                'qty' => $cartItem->product_qty,
            ];

            $items[] = $item;
        }

        $total = $this->calculateTotal($cartItems);

        $data = [
            'items' => $items,
            'invoice_id' => 1,
            'invoice_description' => "Order #1 Invoice",
            'return_url' => 'http://localhost:8000/api/payment/success',
            'cancel_url' => 'http://localhost:8000/api/payment/cancel',
            'total' => $total,
        ];

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data, true);

        return Redirect::to($response['paypal_link']);
    }

   private function calculateTotal($cartItems)
{
    $total = 0;

    foreach ($cartItems as $cartItem) {
        $total += ($cartItem->product->price + $cartItem->extra_price) * $cartItem->product_qty;
    }

    return $total;
}

    public function cancel()
    {
        return response()->json('Payment canceled', 404);
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWARNING'])) {
            $id = Auth::id();
            ShoppingCart::where('user_id',$id)->delete();
            return response()->json('Payment successful');
        }

        return response()->json('Failed payment');
    }
}


/*
<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment(Request $request, $id)
    {
        $userId = User::find($id);
        $cartItems = ShoppingCart::where('user_id', $id)->get();
        $items = [];

        foreach ($cartItems as $cartItem) {
            $item = [
                'name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'desc' => $cartItem->product->description,
                'qty' => $cartItem->product_qty,
            ];

            $items[] = $item;
        }

        $total = $this->calculateTotal($cartItems);

        $data = [
            'items' => $items,
            'invoice_id' => 1,
            'invoice_description' => "Order #1 Invoice",
            'return_url' => 'http://localhost:8000/api/payment/success',
            'cancel_url' => 'http://localhost:8000/api/payment/cancel',
            'total' => $total,
        ];

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data, true);

        return Redirect::to($response['paypal_link']);
    }

    private function calculateTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->product->price * $cartItem->product_qty;
        }

        return $total;
    }

    public function cancel()
    {
        return response()->json('Payment canceled', 404);
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWARNING'])) {
           // ShoppingCart::where('user_id',$id)->delete();
            return response()->json('Payment successful');
        }

        return response()->json('Failed payment');
    }
}


*/