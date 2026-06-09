@extends('layouts.app')
@section('content')
<div class="bg-red-500 p-6 flex-1 flex flex-col justify-between text-white">
    <div class="text-center mt-12">
        <h1 class="text-4xl font-black tracking-wide">BreezeBite</h1>
        <h2 class="text-2xl font-bold mt-10">Welcome Back!</h2>
        <p class="text-xs opacity-80 mt-1 font-medium">Please sign in to continue</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-4 my-auto text-gray-800">
        @csrf
        @if($errors->any())
            <div class="bg-red-700 text-white p-3 rounded-lg text-xs font-bold">{{ $errors->first() }}</div>
        @endif
        <div class="flex justify-center my-6">
    <img src="{{ asset('images/logo.png') }}" alt="BreezeBite Logo" class="w-48 h-auto">
</div>
        <div>
            <label class="block text-white font-bold text-xs mb-1">Email</label>
            <input type="email" name="email" class="w-full p-3.5 rounded-lg bg-white text-sm shadow-inner focus:outline-none" placeholder="Enter your email" required font-medium>
        </div>
        <div>
            <label class="block text-white font-bold text-xs mb-1">Password</label>
            <input type="password" name="password" class="w-full p-3.5 rounded-lg bg-white text-sm shadow-inner focus:outline-none" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3.5 rounded-xl shadow-lg mt-6 hover:bg-black transition-all">Login</button>
    </form>
    <div class="text-center text-[10px] opacity-40 pb-2">&copy; 2026 BreezeBite System</div>
</div>
@endsection