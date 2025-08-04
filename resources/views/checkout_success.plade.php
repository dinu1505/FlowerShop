@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-emerald-50 px-4 py-12">
    <div class="bg-white p-8 rounded-lg shadow-md text-center max-w-md w-full">
        <svg class="mx-auto mb-4 text-green-500 w-16 h-16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <h2 class="text-2xl font-bold text-emerald-600 mb-2">Order Successful!</h2>
        <p class="text-gray-600 mb-6">Thank you for your purchase. Your bouquet is on its way!</p>
        <a href="{{ route('index') }}" class="inline-block px-6 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-md hover:bg-emerald-700 transition">
            Go Back to Home
        </a>
    </div>
</div>
@endsection
