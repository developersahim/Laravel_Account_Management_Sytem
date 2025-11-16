@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <h4 class="text-xl font-semibold text-gray-800">Edit Category</h4>

    <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Name</label>
            <input name="name" value="{{ old('name', $category->name) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Type -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Type</label>
            <select name="type" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="income" {{ $category->type=='income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ $category->type=='expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>

        <!-- Note -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Note</label>
            <textarea name="note"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      rows="4">{{ old('note', $category->note) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Update
            </button>
            <a href="{{ route('categories.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">
                Back
            </a>
        </div>

    </form>

</div>
@endsection
