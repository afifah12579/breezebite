<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item; 
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function orders($status = 'all')
{
    // Tukar input kepada huruf kecil untuk elak error typo
    $status = strtolower($status);

    if ($status === 'all') {
        // Paparkan semua pesanan
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
    } else {
        // Tapis berdasarkan status (Pending/Preparing/Completed)
        $orders = \App\Models\Order::where('status', ucfirst($status))
                                   ->orderBy('created_at', 'desc')
                                   ->get();
    }

    // Pastikan view yang dipanggil adalah 'admin.order' (ikut nama fail blade anda)
    return view('admin.order', compact('orders', 'status'));
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
    
    // Padam gambar fizikal sebelum padam record dari database
    if ($item->image && File::exists(public_path('images/' . $item->image))) {
        File::delete(public_path('images/' . $item->image));
    }
    
    $item->delete(); 

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

    // Jika admin ada upload gambar baru
    if ($request->hasFile('image')) {
        // 1. Padam gambar lama jika wujud dalam folder
        if ($item->image && File::exists(public_path('images/' . $item->image))) {
            File::delete(public_path('images/' . $item->image));
        }

        // 2. Simpan gambar baru
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $item->image = $imageName;
    }

    $item->save();

    return redirect()->route('admin.menu.items');
    }

    public function menuItems() {
    // Ambil data mengikut kategori
    $foods = Item::where('category', 'foods')->get();
    $drinks = Item::where('category', 'drinks')->get();
    $snacks = Item::where('category', 'snacks')->get();
    
    // Hantar ketiga-tiga data ke view
    return view('admin.menu_items', compact('foods', 'drinks', 'snacks'));
}

public function deleteOrder($id)
{
    $order = \App\Models\Order::findOrFail($id);
    
    // Pastikan order betul-betul sudah 'Completed' baru boleh padam
    if (strtolower($order->status) === 'completed') {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
    
    return redirect()->back()->with('error', 'Only completed orders can be deleted.');
}
}
