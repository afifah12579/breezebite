@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 flex flex-col justify-between p-5">
    
    <div>
        <div class="flex items-center space-x-3 mb-6">
            <a href="{{ route('customer.menu') }}" class="text-slate-700 hover:text-red-500 font-bold text-lg">←</a>
            <div>
                <h1 class="text-xl font-black text-slate-800 tracking-tight">Your cart</h1>
                <p class="text-xs text-slate-400 font-medium">Please confirm your order details below.</p>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            @forelse($cart as $id => $details)
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-xs flex items-center justify-between relative">
                    
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="w-14 h-14 bg-slate-50 rounded-xl overflow-hidden border border-slate-100 flex items-center justify-center">
                            <img src="{{ asset('images/' . ($details['image'] ?? 'nasi_lemak.jpg')) }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/nasi_lemak.jpg') }}';">
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-sm leading-tight mb-1">{{ $details['name'] }}</h3>
                            <span class="text-xs font-black text-slate-500 block">
                                RM {{ number_format($details['price'] * $details['quantity'], 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center bg-slate-50 rounded-xl p-1 border border-slate-100">
                            <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit" class="w-7 h-7 text-xs font-black text-slate-500 hover:text-red-500 flex items-center justify-center">-</button>
                            </form>
                            
                            <span class="w-6 text-center text-xs font-black text-slate-800">{{ $details['quantity'] }}</span>
                            
                            <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="action" value="increase">
                                <button type="submit" class="w-7 h-7 text-xs font-black text-slate-500 hover:text-red-500 flex items-center justify-center">+</button>
                            </form>
                        </div>

                        <form action="{{ route('customer.cart.remove', $id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl flex items-center justify-center text-xs transition-all shadow-xs" onclick="return confirm('Mahu buang item ini?')">
                                🗑️
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 text-center border border-slate-100 shadow-xs">
                    <span class="text-3xl block mb-2">📥</span>
                    <p class="text-xs text-slate-400 font-medium">Your cart is completely empty.</p>
                </div>
            @endforelse
        </div>

        @if(count($cart) > 0)
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-xs space-y-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="text-xs font-extrabold text-slate-500">Table Number</span>
                    <span class="bg-slate-50 px-3 py-1 rounded-lg text-xs font-black text-slate-800 border border-slate-100">04</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-extrabold text-slate-500">Order Type</span>
                    <span class="bg-slate-50 px-3 py-1 rounded-lg text-xs font-black text-slate-800 border border-slate-100">Dine-in</span>
                </div>
            </div>
        @endif
    </div>

    @if(count($cart) > 0)
        <div>
            <div class="flex justify-between items-center mb-4 px-1">
                <span class="text-[10px] font-black tracking-wider text-slate-400 uppercase">Total Price</span>
                <span class="text-xl font-black text-red-500">RM {{ number_format($total, 2) }}</span>
            </div>

            <form action="{{ route('customer.order.place') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white font-black py-4 rounded-2xl shadow-md hover:bg-red-600 transition-all text-sm tracking-wide transform active:scale-[0.99]">
                    Place Order
                </button>
            </form>
        </div>
    @endif

</div>
@endsection