@extends('layouts.app')

@section('content')
<div class="h-full flex flex-col items-center justify-center p-8 bg-white">
    
    <div class="text-center mb-12">
        <div class="w-24 h-24 mx-auto mb-6 bg-slate-50 rounded-full flex items-center justify-center border-4 border-slate-50 shadow-inner">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
        </div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">BreezeBite</h1>
        <p class="text-slate-400 font-bold text-xs mt-2 uppercase tracking-widest">Eat | Order | Repeat</p>
    </div>

    <div class="w-full space-y-4">
        <p class="text-center text-sm font-bold text-slate-600 mb-6">Where would you like to enjoy your meal?</p>
        
        <a href="{{ route('customer.dinein.select') }}" 
           class="group flex items-center justify-between p-5 border-2 border-slate-100 rounded-3xl hover:border-red-500 hover:bg-red-50 transition-all duration-300 shadow-sm hover:shadow-md">
            <div class="flex items-center space-x-4">
                <span class="text-2xl">🍽️</span>
                <span class="font-black text-slate-700 group-hover:text-red-600">Dine-in</span>
            </div>
            <span class="text-slate-300 group-hover:text-red-500">➔</span>
        </a>

        <a href="{{ route('customer.takeaway.details') }}" 
           class="group flex items-center justify-between p-5 border-2 border-slate-100 rounded-3xl hover:border-red-500 hover:bg-red-50 transition-all duration-300 shadow-sm hover:shadow-md">
            <div class="flex items-center space-x-4">
                <span class="text-2xl">🛍️</span>
                <span class="font-black text-slate-700 group-hover:text-red-600">Takeaway</span>
            </div>
            <span class="text-slate-300 group-hover:text-red-500">➔</span>
        </a>
    </div>

</div>
@endsection