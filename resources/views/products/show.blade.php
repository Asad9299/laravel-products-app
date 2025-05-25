@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View Product
    </h2>
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">{{ $product->title }}</h1>

        @if ($product->description)
            <p class="mb-2"><strong>Description:</strong> {{ $product->description }}</p>
        @endif
        <p class="mb-2"><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
        <p class="mb-4"><strong>Quantity:</strong> {{ $product->quantity }}</p>

        <div class="mb-4">
            <strong>Images:</strong>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                @forelse($product->images as $image)
                    @if (file_exists(public_path('storage/' . $image->path)))
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                             class="w-full h-40 object-cover rounded shadow">
                    @else
                        <p class="text-gray-500">Image not found.</p>
                    @endif
                @empty
                    <p class="text-gray-500 col-span-3">No images available.</p>
                @endforelse
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('products.index') }}"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Back to Products
            </a>
        </div>
    </div>
</div>
@endsection
