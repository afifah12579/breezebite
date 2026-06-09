@extends('layouts.app')

@section('content')
<div class="p-5 flex flex-col h-full bg-white">
    
    <div class="mb-4">
        <a href="{{ route('customer.welcome') }}" class="inline-flex items-center text-slate-400 hover:text-red-500 transition-colors font-bold text-sm">
            <span class="mr-1">←</span> Back
        </a>
    </div>

    <div class="text-center mb-6">
        <h2 class="text-xl font-black text-slate-800 tracking-tight">Choose Your Table</h2>
        <p class="text-xs font-bold text-slate-400 mt-0.5">Tap on a table to select</p>
    </div>

    <div class="grid grid-cols-4 gap-3">
        @for($i = 1; $i <= 20; $i++)
            <form action="{{ route('customer.selectTable') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="table_number" value="{{ $i }}">
                <button type="submit" 
                    class="w-full aspect-square flex items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 text-slate-700 font-black text-sm hover:bg-red-500 hover:text-white transition-all duration-200">
                    {{ $i }}
                </button>
            </form>
        @endfor
    </div>
</div>
@endsection