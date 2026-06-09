@extends('layouts.app')

@section('content')
<div class="h-screen flex flex-col items-center justify-center bg-white p-5 text-center">
    
    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
        <span class="text-4xl">✅</span>
    </div>

    <h1 class="text-2xl font-black text-slate-800 mb-2">Order Successful!</h1>
    <p class="text-slate-500 font-bold text-sm mb-8">
        Your food is being prepared. Thank you for choosing Breeze Bite!
    </p>

    <a href="{{ route('customer.menu') }}" class="w-full max-w-xs bg-slate-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-slate-800 transition-all">
        Back to Menu
    </a>
</div>
@endsection