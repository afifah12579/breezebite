@extends('layouts.app')

@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-black text-gray-800">Menu Items (Admin)</h2>
        <a href="{{ route('admin.menu.create') }}" class="bg-red-500 text-white text-[10px] font-bold px-3 py-2 rounded-lg shadow-sm hover:bg-red-600 transition">
            + Add New Item
        </a>
    </div>

    <div class="flex space-x-6 border-b border-gray-200 mb-4 text-sm font-bold">
        <a href="{{ route('admin.orders') }}" class="text-gray-400 hover:text-gray-600 pb-3 px-1 transition">
            📦 Orders
        </a>
        <a href="{{ route('admin.menu.items') }}" class="border-b-2 border-red-500 text-red-500 pb-3 px-1">
            🍔 Menu Items
        </a>
    </div>

    <div class="flex space-x-6 border-b border-gray-200 mb-6 text-xs font-bold bg-white p-3 rounded-xl border border-gray-100 shadow-xs">
        <span id="tab-foods" onclick="switchCategory('foods')" class="category-tab text-red-500 font-black border-b-2 border-red-500 pb-2 cursor-pointer transition-all">Foods</span>
        <span id="tab-drinks" onclick="switchCategory('drinks')" class="category-tab text-gray-400 font-bold pb-2 cursor-pointer transition-all">Drinks</span>
        <span id="tab-snacks" onclick="switchCategory('snacks')" class="category-tab text-gray-400 font-bold pb-2 cursor-pointer transition-all">Snacks</span>
    </div>

    <div id="menu-containers">
        
        <div id="section-foods" class="menu-section space-y-3">
            @forelse($foods as $item)
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/' . ($item->image ?? 'default.jpg')) }}" 
                             class="w-12 h-12 rounded-lg object-cover bg-gray-100 border border-gray-50"
                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                        <div>
                            <h3 class="font-extrabold text-sm text-gray-800">{{ $item->name }}</h3>
                            <p class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.menu.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 flex items-center justify-center font-bold text-xs border border-gray-100 hover:bg-gray-200">✏️</a>
                        <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" class="m-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center font-bold text-xs border border-red-100 hover:bg-red-100">🗑️</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-400 text-xs font-bold bg-white rounded-xl border border-dashed">No food items available.</div>
            @endforelse
        </div>

        <div id="section-drinks" class="menu-section space-y-3 hidden">
            @forelse($drinks as $item)
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/' . ($item->image ?? 'default.jpg')) }}" 
                             class="w-12 h-12 rounded-lg object-cover bg-gray-100 border border-gray-50"
                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                        <div>
                            <h3 class="font-extrabold text-sm text-gray-800">{{ $item->name }}</h3>
                            <p class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.menu.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 flex items-center justify-center font-bold text-xs border border-gray-100 hover:bg-gray-200">✏️</a>
                        <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" class="m-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center font-bold text-xs border border-red-100 hover:bg-red-100">🗑️</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-400 text-xs font-bold bg-white rounded-xl border border-dashed">No drink items available.</div>
            @endforelse
        </div>

        <div id="section-snacks" class="menu-section space-y-3 hidden">
            @forelse($snacks as $item)
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/' . ($item->image ?? 'default.jpg')) }}" 
                             class="w-12 h-12 rounded-lg object-cover bg-gray-100 border border-gray-50"
                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                        <div>
                            <h3 class="font-extrabold text-sm text-gray-800">{{ $item->name }}</h3>
                            <p class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.menu.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 flex items-center justify-center font-bold text-xs border border-gray-100 hover:bg-gray-200">✏️</a>
                        <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" class="m-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center font-bold text-xs border border-red-100 hover:bg-red-100">🗑️</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-400 text-xs font-bold bg-white rounded-xl border border-dashed">No snack items available.</div>
            @endforelse
        </div>

    </div>
</div>

<script>
function switchCategory(category) {
    // Sembunyikan semua section
    document.querySelectorAll('.menu-section').forEach(section => {
        section.classList.add('hidden');
    });

    // Set semua warna tab jadi kelabu (inactive)
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.classList.remove('text-red-500', 'font-black', 'border-b-2', 'border-red-500');
        tab.classList.add('text-gray-400', 'font-bold');
    });

    // Paparkan section yang dipilih
    document.getElementById('section-' + category).classList.remove('hidden');

    // Aktifkan tab warna merah pada tab yang dipilih
    let activeTab = document.getElementById('tab-' + category);
    activeTab.classList.remove('text-gray-400', 'font-bold');
    activeTab.classList.add('text-red-500', 'font-black', 'border-b-2', 'border-red-500');
}
</script>
@endsection