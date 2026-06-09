@extends('layouts.app')

@section('content')
<div class="h-full flex flex-col bg-slate-50/50">

    <div class="px-5 pt-5 pb-0 bg-slate-50/50">
        <div class="mb-4">
            <a href="{{ route('customer.welcome') }}" 
               class="inline-flex items-center text-slate-500 hover:text-red-600 transition-colors font-bold text-sm">
                <span class="mr-2 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm border border-slate-100">←</span> 
                Back
            </a>
        </div>
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <span class="text-xs font-black tracking-widest text-red-500 uppercase">WELCOME TO</span>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Breeze Bite</h1>
                
                @if(session()->has('order_type'))
                    <div class="mt-2 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 px-2.5 py-1 rounded-xl text-[11px] font-black border border-red-100 shadow-2xs">
                            <span>{{ session('order_type') == 'Dine-in' ? '🍽️' : '🛍️' }}</span>
                            {{ session('order_type') }}
                        </span>
                        @if(session('order_type') == 'Dine-in' && session()->has('table_number'))
                            <span class="bg-slate-200/60 text-slate-700 px-2.5 py-1 rounded-xl text-[11px] font-black border border-slate-200">
                                Table {{ session('table_number') }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>
            
            <a href="{{ route('customer.cart') }}" class="relative group bg-white p-3 rounded-2xl shadow-xs border border-slate-100 hover:border-red-100 transition-all">
                <span class="text-xl">🛒</span>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center animate-bounce">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
        </div>

        <div class="flex space-x-6 border-b border-gray-100 pb-3">
            <span id="tab-foods" onclick="switchCategory('foods')" class="category-tab text-red-500 font-black border-b-2 border-red-500 pb-3 cursor-pointer">Foods</span>
            <span id="tab-drinks" onclick="switchCategory('drinks')" class="category-tab text-gray-400 font-bold pb-3 cursor-pointer">Drinks</span>
            <span id="tab-snacks" onclick="switchCategory('snacks')" class="category-tab text-gray-400 font-bold pb-3 cursor-pointer">Snacks</span>
        </div>
    </div>

    <div id="menu-containers" class="flex-1 overflow-y-auto p-5 custom-scrollbar">
        
        <div id="section-foods" class="menu-section grid grid-cols-2 gap-4">
            @forelse($foods as $item)
                <a href="{{ route('customer.showItem', $item->id) }}" class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">
                    <div>
                        <div class="w-full aspect-square max-h-28 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                            <img src="{{ asset('images/' . ($item->image ?? 'default.jpg')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->name }}">
                        </div>
                        <h3 class="font-black text-slate-800 text-xs line-clamp-2">{{ $item->name }}</h3>
                    </div>
                    <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                        <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                        <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold">➔</div>
                    </div>
                </a>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-400 text-sm font-bold">No food items available.</div>
            @endforelse
        </div>

        <div id="section-drinks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($drinks as $item)
                <a href="{{ route('customer.showItem', $item->id) }}" class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">
                    <div>
                        <div class="w-full aspect-square max-h-28 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                            <img src="{{ asset('images/' . ($item->image ?? 'teh-ais.jpg')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->name }}">
                        </div>
                        <h3 class="font-black text-slate-800 text-xs line-clamp-2">{{ $item->name }}</h3>
                    </div>
                    <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                        <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                        <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold">➔</div>
                    </div>
                </a>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-400 text-sm font-bold">No drinks available.</div>
            @endforelse
        </div>

        <div id="section-snacks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($snacks as $item)
                <a href="{{ route('customer.showItem', $item->id) }}" class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">
                    <div>
                        <div class="w-full aspect-square max-h-28 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                            <img src="{{ asset('images/' . ($item->image ?? 'kentang.jpg')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->name }}">
                        </div>
                        <h3 class="font-black text-slate-800 text-xs line-clamp-2">{{ $item->name }}</h3>
                    </div>
                    <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                        <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                        <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold">➔</div>
                    </div>
                </a>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-400 text-sm font-bold">No snacks available.</div>
            @endforelse
        </div>

    </div>
</div>

<script>
    function switchCategory(category) {
        document.querySelectorAll('.menu-section').forEach(section => section.classList.add('hidden'));
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.classList.remove('text-red-500', 'font-black', 'border-b-2', 'border-red-500');
            tab.classList.add('text-gray-400', 'font-bold');
        });
        document.getElementById('section-' + category).classList.remove('hidden');
        let activeTab = document.getElementById('tab-' + category);
        activeTab.classList.remove('text-gray-400', 'font-bold');
        activeTab.classList.add('text-red-500', 'font-black', 'border-b-2', 'border-red-500');
    }
</script>
@endsection