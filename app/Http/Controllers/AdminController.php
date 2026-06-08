<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item; // <--- SILA TAMBAH BARIS INI

class AdminController extends Controller
{
    public function orders() {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order', compact('orders'));
    }

    public function editOrderStatus($id) {
        $order = Order::findOrFail($id);
        return view('admin.update_status', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders');
    }

    public function menuItems() {
        $items = Item::all();
        return view('admin.menu_items', compact('items'));
    }

    // 1. Fungsi untuk tunjuk muka surat borang
    public function createItem() {
        return view('admin.create_item');
    }

    // 2. Fungsi untuk simpan data dari borang ke database
    public function storeItem(Request $request) {
        $item = new Item();
        $item->name = $request->name;
        $item->category = $request->category;
        $item->price = $request->price;
        $item->description = $request->description;

        // Kalau admin ada upload gambar, kita simpan dalam folder images
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }

        $item->save(); // Save ke database!

        return redirect()->route('admin.menu.items');
    }

    public function destroyItem($id) {
        $item = Item::findOrFail($id);
        $item->delete(); // Padam terus dari database!

        return redirect()->route('admin.menu.items');
    }

    // 1. Fungsi untuk tunjuk borang edit berserta data lama
    public function editItem($id) {
        $item = Item::findOrFail($id);
        return view('admin.edit_item', compact('item'));
    }

    // 2. Fungsi untuk proses simpan data baru
    public function updateItem(Request $request, $id) {
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->category = $request->category;
        $item->price = $request->price;
        $item->description = $request->description;

        // Jika admin tukar gambar baru
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect()->route('admin.menu.items');
    }
}
