<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddToCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = 1;
        $card = Card::where('user_id', $user_id)->with('product', 'user')->get();
        return $card; // response()->json(['card' => $card], 200);
    }
    
    public function addToCard(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
            'price' => 'required'
        ]);
        $user_id = 1;

        $order = Card::where('user_id', $user_id)
                    ->where('productId', $request->productId)
                    ->first();

        if ($order) {
            $order->quantity += $request->quantity;
            $order->price = $request->price; 
            $order->totalPrice = $order->quantity * $request->price; // Recalculate the total price
            $order->save();
        } else {
            Card::create([
                'user_id' => $user_id,
                'productId' => $request->productId,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'totalPrice' => $request->quantity * $request->price,
            ]);
        }
        // Card::create([
        //     'user_id' => '1',
        //     'productId' => $request->productId,
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'totalPrice' => $request->totalPrice,
        // ]);

        return response()->json(['message' => 'Product added to cart successfully'], 200);
    

        
    }
}
