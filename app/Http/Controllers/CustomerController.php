<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index() { return view('customer.welcome'); }

    public function selectTable(Request $request) {
        $request->validate(['table_number' => 'required', 'order_type' => 'required']);
        session(['table_number' => $request->table_number, 'order_type' => $request->order_type, 'cart' => []]);
        return redirect()->route('customer.menu');
    }

    public function menu() {
        $foods = Item::where('category', 'Foods')->get();
        $drinks = Item::where('category', 'Drinks')->get();
        $snacks = Item::where('category', 'Snacks')->get();
        return view('customer.menu', compact('foods', 'drinks', 'snacks'));
    }

    public function showItem($id) {
        $item = Item::findOrFail($id);
        return view('customer.item_detail', compact('item'));
    }

   public function addToCart(Request $request, $id)
{
    $item = Item::findOrFail($id);
    
    // 1. Fetch current cart array from session memory storage
    $cart = session()->get('cart', []);

    // 2. If item is already chosen, increment its quantity counters
    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        // Otherwise, add the new item selection row safely
        $cart[$id] = [
            "name" => $item->name,
            "quantity" => 1,
            "price" => $item->price,
            "image" => $item->image ?? 'nasi_lemak.jpg'
        ];
    }

    // 3. Put updated item array back inside session memory
    session()->put('cart', $cart);

    // 4. Redirect right back to the menu with a success alert toast
    // This keeps them on the menu page so they can continue to select drinks & snacks!
    return redirect()->route('customer.menu')->with('success', $item->name . ' added to cart!');
}

    public function viewCart() { return view('customer.cart'); }

    public function placeOrder() {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('customer.menu');

        $total = array_sum(array_map(fn($v) => $v['price'] * $v['quantity'], $cart));

        Order::create([
            'table_number' => session('table_number'),
            'order_type' => session('order_type'),
            'items' => $cart,
            'total_price' => $total,
            'status' => 'Pending'
        ]);

        session()->forget('cart');
        return redirect()->route('customer.success');
    }

    public function orderSuccess() { return view('customer.success'); }
}
