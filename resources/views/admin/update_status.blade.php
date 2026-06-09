@extends('layouts.app')
@section('content')
<div class="p-4 flex-1 flex flex-col justify-between">
    <div>
        <div class="flex items-center space-x-2 mb-6">
            <a href="{{ route('admin.orders') }}" class="text-gray-800 text-xl font-bold">←</a>
            <h2 class="text-lg font-black text-gray-800">Update Order Status</h2>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 space-y-3 text-sm font-bold text-gray-600 mb-6">
            <div class="flex justify-between"><span>Order ID</span><span class="text-gray-900">#ORD120{{ $order->id }}</span></div>
            <div class="flex justify-between"><span>Table</span><span class="text-gray-900">Table {{ $order->table_number }}</span></div>
            <div class="flex justify-between"><span>Order Type</span><span class="text-gray-900">{{ $order->order_type }}</span></div>
            <div class="flex justify-between text-base font-black pt-2 border-t text-gray-800"><span>Total</span><span class="text-red-500">RM {{ number_format($order->total_price, 2) }}</span></div>
            
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

    <div class="flex space-x-3">
        <a href="{{ route('admin.orders') }}" class="w-1/2 text-center bg-gray-100 text-gray-600 font-bold py-3.5 rounded-xl text-sm">Cancel</a>
        <button type="submit" form="status-form" class="w-1/2 bg-gray-900 text-white font-bold py-3.5 rounded-xl text-sm shadow-md">Update</button>
    </div>
</div>
@endsection