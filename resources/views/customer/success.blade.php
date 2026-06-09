@extends('layouts.app')
@section('content')
<div class="p-6 text-center my-auto">
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 text-green-600">✓</div>
    <h2 class="text-2xl font-black text-gray-800">Order Placed Successfully!</h2>
    <p class="text-sm text-gray-400 mt-2 font-medium px-4 leading-relaxed">We've sent your order to the kitchen</p>
    <a href="{{ route('customer.welcome') }}" class="mt-8 inline-block bg-gray-900 text-white font-bold px-8 py-3 rounded-xl text-sm shadow-md">
    Back to Start
</a>
</div>
@endsection