@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 flex flex-col justify-between p-5">
    
    <div class="mb-4">
        <a href="{{ route('customer.menu') }}" class="w-10 h-10 bg-white shadow-xs border border-slate-100 rounded-full flex items-center justify-center text-slate-700 hover:text-red-500 transition-colors">
            <span class="text-sm font-bold">←</span>
        </a>
    </div>

    <div class="bg-white rounded-3xl p-4 shadow-xs border border-slate-100 flex-1 flex flex-col justify-between mb-2">
        <div>
            <div class="w-full aspect-square max-h-72 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 mb-5">
                <img src="{{ asset('images/' . ($item->image ?? 'nasi-kerabu.jpg')) }}" 
                     class="w-full h-full object-cover"
                     onerror="this.onerror=null; this.src='{{ asset('images/nasi-kerabu.jpg') }}';">
            </div>

            <div class="mb-4">
                <h1 class="text-xl font-black text-slate-800 tracking-tight mb-1">{{ $item->name }}</h1>
                <span class="text-base font-black text-red-500 block">RM {{ number_format($item->price, 2) }}</span>
            </div>

            <div class="mb-6">
                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                    {{ $item->description ?? 'Enjoy our delicious crafted choice menu item, carefully prepared with fresh quality premium local ingredients daily.' }}
                </p>
            </div>
        </div>

        <div>
            <form action="{{ route('customer.cart.add', $item->id) }}" method="POST">
                @csrf
                <div class="flex items-center justify-center space-x-6 mb-6">
                    <button type="button" onclick="decrementQty()" class="w-10 h-10 bg-amber-950 text-white rounded-xl font-black flex items-center justify-center shadow-xs hover:bg-amber-900 active:scale-95 transition-all text-lg">-</button>
                    <input type="number" id="quantity-input" name="quantity" value="1" min="1" class="w-12 text-center font-extrabold text-slate-800 text-base border-0 focus:ring-0 p-0 bg-transparent">
                    <button type="button" onclick="incrementQty()" class="w-10 h-10 bg-amber-950 text-white rounded-xl font-black flex items-center justify-center shadow-xs hover:bg-amber-900 active:scale-95 transition-all text-lg">+</button>
                </div>

                <button type="submit" class="w-full bg-amber-950 text-white font-black py-4 rounded-2xl shadow-md hover:bg-amber-900 transition-all text-sm tracking-wide transform active:scale-[0.99]">
                    Add to Cart
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    const qtyInput = document.getElementById('quantity-input');

    function incrementQty() {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    }

    function decrementQty() {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    }
</script>
@endsection