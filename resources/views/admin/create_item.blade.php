@extends('layouts.app')
@section('content')
<div class="p-4 flex-1 overflow-y-auto bg-gray-50">
    
    <div class="flex items-center space-x-2 mb-6">
        <a href="{{ route('admin.menu.items') }}" class="text-gray-800 text-xl font-bold">←</a>
        <h2 class="text-lg font-black text-gray-800">Add New Item</h2>
    </div>

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div>
            <label class="block text-gray-700 font-bold text-xs mb-1">Item Name</label>
            <input type="text" name="name" required class="w-full p-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-red-500">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-bold text-xs mb-1">Category</label>
                <select name="category" class="w-full p-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-red-500">
                    <option value="foods">Foods</option>
                    <option value="drinks">Drinks</option>
                    <option value="snacks">Snacks</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold text-xs mb-1">Price (RM)</label>
                <input type="number" step="0.01" name="price" required class="w-full p-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-red-500">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-bold text-xs mb-1">Upload Image</label>
            <input type="file" name="image" class="w-full p-2 bg-white rounded-lg border border-gray-200 text-sm">
        </div>

        <div>
            <label class="block text-gray-700 font-bold text-xs mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full p-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-red-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3.5 rounded-xl shadow-lg mt-4">Save Item</button>
    </form>

</div>
@endsection