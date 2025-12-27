@extends('prism::layouts.app')

@section('body')
<div class="p-8">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-5xl font-bold mb-6">Prism Engine Documentation</h1>
        <p class="text-xl text-gray-600 mb-12">Learn how to build high-performance, compliant brand sites with Prism.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="p-6 border rounded-xl shadow-sm">
                <h2 class="text-2xl font-bold mb-2">🚀 Installation</h2>
                <p class="text-gray-600 mb-4">Get up and running in minutes.</p>
                <a href="/docs/installation" class="text-primary font-semibold hover:underline">Read Guide &rarr;</a>
            </div>
            
            <div class="p-6 border rounded-xl shadow-sm">
                <h2 class="text-2xl font-bold mb-2">⚙️ Configuration</h2>
                <p class="text-gray-600 mb-4">Master the config.php file.</p>
                <a href="/docs/configuration" class="text-primary font-semibold hover:underline">Read Reference &rarr;</a>
            </div>
            
            <div class="p-6 border rounded-xl shadow-sm">
                <h2 class="text-2xl font-bold mb-2">⚖️ Compliance</h2>
                <p class="text-gray-600 mb-4">FDA and AAFCO modes explained.</p>
                <a href="/docs/compliance" class="text-primary font-semibold hover:underline">Read Guide &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection