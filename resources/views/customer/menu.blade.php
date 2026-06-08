@extends('layouts.app')

@section('content')
<div class="p-5 flex-1 flex flex-col bg-slate-50/50">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <span class="text-xs font-black tracking-widest text-red-500 uppercase">Welcome to</span>
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
        <!-- MAHA PENTING: Pastikan kad dibungkus dengan tag <a> ini untuk memicu perpindahan halaman -->
        <a href="{{ route('customer.showItem', $item->id) }}" class="group bg-white rounded-2xl p-4 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 block w-full">
            <div class="flex flex-col">
                <!-- BOX IMAGE -->
                <div class="w-full aspect-[21/9] rounded-xl overflow-hidden bg-slate-50 border border-slate-100 mb-3 flex items-center justify-center">
                    <img src="{{ asset('images/' . ($item->image ?? 'nasi-kerabu.jpg')) }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.onerror=null; this.src='{{ asset('images/nasi-kerabu.jpg') }}';">
                </div>
                
                <!-- INFO TEXT -->
                <div class="flex justify-between items-start mt-1">
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-sm tracking-tight mb-2">{{ $item->name }}</h3>
                        <span class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</span>
                    </div>
                    <div class="w-7 h-7 rounded-full bg-slate-50 group-hover:bg-red-500 text-slate-400 group-hover:text-white flex items-center justify-center text-[10px] font-bold transition-all shadow-xs">
                        ➔
                    </div>
                </div>
            </div>
        </a>
    @empty
       
    @endforelse
</div>

 <div id="section-drinks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($drinks as $item)
                <form action="{{ route('customer.cart.add', $item->id) }}" method="POST" id="add-form-{{ $item->id }}" class="m-0 block w-full">
                    @csrf
                    <div onclick="document.getElementById('add-form-{{ $item->id }}').submit();" 
                         class="group bg-white rounded-2xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-pointer h-full w-full box-border">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                                <img src="{{ asset('images/' .
($item->image ?? 'teh-ais.jpg')) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     onerror="this.onerror=null; this.src='{{ asset('images/teh-ais.jpg') }}';">
                            </div>
                            <h3 class="font-black text-slate-800 text-sm leading-tight tracking-tight group-hover:text-red-500 transition-colors line-clamp-2">
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
            
                {{-- this forces a beautiful placeholder item to show! --}}
                <form action="#" method="POST" class="m-0 block w-full col-span-2">
                    <div class="group bg-white rounded-2xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full w-full">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-xl overflow-hidden bg-white flex items-center justify-center border border-gray-100 mb-3">
                                <img src="{{ asset('images/teh-ais.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-gray-800 text-sm">Teh Ais (Local DB Fallback)</h3>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                            <span class="text-xs font-black text-red-500">RM 10.50</span>
                            <div class="w-6 h-6 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center text-[10px] font-bold">➔</div>
                        </div>
                    </div>
                </form>
            @endforelse
        </div>

        <div id="section-snacks" class="menu-section grid grid-cols-2 gap-4 hidden">
            @forelse($snacks as $item)
                <form action="{{ route('customer.cart.add', $item->id) }}" method="POST" id="add-form-{{ $item->id }}" class="m-0 block w-full">
                    @csrf
                    <div onclick="document.getElementById('add-form-{{ $item->id }}').submit();" 
                         class="group bg-white rounded-2xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-pointer h-full w-full box-border">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-xl bg-slate-50 overflow-hidden border border-slate-100/60 mb-3 relative flex items-center justify-center">
                                <!--<img src="{{ asset('images/' . ($item->image ?? 'kentang.jpg')) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     onerror="this.onerror=null; this.src='{{ asset('images/kentang.jpg') }}';">-->
                              <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&auto=format&fit=crop&q=60&sig={{ urlencode($item->name) }}" 
     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
     onerror="this.onerror=null; this.src='https://placehold.
co/600x400/e2e8f0/94a3b8?text=No+Image';"> 
                            </div>
                            <h3 class="font-black text-slate-800 text-sm leading-tight tracking-tight group-hover:text-red-500 transition-colors line-clamp-2">
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
                {{-- this forces a beautiful placeholder item to show! --}}
                <form action="#" method="POST" class="m-0 block w-full col-span-2">
                    <div class="group bg-white rounded-2xl p-3 border border-slate-100 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full w-full">
                        <div>
                            <div class="w-full aspect-square max-h-28 rounded-xl overflow-hidden bg-white flex items-center justify-center border border-gray-100 mb-3">
                                <img src="{{ asset('images/kentang.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-gray-800 text-sm">Kentang (Local DB Fallback)</h3>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-2 border-t border-slate-50">
                            <span class="text-xs font-black text-red-500">RM 10.50</span>
                            <div class="w-6 h-6 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center text-[10px] font-bold">➔</div>
                        </div>
                    </div>
                </form>
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