@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Users List
    </h2>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Search Form -->
        <form method="GET" action="{{ route('users') }}" class="mb-4">
            <div class="flex items-center gap-2">
                <!-- Search input -->
                <input type="text" name="search" placeholder="Search by name"
                    value="{{ request('search') }}"
                    class="px-4 py-2 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:border-blue-300">

                <!-- Search button -->    
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
                <!-- Clear button -->
                <a href="{{ route('users') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Clear</a>
            </div>
        </form>

        <!-- Users Table -->
        <table class="table-auto w-full bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        {{ $user->name }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $user->roles->pluck('name')->join(', ') }}
                    </td>
                    @if (!$user->isAdmin())
                        <td class="px-4 py-2" >
                            @can('delete', $user)
                            <form action="{{ route('user.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    @else
                        <td class="px-4 py-2">
                            <span class="text-gray-500">-</span>
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
