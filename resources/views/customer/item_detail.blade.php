@extends('layouts.app')

@section('content')
<div class="p-5 flex-1 flex flex-col bg-white">
    <div class="mb-4">
        <a href="{{ route('customer.menu') }}" class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600 hover:bg-slate-100 transition-all transform rotate-180">
            ➔
        </a>
    </div>

    <div class="w-full rounded-3xl overflow-hidden border border-slate-100 mb-5 bg-slate-50 flex items-center justify-center aspect-[4/3]">
    
    <img src="{{ asset('images/' . $item->image) }}" 
         class="w-full h-full object-cover" 
         alt="{{ $item->name }}"
         onerror="this.src='{{ asset('images/default.jpg') }}'">
</div>

    <div class="flex-1 flex flex-col justify-between">
        <div>
            <h1 class="text-xl font-black text-slate-800 tracking-tight mb-1">{{ $item->name }}</h1>
            <span class="text-sm font-black text-red-500 block mb-4">RM {{ number_format($item->price, 2) }}</span>
            
            <p class="text-xs text-slate-400 leading-relaxed font-medium">
                {{ $item->description ?? 'No description available for this item.' }}
            </p>
        </div>

        <form action="{{ route('customer.cart.add', $item->id) }}" method="POST" class="mt-8">
            @csrf
            <div class="flex items-center justify-center space-x-6 mb-6">
                <button type="button" onclick="decrementQty()" class="w-8 h-8 rounded-xl bg-amber-950 text-white font-black flex items-center justify-center text-sm shadow-xs hover:bg-amber-900 transition-all">-</button>
                <input type="number" name="quantity" id="quantity-input" value="1" min="1" class="w-10 text-center border-none font-black text-slate-800 text-sm p-0 focus:ring-0">
                <button type="button" onclick="incrementQty()" class="w-8 h-8 rounded-xl bg-amber-950 text-white font-black flex items-center justify-center text-sm shadow-xs hover:bg-amber-900 transition-all">+</button>
            </div>

            <button type="submit" class="w-full bg-amber-950 text-white font-black py-4 rounded-2xl text-xs tracking-wide hover:bg-amber-900 transition-all shadow-sm active:scale-[0.99]">
                Add to Cart
            </button>
        </form>
    </div>
</div>

<script>
function incrementQty() {
    let input = document.getElementById('quantity-input');
    input.value = parseInt(input.value) + 1;
}

function decrementQty() {
    let input = document.getElementById('quantity-input');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
@endsection