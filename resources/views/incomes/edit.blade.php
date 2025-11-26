@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-xl mx-auto">

    <h2 class="text-2xl text-gray-400 font-bold">Edit Income</h2>

    <form action="{{ route('incomes.update', $income) }}" method="POST" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Payer -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Payer</label>
            <input type="text" name="payer" value="{{ old('payer', $income->payer) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('payer')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Amount -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $income->amount) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('amount')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Category</label>
            <select name="category_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">--Select--</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $income->category_id)==$category->id?'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', $income->date->format('Y-m-d')) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('date')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $income->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button type="submit" class="glass-card bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Update</button>
            <a href="{{ route('incomes.index') }}" class="glass-card bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">Back</a>
        </div>

    </form>

</div>
@endsection
