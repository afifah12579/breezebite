@extends('layouts.app')

@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-black text-gray-800">Orders</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-xs font-bold text-red-500">Logout</button>
        </form>
    </div>

    <div class="flex space-x-6 border-b border-gray-200 mb-6 text-sm font-bold">
        <a href="{{ route('admin.orders') }}" class="border-b-2 border-red-500 text-red-500 pb-3 px-1">
            📦 Orders
        </a>
        <a href="{{ route('admin.menu.items') }}" class="text-gray-400 hover:text-gray-600 pb-3 px-1 transition">
            🍔 Menu Items
        </a>
    </div>

    <div class="flex space-x-4 mb-6">
    <a href="{{ url('admin/orders/all') }}" 
       class="px-4 py-2 rounded-lg font-bold transition-all 
       {{ $status == 'all' ? 'bg-amber-950 text-white' : 'bg-gray-100 text-gray-600' }}">
        All
    </a>

    <a href="{{ url('admin/orders/pending') }}" 
       class="px-4 py-2 rounded-lg font-bold transition-all 
       {{ $status == 'pending' ? 'bg-amber-950 text-white' : 'bg-gray-100 text-gray-600' }}">
        Pending
    </a>

    <a href="{{ url('admin/orders/preparing') }}" 
       class="px-4 py-2 rounded-lg font-bold transition-all 
       {{ $status == 'preparing' ? 'bg-amber-950 text-white' : 'bg-gray-100 text-gray-600' }}">
        Preparing
    </a>

    <a href="{{ url('admin/orders/completed') }}" 
       class="px-4 py-2 rounded-lg font-bold transition-all 
       {{ $status == 'completed' ? 'bg-amber-950 text-white' : 'bg-gray-100 text-gray-600' }}">
        Completed
    </a>
</div>

    <div class="space-y-3">
        @forelse($orders as $order)
        <div class="bg-white p-4 rounded-xl border shadow-sm flex justify-between items-center">
            <div>
                <span class="text-xs text-gray-400 font-bold">#ORD120{{ $order->id }}</span>
                <p class="text-xs text-gray-500 font-bold">Table {{ $order->table_number }} • {{ $order->order_type }}</p>
                <p class="text-sm font-black text-gray-800">RM {{ number_format($order->total_price, 2) }}</p>
            </div>
            
            <div class="flex flex-col items-end gap-2">
                <a href="{{ route('admin.orders.edit', $order->id) }}" 
                   class="px-3 py-1.5 rounded-lg text-xs font-black text-white 
                   {{ strtolower($order->status) == 'pending' ? 'bg-red-500' : (strtolower($order->status) == 'preparing' ? 'bg-amber-500' : 'bg-green-500') }}">
                    {{ ucfirst($order->status) }} ➔
                </a>

                @if(strtolower($order->status) == 'completed')
                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti mahu memadam rekod ini?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-[10px] font-bold hover:underline">
                            Delete Order🗑
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @empty
            <div class="text-center py-8 text-gray-400 font-bold text-sm">
                No orders found in database.
            </div>
        @endforelse
    </div>
</div>
@endsection