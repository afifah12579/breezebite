@extends('layouts.app')

@section('content')
<div class="p-6 my-auto max-w-2xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-900">Choose Your Table</h1>
        <p class="text-lg text-gray-500 mt-2">Tap on a table to select</p>
    </div>
    
    <div class="grid grid-cols-3 md:grid-cols-5 gap-6">
        @for ($i = 1; $i <= 15; $i++)
            <form action="{{ route('customer.selectTable') }}" method="POST">
                @csrf
                <input type="hidden" name="table_number" value="{{ $i }}">
                <button type="submit" 
                        class="w-full py-8 border-4 border-gray-100 rounded-2xl font-black text-2xl text-gray-600 hover:border-red-500 hover:bg-red-500 hover:text-white hover:scale-105 transition-all shadow-sm">
                    {{ $i }}
                </button>
            </form>
        @endfor
    </div>
</div>
@endsection