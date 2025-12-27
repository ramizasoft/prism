@extends('prism::layouts.app')

@section('body')
<div class="p-8 text-center">
    <h1 class="text-4xl font-bold mb-4">Welcome to Your Prism Brand Site</h1>
    <p class="text-lg text-gray-600 mb-8">This site is powered by the Prism Design Engine.</p>
    
    <div class="max-w-md mx-auto">
        <a href="/products/vitamin-c" class="inline-block bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition-opacity">
            View Example Product
        </a>
    </div>
</div>
@endsection
