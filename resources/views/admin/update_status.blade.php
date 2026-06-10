@extends('layouts.app')

@section('content')
<div class="p-4 flex-1 flex flex-col justify-between h-screen overflow-y-auto">
    <div>
        <div class="flex items-center space-x-2 mb-6">
            <a href="{{ route('admin.orders') }}" class="text-gray-800 text-xl font-bold">←</a>
            <h2 class="text-lg font-black text-gray-800">Update Order Status</h2>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 space-y-3 text-sm font-bold text-gray-600 mb-6">
            <div class="flex justify-between">
                <span>Order ID</span>
                <span class="text-gray-900">#ORD{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            
            <div class="flex justify-between">
                <span>Table</span>
                <span class="text-gray-900">Table {{ $order->table_number ?? 'N/A' }}</span>
            </div>
            
            <div class="flex justify-between">
                <span>Order Type</span>
                <span class="text-gray-900">{{ $order->order_type }}</span>
            </div>

            <div class="mt-4 mb-4">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Ordered Items</h3>
                <div class="bg-white border border-slate-100 rounded-2xl p-5 space-y-4 shadow-xs">
                    @if(!empty($items) && is_array($items))
                        @foreach($items as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 flex items-center justify-center bg-gray-50 rounded-lg text-xs font-black text-gray-600">
                                        {{ $item['quantity'] ?? 1 }}x
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">{{ $item['name'] ?? 'Item' }}</span>
                                </div>
                                <span class="text-xs font-bold text-gray-500">
                                    RM {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-gray-400 font-bold italic text-center py-2">No items found.</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-between text-base font-black pt-2 border-t text-gray-800">
                <span>Total</span>
                <span class="text-red-500">RM {{ number_format($order->total_price, 2) }}</span>
            </div>
        </div>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="status-form">
            @csrf
            @method('PUT')
            <label class="block text-gray-700 font-bold text-xs mb-1.5">Status</label>
            <select name="status" class="w-full border-2 border-gray-100 p-3 bg-white rounded-lg font-bold text-sm text-gray-800 focus:outline-none focus:border-red-500">
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Preparing" {{ $order->status == 'Preparing' ? 'selected' : '' }}>Preparing</option>
                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </div>

    <div class="flex space-x-3 mt-6">
        <a href="{{ route('admin.orders') }}" class="w-1/2 text-center bg-gray-100 text-gray-600 font-bold py-3.5 rounded-xl text-sm">Cancel</a>
        <button type="submit" form="status-form" class="w-1/2 bg-gray-900 text-white font-bold py-3.5 rounded-xl text-sm shadow-md">Update</button>
    </div>
</div>
@endsection