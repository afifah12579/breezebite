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

    // 1. PANDANGAN TROLI (Mengira Harga Bersandarkan Kuantiti)
public function viewCart()
{
    $cart = session()->get('cart', []);
    $total = 0;

    // Kitar setiap item dalam cart dan darabkan harga dengan kuantiti
    foreach ($cart as $id => $details) {
        $total += $details['price'] * $details['quantity'];
    }

    return view('customer.cart', compact('cart', 'total'));
}

// 2. KEMASKINI KUANTITI (Tambah / Tolak)
public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $action = $request->input('action');
        
        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease') {
            $cart[$id]['quantity']--;
            // Jika kuantiti kurang dari 1, padam terus dari troli
            if ($cart[$id]['quantity'] < 1) {
                unset($cart[$id]);
            }
        }
        
        session()->put('cart', $cart);
    }

    return redirect()->route('customer.cart')->with('success', 'Cart updated successfully!');
}

// 3. PADAM ITEM DARIPADA CART (Fungsi Butang Delete)
public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('customer.cart')->with('success', 'Item removed from cart!');
}

    public function orderSuccess() { return view('customer.success'); }

    // FUNGSI INI UNTUK MENYELESAIKAN RALAT "UNDEFINED METHOD"
public function placeOrder(Request $request)
{
    $cart = session()->get('cart', []);

    // Jika troli kosong, hantar pengguna kembali ke menu
    if (empty($cart)) {
        return redirect()->route('customer.menu')->with('error', 'Your cart is empty!');
    }

    // Di sini anda boleh masukkan logik untuk simpan data ke database Order jika perlu.
    // Buat masa ini, kita kosongkan troli selepas order berjaya dibuat:
    session()->forget('cart');

    // Bawa pengguna ke halaman success
    return redirect()->route('customer.order.success');
}
}
