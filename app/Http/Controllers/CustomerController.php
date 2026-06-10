<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order; // Pastikan Model Item di-import dengan betul

class CustomerController extends Controller
{
    public function showTableSelection() {
    return view('customer.select_table'); // Anda kena buat file blade ni
}
public function selectTable(Request $request)
{
    // 1. Validasi data yang dihantar daripada form
    $request->validate([
        'table_number' => 'required'
    ]);

    // 2. Simpan maklumat meja ke dalam session Laravel
    session([
        'table_number' => $request->table_number,
        'order_type' => 'Dine-in'
    ]);

    // 3. SELEPAS SIMPAN, WAJIB REDIRECT KE HALAMAN MENU
    // Gantikan 'customer.menu' dengan nama route halaman menu anda jika berbeza
    return redirect()->route('customer.menu'); 
}


public function showTakeawayDetails() {
    // 1. Set jenis order kepada Takeaway di dalam session
    session([
        'order_type' => 'Takeaway'
    ]);

    // 2. Terus lencongkan (redirect) ke halaman menu
    return redirect()->route('customer.menu');
}
    // 1. PAPAR HALAMAN MENU
    public function index()
{
    $foods = Item::where('category', 'Foods')->get();
    $drinks = Item::where('category', 'Drinks')->get();
    $snacks = Item::where('category', 'Snacks')->get();

    return view('customer.menu', compact('foods', 'drinks', 'snacks'));
}

    // 2. PAPAR HALAMAN DETAIL ITEM
    public function showItem($id)
    {
        $item = Item::findOrFail($id);
        return view('customer.item_detail', compact('item'));
    }

    // 3. PAPAR HALAMAN CART
    public function cart()
    {
        return view('customer.cart');
    }

    // 4. TAMBAH ITEM KE DALAM CART
    public function addToCart(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $item->name,
                "quantity" => $quantity,
                "price" => $item->price,
                "image" => $item->image // Membaca data kolum image dari database
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('customer.cart')->with('success', 'Item added to cart successfully!');
    }

    // 5. PADAM ITEM DARIPADA CART
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('customer.cart')->with('success', 'Item removed from cart!');
    }

    // 6. FUNGSI UNTUK MENGENDALIKAN PROSES ORDER
    // 6. FUNGSI UNTUK MENGENDALIKAN PROSES ORDER
    public function placeOrder(Request $request)
{
    $cart = session('cart', []);
    
    if (empty($cart)) {
        return redirect()->route('customer.menu')->with('error', 'Cart is empty');
    }

    // 1. Kira subtotal daripada session cart
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // 2. Kira caj berdasarkan order type
    $orderType = session('order_type', 'Dine-in');
    $finalTotal = ($orderType == 'Takeaway') ? ($subtotal * 1.05) : $subtotal;

    // 3. Simpan ke Database
    $order = new Order();
    $order->table_number = ($orderType == 'Takeaway') ? 0 : session('table_number', 0);
    $order->order_type = $orderType;
    $order->total_price = $finalTotal;
    $order->status = 'Pending';
    $order->save();

    $fileName = 'orders/order_' . $order->id . '.json';
    \Illuminate\Support\Facades\Storage::put($fileName, json_encode(session('cart', [])));

    session()->forget(['cart', 'table_number', 'order_type']);
    return redirect('/order/success');

    // ... (kod simpan order anda) ...
    $order->save();

    // Simpan ID pesanan dalam session sekejap untuk dipaparkan di halaman success
    session()->flash('order_number', 'ORD' . str_pad($order->id, 4, '0', STR_PAD_LEFT));

    // 4. Bersihkan session
    session()->forget(['cart', 'table_number', 'order_type']);

    // 5. Redirect ke halaman success
    return redirect('/order/success');

    $order->items = session('cart'); 
$order->save();
}
    // 7. HALAMAN BERJAYA ORDER
    public function orderSuccess() 
    { 
        return view('customer.success'); 
    }
    

    public function confirmOrder()
{
    $cart = session()->get('cart', []);
    
    // Jika troli kosong, hantar balik ke menu
    if (empty($cart)) {
        return redirect()->route('customer.menu')->with('error', 'Your cart is empty!');
    }
    
    // Kira jumlah harga (Total Price)
    $total = 0;
    foreach($cart as $item) {
        $total += ($item['price'] * $item['quantity']);
    }

    return view('customer.confirm_order', compact('cart', 'total'));
}

} // <--- PASTIKAN PENUTUP KURUNGAN KELAS INI BERADA DI PALING BAWAH SEKALI!