@extends('layouts.app')
@section('content')
<div class="p-5 flex-1 flex flex-col bg-white">
    <h2 class="text-xl font-black mb-6">Confirm Your Order</h2>
    
    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-6 space-y-2">
        <p class="text-sm font-bold">Table Number: {{ session('table_number') }}</p>
        <p class="text-sm font-bold">Order Type: {{ session('order_type') }}</p>
    </div>

    <div class="space-y-4 mb-8">
        @foreach(session('cart', []) as $item)
            <div class="flex justify-between text-sm">
                <span>{{ $item['quantity'] }}x {{ $item['name'] }}</span>
                <span class="font-bold">RM {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </div>
        @endforeach
    </div>

    <div class="flex justify-between font-black text-lg border-t pt-4">
        <span>Total:</span>
        <span class="text-red-500">RM {{ number_format($total, 2) }}</span>
    </div>

    <form action="{{ route('customer.order.place') }}" method="POST">
    @csrf <button type="submit" class="w-full bg-amber-950 text-white font-black py-4 rounded-2xl">
        Confirm Order
    </button>
</form>
</div>
@endsection