@extends('layouts.app')

@section('content')
<div class="h-screen flex flex-col items-center justify-center bg-white p-5 text-center">
    
    <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-6">
        <span class="text-4xl">✅</span>
    </div>

    <h1 class="text-2xl font-black text-slate-800 mb-1">Order Successful!</h1>
    
    <div class="my-4">
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Order Number</p>
        <h2 class="text-4xl font-black text-red-500">
            #ORD{{ str_pad(App\Models\Order::latest()->first()->id ?? 0, 4, '0', STR_PAD_LEFT) }}
        </h2>
    </div>

    <p class="text-slate-600 font-bold text-sm mb-8 px-6">
        Please wait a moment. Your food is currently being prepared by our kitchen!
    </p>

    <a href="{{ url('/') }}" class="w-full max-w-xs bg-slate-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-slate-800 transition-all block text-center mx-auto">
        Back to Home
    </a>
</div>
@endsection