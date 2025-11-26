@extends('layouts.app')

@section('content')
<div class="space-y-6 relative">

    <!-- Page Title -->
    <h3 class="text-2xl font-semibold text-white">Categories</h3>

    <!-- Action Buttons -->
    <div class="flex gap-2 mb-4">
        <a href="{{ route('categories.create') }}" class="btn-glass px-4 py-2 rounded-lg hover:bg-green-500/20 transition">Add New Category</a>
        <a href="{{ route('dashboard') }}" class="btn-glass px-4 py-2 rounded-lg hover:bg-red-500/20 transition">Back to Dashboard</a>
    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto glass-card rounded-xl shadow-xl border border-white/10">
        <table class="min-w-full divide-y divide-white/20 text-white">
            <thead class="">
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Name</th>
                    <th class="px-4 py-2 text-left font-medium">Type</th>
                    <th class="px-4 py-2 text-left font-medium">Note</th>
                    <th class="px-4 py-2 text-left font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @foreach($categories as $category)
                <tr class="hover:bg-white/10 transition">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($category->type) }}</td>
                    <td class="px-4 py-2">{{ $category->note }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn-glass px-3 py-1 rounded hover:bg-blue-500/20 transition text-sm">Edit</a>
                        <button command="show-modal" commandfor="dialog{{ $category->id }}" class="btn-glass px-3 py-1 rounded hover:bg-red-500/20 text-sm">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 text-white">
        {{ $categories->links('vendor.pagination.tailwind') }}
    </div>

</div>

<!-- Modals -->
@foreach($categories as $category)
<dialog id="dialog{{ $category->id }}" class="hidden">
    <div class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="glass-card p-6 rounded-xl w-full max-w-md">
            <h3 class="text-xl font-semibold text-white">Delete Category</h3>
            <p class="mt-2 text-gray-300">Are you sure you want to delete "<strong>{{ $category->name }}</strong>"? This action cannot be undone.</p>

            <div class="mt-4 flex justify-end gap-2">
                <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-glass hover:bg-red-500/30 px-4 py-2 rounded text-white">Delete</button>
                </form>

                <button data-close="dialog{{ $category->id }}" class="btn-glass hover:bg-white/20 px-4 py-2 rounded text-white">Cancel</button>
            </div>
        </div>
    </div>
</dialog>
@endforeach

@endsection
