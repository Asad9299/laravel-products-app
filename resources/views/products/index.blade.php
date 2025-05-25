@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Products List
    </h2>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">

        <!-- Create Product Button -->
        @if(auth()->user()->isAdmin())
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                Create Product
            </a>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('products.index') }}" class="mt-4">
            <div class="flex items-center gap-2">
                <!-- Search input -->
                <input type="text" name="search" placeholder="Search by title"
                    value="{{ request('search') }}"
                    class="px-4 py-2 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:border-blue-300">
                
                <!-- Search button -->    
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Search
                </button>
                <!-- Clear button -->
                <a href="{{ route('products.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Clear
                </a>
            </div>
        </form>

        <!-- Products Table -->
        <table class="table-auto w-full bg-white shadow-md rounded mt-4">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Price</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        {{ $product->title }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $product->price }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $product->quantity }}
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                            <!-- View Button -->
                            @can('view', $product)
                                <a href="{{ route('products.show', $product) }}"
                                class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    View
                                </a>
                            @endcan
                            <!-- Edit Button -->
                            @can('update', $product)
                                <a href="{{ route('products.edit', $product) }}"
                                class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-sm font-medium rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    Edit
                                </a>
                            @endcan

                            <!-- Delete Button -->
                            @can('delete', $product)
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
