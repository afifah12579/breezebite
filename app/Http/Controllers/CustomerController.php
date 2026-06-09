<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Pastikan Model Item di-import dengan betul

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
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Your cart is empty!');
        }

        // Kosongkan cart selepas order berjaya dibuat
        session()->forget('cart');

        return redirect()->route('customer.order.success');
    }

    // 7. HALAMAN BERJAYA ORDER
    public function orderSuccess() 
    { 
        return view('customer.success'); 
    }
} // <--- PASTIKAN PENUTUP KURUNGAN KELAS INI BERADA DI PALING BAWAH SEKALI!