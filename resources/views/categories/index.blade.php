@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Page Title -->
    <h3 class="text-2xl font-semibold text-gray-800">Categories</h3>

    <!-- Action Buttons -->
    <div class="flex gap-2 mb-4">
        <a href="{{ route('categories.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Add New Category</a>
        <a href="{{ route('dashboard') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Back to Dashboard</a>
    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Type</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Note</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($category->type) }}</td>
                    <td class="px-4 py-2">{{ $category->note }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">Edit</a>

                        <!-- Delete Button -->
                        <button type="button" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm" 
                                onclick="document.getElementById('deleteModal{{ $category->id }}').classList.remove('hidden')">
                            Delete
                        </button>

                        <!-- Delete Modal -->
                        <div id="deleteModal{{ $category->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black opacity-40"></div>

                            <!-- Modal content -->
                            <div class="bg-white rounded-lg shadow-lg z-50 w-96 relative">
                                <div class="p-4 border-b">
                                    <h5 class="text-lg font-semibold">Confirm Delete</h5>
                                </div>
                                <div class="p-4 text-gray-700">
                                    Are you sure you want to delete the category "<strong>{{ $category->name }}</strong>"? This action cannot be undone.
                                </div>
                                <div class="p-4 border-t flex justify-end gap-2">
                                    <button class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" 
                                            onclick="document.getElementById('deleteModal{{ $category->id }}').classList.add('hidden')">Cancel</button>
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $categories->links('vendor.pagination.tailwind') }}
    </div>

</div>
@endsection
