<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index(){

        $user_id = Auth::id();
        if($user_id){
            $cartItems= ShoppingCart::where('user_id',$user_id)->get();
            $total = $this->calculateTotal($cartItems);
            $numberOfItem=$cartItems->count();
            return response()->json([
                'status' => 201,
                'message' => 'Item already exists in the cart',
                'total'=>$total,
                'numberOfItem'=>$numberOfItem
            ]);
        }
    }
    public function addToCart(Request $request, $id)
{
    $id = Auth::id();
    if ($id) {
        $user_id = $id;
        $product_id = $request->route('id');
        $product_qty = $request->product_qty;
        $product_color = $request->product_color;
        $product_size = $request->product_size;
        $product_extra_price = $request->product_extra_price;

        $productOptions = ProductOption::where('product_id', $product_id)->get();

        $option = [];
        foreach ($productOptions as $productOption) {
            $option[] = [
                'color' => $productOption->color->color,
                'size' => $productOption->size->size,
            ];
        }

        $userOption = [
            'color' => $product_color,
            'size' => $product_size,
        ];

        $optionMatched = false;
        foreach ($option as $opt) {
            if ($opt['color'] == $userOption['color'] && $opt['size'] == $userOption['size']) {
                $optionMatched = true;
                break;
            }
        }

        if ($optionMatched) {
            $productCheck = Product::where('id', $product_id)->first();

            if ($productCheck) {
                if (ShoppingCart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json([
                        'status' => 201,
                        'message' => 'Item already exists in the cart'
                    ]);
                } else {
                    $cartItem = new ShoppingCart;
                    $cartItem->user_id = $user_id;
                    $cartItem->product_id = $product_id;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->product_size = $product_size;
                    $cartItem->product_color = $product_color;
                    $cartItem->extra_price = $product_extra_price;

                    $cartItem->save();

                    return response()->json([
                        'status' => 201,
                        'message' => 'Item added to the cart successfully'
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid product options',
                'options are available'=>$option
            ]);
        }
    } else {
        return response()->json([
            'status' => 401,
            'message' => 'Please login first'
        ]);
    }
}
    public function updateQuantity($cart_id,$scope){

        $user_id = Auth::id();
        if($user_id){
            $cartItem= ShoppingCart::where('id',$cart_id)->where('user_id',$user_id)->first();
        if($scope == "inc"){

            $cartItem->product_qty += 1;
        }
        elseif($scope == "dec"){

            $cartItem->product_qty -= 1;
        }

        $cartItem->update();
        return response()->json([
            'status'=>201,
            'message'=>'Quantity is update'
        ]);

        }
        return response()->json([
            'status'=>401,
            'message'=>'login to continue'
        ]);
        
    }

    public function cartItemDelet($cart_id){

        $user_id = Auth::id();
        if($user_id){
            $cartItem= ShoppingCart::where('id',$cart_id)->where('user_id',$user_id)->first();

if($cartItem){
    $cartItem->delete();
    return response()->json([
        'status'=>201,
        'message'=>'cart item removed'
    ]);


}
return response()->json([
    'status'=>404,
    'message'=>'item not found'
]);
        }
        return response()->json([
            'status'=>401,
            'message'=>'login to continue'
        ]);


    }
    private function calculateTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->product->price * $cartItem->product_qty;
        }

        return $total;
    }
    
}