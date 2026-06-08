@extends('layouts.app')
@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-black text-gray-800">Orders</h2>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="text-xs font-bold text-red-500">Logout</button></form>
    </div>

    <div class="flex space-x-2 mb-4 font-bold text-xs">
        <span class="bg-red-500 text-white px-3 py-1.5 rounded-full">All</span>
        <span class="bg-white border text-gray-500 px-3 py-1.5 rounded-full">Pending</span>
        <span class="bg-white border text-gray-500 px-3 py-1.5 rounded-full">Preparing</span>
    </div>

    <div class="space-y-3">
        @foreach($orders as $order)
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center">
            <div>
                <span class="text-xs text-gray-400 font-bold">#ORD120{{ $order->id }}</span>
                <p class="text-xs text-gray-500 font-bold mt-0.5">Table {{ $order->table_number }} • {{ $order->order_type }}</p>
                <p class="text-sm font-black text-gray-800 mt-1">RM {{ number_format($order->total_price, 2) }}</p>
            </div>
            <a href="{{ route('admin.orders.edit', $order->id) }}" class="px-3 py-1.5 rounded-lg text-xs font-black text-white {{ $order->status == 'Pending' ? 'bg-red-500' : ($order->status == 'Preparing' ? 'bg-amber-500' : 'bg-green-500') }}">
                {{ $order->status }} ➔
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection