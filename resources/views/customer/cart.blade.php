@extends('layouts.app')

@section('content')
<div class="p-5 flex-1 flex flex-col bg-slate-50/50">
    <div class="flex items-center space-x-3 mb-6">
        <a href="{{ route('customer.menu') }}" class="w-8 h-8 rounded-full bg-white border border-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600 hover:bg-slate-100 transition-all transform rotate-180">
            ➔
        </a>
        <h1 class="text-xl font-black text-slate-800 tracking-tight">My Basket</h1>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs font-bold p-3 rounded-xl mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex-1 flex flex-col justify-between">
        <div class="space-y-3">
            @php $subtotal = 0; @endphp
            @forelse(session('cart', []) as $id => $details)
                @php $subtotal += $details['price'] * $details['quantity']; @endphp
                
                <div class="bg-white rounded-2xl p-3 border border-slate-100 flex items-center justify-between shadow-xs">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/' . ($details['image'] ?? 'nasi-kerabu.jpg')) }}" 
                             class="w-12 h-12 rounded-xl object-cover border border-slate-100 bg-slate-50"
                             onerror="this.onerror=null; this.src='https://placehold.co/100x100/e2e8f0/94a3b8?text=Food';">
                        
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-xs tracking-tight mb-1">{{ $details['name'] }}</h3>
                            <span class="text-[11px] font-black text-red-500 block">RM {{ number_format($details['price'], 2) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-xs font-bold text-slate-400">x{{ $details['quantity'] }}</span>
                        
                        <form action="{{ route('customer.cart.remove', $id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm p-1.5 text-slate-300 hover:text-red-500 transition-colors">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <span class="text-3xl block mb-2">🛒</span>
                    <p class="text-xs text-slate-400 font-bold">Your basket is empty!</p>
                </div>
            @endforelse
        </div>

        @if(count(session('cart', [])) > 0)
            @php 
                // Kira caj pembungkusan sekiranya Takeaway
                $packagingCharge = session('order_type') == 'Takeaway' ? ($subtotal * 0.05) : 0;
                $grandTotal = $subtotal + $packagingCharge;
            @endphp

            <div class="mt-8 pt-4 border-t border-slate-200/60 flex flex-col space-y-2.5">
                <div class="flex justify-between items-center text-slate-500">
                    <span class="text-xs font-bold">Subtotal</span>
                    <span class="text-xs font-extrabold text-slate-700">RM {{ number_format($subtotal, 2) }}</span>
                </div>

                @if(session('order_type') == 'Takeaway')
                    <div class="flex justify-between items-center text-red-500">
                        <span class="text-xs font-bold">Packaging Charge (5%)</span>
                        <span class="text-xs font-black">RM {{ number_format($packagingCharge, 2) }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center pt-2 border-t border-dashed border-slate-200 mb-4">
                    <span class="text-xs font-bold text-slate-600">Total Price</span>
                    <span class="text-base font-black text-slate-800">RM {{ number_format($grandTotal, 2) }}</span>
                </div>

                <form action="{{ route('customer.order.place') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-amber-950 text-white font-black py-4 rounded-2xl text-xs tracking-wide hover:bg-amber-900 transition-all shadow-md active:scale-[0.99]">
                        Place Order
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection