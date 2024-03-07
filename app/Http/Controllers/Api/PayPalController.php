<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MyPurchases;
use App\Models\Order;
use App\Models\Orderitems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    private $provider;

    public function __construct(ExpressCheckout $provider)
    {
        $this->provider = $provider;
    }
    public function payment(Request $request)
{
    $userId  = Auth::id();

    // Corrected variable name to $order for clarity
    $order = Order::where('user_id', $userId)->get();
    $items = [];

    foreach ($order as $o) {
        foreach ($o->orderitems as $item) {
            $items[] = [
                'price' => $item->price, // Assuming each OrderItem has a price
                'qty' => $item->qty,

                'name' => '$item->product->name',
                'desc' => '$item->product->description',
            ];
        }
    }

    // You need to adjust your calculation method or how you're preparing the $items array based on actual structure.
    // Assuming each item in $items contains 'price' and 'qty'
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

    $provider = new ExpressCheckout;
    $response = $this->provider->setExpressCheckout($data, true);

    if (isset($response['paypal_link'])) {
        return response()->json(['success' => true, 'redirect_url' => $response['paypal_link']]);
    } else {
        // Log or handle error details for further inspection.
        return response()->json(['success' => false, 'message' => 'Unable to create PayPal payment.'], 500);
    }
}

// Adjust the calculateTotal method or use the direct calculation in the payment method as shown above.

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
            $orders = Order::where('user_id', $id)->get();
    
            foreach ($orders as $order) {
                $orderItems = $order->orderitems;
                foreach ($orderItems as $orderItem) {
                    $mypurchases = MyPurchases::create([
                        'user_id' => $id,
                        'product_id' => $orderItem->product_id,
                        'qty' => $orderItem->qty,
                        'price' => $orderItem->price,
                    ]);
                }
            }
    
            ShoppingCart::where('user_id', $id)->delete();
            return response()->json('Payment successful');
        }
    
        return response()->json('Failed payment');
    }
}


/*
<?php

namespace App\Http\Controllers\Api;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    private $provider;

    public function __construct(ExpressCheckout $provider)
    {
        $this->provider = $provider;
    }

    public function payment(Request $request)
    {
        $user = Auth::id(); // Use Auth::id() to dynamically fetch the authenticated user's ID.

        // Fetch cart items for the authenticated user.
        $cartItems = ShoppingCart::where('user_id', 1)->get(); 
        $items = [];

        foreach ($cartItems as $cartItem) {
            $items[] = [
                'name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'desc' => $cartItem->product->description,
                'qty' => $cartItem->product_qty,
            ];
        }

        $total = $this->calculateTotal($cartItems);

        $data = [
            'items' => $items,
            'invoice_id' => uniqid(), // Generate a unique ID for each invoice.
            'invoice_description' => "Order #" . uniqid() . " Invoice",
            'return_url' => url('/api/payment/success'),
            'cancel_url' => url('/api/payment/cancel'),
            'total' => $total,
        ];

        $response = $this->provider->setExpressCheckout($data, true);

        if (isset($response['paypal_link'])) {
            return response()->json(['success' => true, 'redirect_url' => $response['paypal_link']]);
        } else {
            // Log or handle error details for further inspection.
            return response()->json(['success' => false, 'message' => 'Unable to create PayPal payment.'], 500);
        }
    }

    private function calculateTotal($cartItems)
    {
        $total = 0.00;
        foreach ($cartItems as $cartItem) {
            $extraPrice = $cartItem->extra_price ?? 0.00; // Use a default value if extra_price is not set.
            $total += ($cartItem->product->price + 5) * $cartItem->product_qty;
        }
        return $total;
    }

    public function cancel()
    {
        // Consider providing more detailed information or redirecting the user.
        return response()->json(['success' => false, 'message' => 'Payment canceled'], 200);
    }

    public function success(Request $request)
    {
        $response = $this->provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
           // $user = Auth::user(); // Fetch the authenticated user.
           // ShoppingCart::where('user_id', $user->id)->delete(); // Clear the shopping cart.
            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } else {
            // Log or handle error details for further inspection.
            return response()->json(['success' => false, 'message' => 'Failed payment'], 500);
        }
    }
}


*/