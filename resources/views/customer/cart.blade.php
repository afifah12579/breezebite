@extends('layouts.app')

@section('content')
<div class="p-5 flex-1 flex flex-col justify-between bg-white">
    <div>
        <div class="mb-5">
            <a href="{{ route('customer.menu') }}" class="text-slate-800 hover:text-red-500 transition-colors font-black flex items-center space-x-1 decoration-none">
                <span class="text-xl">←</span>
                <span class="text-lg font-black tracking-tight ml-1">Your cart</span>
            </a>
            <p class="text-xs text-slate-400 font-medium mt-1">Please confirm your order details below.</p>
        </div>

        <div class="space-y-4 mb-6">
    @if(session('cart') && count(session('cart')) > 0)
        @foreach(session('cart') as $id => $details)
            <div class="flex items-center justify-between bg-slate-50/60 rounded-2xl p-3 border border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-xl bg-white border border-slate-100 overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('images/' . $details['image']) }}" 
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.src='{{ asset('images/nasi_lemak.jpg') }}';">
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800 text-sm leading-tight">{{ $details['name'] }}</h4>
                        <p class="text-xs font-black text-red-500 mt-0.5">RM {{ number_format($details['price'], 2) }}</p>
                    </div>
                </div>

                <div class="bg-white px-3 py-1.5 rounded-xl border border-slate-100 flex items-center gap-3 shadow-2xs">
                    <span class="text-xs font-black text-slate-700">{{ $details['quantity'] }}</span>
                    <span class="text-[10px] text-slate-400 font-bold">Items</span>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-12 text-slate-400 text-xs font-medium">Your selection tray is currently empty.</div>
    @endif
</div>

        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-slate-500">Table Number</span>
                <span class="font-black text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-100 shadow-2xs">04</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-slate-500">Order Type</span>
                <span class="font-black text-slate-800 bg-white px-3 py-1 rounded-lg border border-slate-100 shadow-2xs">Dine-in</span>
            </div>
        </div>
    </div>

    <div class="mt-8 pt-4 border-t border-slate-50">
        <div class="flex justify-between items-baseline mb-4">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total</span>
            <span class="text-2xl font-black text-red-500">RM 10.50</span>
        </div>

        <button type="button" class="w-full bg-red-500 hover:bg-red-600 active:scale-[0.98] text-white py-4 rounded-2xl font-black tracking-wide shadow-lg shadow-red-200 transition-all text-sm">
            Place Order
        </button>
    </div>
</div>
@endsection