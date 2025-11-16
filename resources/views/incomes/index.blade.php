@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <h2 class="text-2xl font-semibold text-gray-800">Income List</h2>

    <!-- Action Buttons -->
    <div class="flex gap-2 mb-4">
        <a href="{{ route('incomes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Add Income</a>
        <a href="{{ route('dashboard') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Back to Dashboard</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="flex flex-wrap gap-2 items-center mb-4">
        <input type="date" name="from" value="{{ request('from') }}"
               class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <input type="date" name="to" value="{{ request('to') }}"
               class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Filter</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Income Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Payer</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Amount</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Category</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Description</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($incomes as $income)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $income->payer ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $income->amount }}</td>
                    <td class="px-4 py-2">{{ $income->category->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $income->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $income->description ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">

                        <a href="{{ route('incomes.edit', $income) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-sm">Edit</a>

                        <!-- Delete Button -->
                        <button type="button" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                onclick="document.getElementById('deleteModal{{ $income->id }}').classList.remove('hidden')">
                            Delete
                        </button>

                        <!-- Delete Modal -->
                        <div id="deleteModal{{ $income->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black opacity-40"></div>

                            <!-- Modal content -->
                            <div class="bg-white rounded-lg shadow-lg z-50 w-96 relative">
                                <div class="p-4 border-b">
                                    <h5 class="text-lg font-semibold">Confirm Delete</h5>
                                </div>
                                <div class="p-4 text-gray-700">
                                    Are you sure you want to delete "<strong>{{ $income->payer ?? '-' }}</strong>"? This action cannot be undone.
                                </div>
                                <div class="p-4 border-t flex justify-end gap-2">
                                    <button class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" 
                                            onclick="document.getElementById('deleteModal{{ $income->id }}').classList.add('hidden')">Cancel</button>
                                    <form method="POST" action="{{ route('incomes.destroy', $income->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-2">No income found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $incomes->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>

</div>
@endsection
