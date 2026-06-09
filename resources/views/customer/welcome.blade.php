@extends('layouts.app')

@section('content')
<div class="p-6 my-auto max-w-sm mx-auto">
    <div class="text-center mb-10">
        <img src="{{ asset('images/logo.png') }}" alt="BreezeBite Logo" class="mx-auto h-24 w-24 mb-4">
        <h1 class="text-3xl font-extrabold text-gray-900">BreezeBite</h1>
        <p class="text-sm text-gray-500 mt-2 font-medium">Welcome! How would you like to dine today?</p>
    </div>

    <div class="space-y-4">
        <a href="{{ route('customer.dinein.select') }}" 
           class="w-full flex items-center justify-between p-6 border-2 border-gray-200 rounded-2xl hover:border-red-500 hover:bg-red-50 transition-all group">
            <span class="font-bold text-gray-800 text-lg">Dine-in</span>
            <span class="text-2xl">🍽️</span>
        </a>

        <a href="{{ route('customer.takeaway.details') }}" 
   class="w-full flex items-center justify-between p-6 border-2 border-gray-200 rounded-2xl hover:border-red-500 hover:bg-red-50 transition-all group">
    <span class="font-bold text-gray-800 text-lg">Takeaway</span>
    <span class="text-2xl">🛍️</span>
</a>
    </div>
</div>
@endsection