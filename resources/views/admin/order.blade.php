@extends('layouts.app')
@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-black text-gray-800">Orders</h2>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="text-xs font-bold text-red-500">Logout</button></form>
    </div>

    <div class="flex space-x-6 border-b border-gray-200 mb-6 text-sm font-bold">
        <a href="{{ route('admin.orders') }}" class="border-b-2 border-red-500 text-red-500 pb-3 px-1">
            📦 Orders
        </a>
        <a href="{{ route('admin.menu.items') }}" class="text-gray-400 hover:text-gray-600 pb-3 px-1 transition">
            🍔 Menu Items
        </a>
    </div>
    <div class="flex space-x-2 mb-4">
    <a href="{{ route('admin.orders', 'all') }}" class="px-4 py-1 rounded-full text-xs font-bold bg-red-500 text-white">All</a>
    
    <a href="{{ route('admin.orders', 'pending') }}" class="px-4 py-1 rounded-full text-xs font-bold bg-gray-200 text-gray-700">Pending</a>
    
    <a href="{{ route('admin.orders', 'preparing') }}" class="px-4 py-1 rounded-full text-xs font-bold bg-gray-200 text-gray-700">Preparing</a>
</div>

    <div class="space-y-3">
    @forelse($orders as $order)
    <div class="bg-white p-4 rounded-xl border shadow-sm flex justify-between items-center">
        <div>
            <span class="text-xs text-gray-400 font-bold">#ORD120{{ $order->id }}</span>
            <p class="text-xs text-gray-500 font-bold">Table {{ $order->table_number }} • {{ $order->order_type }}</p>
            <p class="text-sm font-black text-gray-800">RM {{ number_format($order->total_price, 2) }}</p>
        </div>
        
        <a href="{{ route('admin.orders.edit', $order->id) }}" 
           class="px-3 py-1.5 rounded-lg text-xs font-black text-white 
           {{ strtolower($order->status) == 'pending' ? 'bg-red-500' : (strtolower($order->status) == 'preparing' ? 'bg-amber-500' : 'bg-green-500') }}">
            {{ ucfirst($order->status) }} ➔
        </a>
    </div>
    @empty
        <div class="text-center py-8 text-gray-400 font-bold text-sm">
            No orders found in database.
        </div>
    @endforelse
</div>

</div>
@endsection