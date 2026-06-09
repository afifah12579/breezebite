<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order; // Pastikan Model Item di-import dengan betul

class CustomerController extends Controller
{
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
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Your cart is empty!');
        }

        // 1. Kira jumlah harga
        $total = 0;
        foreach($cart as $item) {
            $total += ($item['price'] * $item['quantity']);
        }

        // 2. SIMPAN KE DATABASE (Bahagian ini hilang dalam kod asal anda tadi)
        $order = \App\Models\Order::create([
            'table_number' => session('table_number', '00'),
            'order_type'   => session('order_type', 'Dine-in'),
            'total_price'  => $total,
            'status'       => 'Pending'
        ]);

        // 3. (Pilihan) Simpan item ke order_items jika anda sudah buat table tersebut
        // Jika belum ada table order_items, biarkan bahagian ini dahulu
        
        // 4. Kosongkan troli selepas order berjaya dibuat
        session()->forget('cart');

        return redirect()->route('customer.order.success');
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

// Tambah fungsi ini di dalam CustomerController.php
public function selectTable(Request $request)
{
    $request->validate([
        'table_number' => 'required',
        'order_type' => 'required'
    ]);

    // Simpan maklumat meja ke dalam session
    session([
        'table_number' => $request->table_number,
        'order_type' => $request->order_type
    ]);

    // Selepas pilih meja, bawa pelanggan terus ke halaman menu utama
    return redirect()->route('customer.menu');
}
} // <--- PASTIKAN PENUTUP KURUNGAN KELAS INI BERADA DI PALING BAWAH SEKALI!