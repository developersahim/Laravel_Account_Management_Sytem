@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-semibold text-gray-800">Add Expense</h2>

    <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium text-gray-700">Payee</label>
            <input type="text" name="payee" value="{{ old('payee') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('payee') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            @error('amount') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Category</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                <option value="">--Select--</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Date</label>
            <input type="date" name="date" value="{{ old('date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            @error('date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Description</label>
            <textarea name="description" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Save</button>
            <a href="{{ route('expenses.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Back</a>
        </div>
    </form>
</div>
@endsection
