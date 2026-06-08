@extends('layouts.app')
@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-black text-gray-800">Menu Items</h2>
        <a href="{{ route('admin.menu.create') }}" class="bg-red-500 text-white text-[10px] font-bold px-3 py-2 rounded-lg shadow-sm hover:bg-red-600 transition">
            + Add New Item
        </a>
    </div>

    <div class="space-y-3">
        @foreach($items as $item)
        <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center">
            
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/' . ($item->image ?? 'teh-ais.jpg')) }}" 
                     class="w-12 h-12 rounded-lg object-cover bg-gray-100 border border-gray-50">
                <div>
                    <h3 class="font-extrabold text-sm text-gray-800">{{ $item->name }}</h3>
                    <p class="text-xs font-black text-red-500">RM {{ number_format($item->price, 2) }}</p>
                </div>
            </div>

            <div class="flex space-x-2">
                <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 flex items-center justify-center font-bold text-xs border border-gray-100 hover:bg-gray-200">
                    ✏️
                </button>
                <button class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center font-bold text-xs border border-red-100 hover:bg-red-100">
                    🗑️
                </button>
            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection