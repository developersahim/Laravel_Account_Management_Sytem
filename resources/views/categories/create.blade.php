@extends('layouts.app')

@section('content')
<div class="space-y-6  max-w-xl mx-auto">

    <h4 class="text-xl font-semibold text-gray-800">Add Category</h4>

    <a href="{{ route('categories.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition mb-3">
        Back to List
    </a>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Name</label>
            <input name="name" value="{{ old('name') }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Type -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Type</label>
            <select name="type" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="income" {{ old('type')=='income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ old('type')=='expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>

        <!-- Note -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Note</label>
            <textarea name="note"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      rows="4">{{ old('note') }}</textarea>
        </div>

        <!-- Save Button -->
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Save
        </button>

    </form>

</div>
@endsection
