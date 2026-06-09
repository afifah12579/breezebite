@extends('layouts.app')

@section('content')
<div class="p-5 flex-1 flex flex-col bg-slate-50/50">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <span class="text-xs font-black tracking-widest text-red-500 uppercase">WELCOME TO</span>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Breeze Bite</h1>
        </div>
        <a href="{{ route('customer.cart') }}" class="relative group bg-white p-3 rounded-2xl shadow-xs border border-slate-100 hover:border-red-100 transition-all">
            <span class="text-xl">🛒</span>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center animate-bounce">
                {{ count(session('cart', [])) }}
            </span>
        </a>
    </div>

    <div class="flex space-x-6 border-b border-gray-100 pb-3 mb-6">
        <span id="tab-foods" onclick="switchCategory('foods')" class="category-tab text-red-500 font-black border-b-2 border-red-500 pb-3 cursor-pointer">Foods</span>
        <span id="tab-drinks" onclick="switchCategory('drinks')" class="category-tab text-gray-400 font-bold pb-3 cursor-pointer">Drinks</span>
        <span id="tab-snacks" onclick="switchCategory('snacks')" class="category-tab text-gray-400 font-bold pb-3 cursor-pointer">Snacks</span>
    </div>

    <div id="menu-containers">
        
        <div id="section-foods" class="menu-section flex flex-col space-y-4">
            @forelse($foods as $item)
                @php
                    // Trik alternatif: menetapkan nama fail imej fizikal berdasarkan nama makanan di database
                    $imageName = 'nasi-kerabu.jpg'; // fail lalai jika tiada padanan
                    
                    if (str_contains(strtolower($item->name), 'kerabu')) {
                        $imageName = 'nasi-kerabu.jpg';
                    } elseif (str_contains(strtolower($item->name), 'chicken chop') || str_contains(strtolower($item->name), 'crispy')) {
                        $imageName = 'chicken_chop.jpg';
                    } elseif (str_contains(strtolower($item->name), 'lemak')) {
                        $imageName = 'nasi-lemak.jpg';
                    } elseif (str_contains(strtolower($item->name), 'kentang')) {
                        $imageName = 'kentang.jpg';
                    } elseif (str_contains(strtolower($item->name), 'keropok')) {
                        $imageName = 'keropok.jpg';
                    } elseif (str_contains(strtolower($item->name), 'soto')) {
                        $imageName = 'soto.png';
                    } elseif (str_contains(strtolower($item->name), 'spaghetti')) {
                        $imageName = 'Spaghetti.jpg';
                    } elseif (str_contains(strtolower($item->name), 'tomyam')) {
                        $imageName = 'tomyam.jpg';
                    }
                @endphp

                <a href="{{ route('customer.showItem', $item->id) }}" class="group bg-white rounded-3xl p-4 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 block w-full">
                    <div class="flex flex-col">

                        <div class="w-full aspect-[21/9] rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 mb-3 flex items-center justify-center">
                            <img src="{{ asset('images/' . $imageName) }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 alt="{{ $item->name }}">
                        </div>
                        
                        <div class="flex justify-between items-start mt-1">
                            <div>
                                <h3 class="font-extrabold text-slate-800 text-sm tracking-tight mb-1">{{ $item->name }}</h3>
                                <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                            </div>
                            <div class="w-7 h-7 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold transition-all shadow-xs">
                                ➔
                            </div>
                        </div>
                    </div>
                </a>
            @empty
               <div class="text-center py-8 text-gray-400 text-sm font-bold">No food items available.</div>
            @endforelse
        </div>

        <div id="section-drinks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($drinks as $item)
                <form action="{{ route('customer.cart.add', $item->id) }}" method="POST" id="add-form-{{ $item->id }}" class="m-0 block w-full">
                    @csrf
                    <div onclick="document.getElementById('add-form-{{ $item->id }}').submit();" 
                         class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-pointer h-full w-full box-border">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                                <img src="{{ asset('images/' . ($item->image ?? 'teh-ais.jpg')) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/94a3b8?text={{ urlencode($item->name) }}';">
                            </div>
                            <h3 class="font-black text-slate-800 text-xs leading-tight tracking-tight group-hover:text-red-500 transition-colors line-clamp-2">
                                {{ $item->name }}
                            </h3>
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                            <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                            <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold transition-all">➔</div>
                        </div>
                    </div>
                </form>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-400 text-sm font-bold">No drinks available.</div>
            @endforelse
        </div>

        <div id="section-snacks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($snacks as $item)
                <form action="{{ route('customer.cart.add', $item->id) }}" method="POST" id="add-form-{{ $item->id }}" class="m-0 block w-full">
                    @csrf
                    <div onclick="document.getElementById('add-form-{{ $item->id }}').submit();" 
                         class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-pointer h-full w-full box-border">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                                <img src="{{ asset('images/' . ($item->image ?? 'kentang.jpg')) }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/94a3b8?text={{ urlencode($item->name) }}';"> 
                            </div>
                            <h3 class="font-black text-slate-800 text-xs leading-tight tracking-tight group-hover:text-red-500 transition-colors line-clamp-2">
                                {{ $item->name }}
                            </h3>
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                            <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                            <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold transition-all">➔</div>
                        </div>
                    </div>
                </form>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-400 text-sm font-bold">No snacks available.</div>
            @endforelse
        </div>

    </div>
</div>

<script>
function switchCategory(category) {
    document.querySelectorAll('.menu-section').forEach(section => {
        section.classList.add('hidden');
    });

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