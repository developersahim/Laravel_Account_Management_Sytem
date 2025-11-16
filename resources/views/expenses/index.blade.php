@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <h2 class="text-2xl font-semibold text-gray-800">Expense List</h2>

    <div class="flex gap-2 mb-4">
        <a href="{{ route('expenses.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Add Expense</a>
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Back to Dashboard</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="flex flex-wrap gap-2 mb-4">
        <input type="date" name="from" value="{{ request('from') }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="From">
        <input type="date" name="to" value="{{ request('to') }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="To">
        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Filter</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Payee</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Amount</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Category</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Description</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($expenses as $expense)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $expense->payee ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $expense->amount }}</td>
                    <td class="px-4 py-2">{{ $expense->category->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $expense->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $expense->description ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">

                        <a href="{{ route('expenses.edit', $expense) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-sm">Edit</a>

                        <!-- Delete Button -->
                        <button type="button" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                onclick="document.getElementById('deleteModal{{ $expense->id }}').classList.remove('hidden')">
                            Delete
                        </button>

                        <!-- Delete Modal -->
                        <div id="deleteModal{{ $expense->id }}" class="fixed inset-0 bg-opacity-30 flex items-center justify-center hidden z-50">
                            <div class="bg-white rounded-lg shadow-lg w-96">
                                <div class="p-4 border-b">
                                    <h5 class="text-lg font-semibold">Confirm Delete</h5>
                                </div>
                                <div class="p-4 text-gray-700">
                                    Are you sure you want to delete the expense "<strong>{{ $expense->payee }}</strong>"? This action cannot be undone.
                                </div>
                                <div class="p-4 border-t flex justify-end gap-2">
                                    <button class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="document.getElementById('deleteModal{{ $expense->id }}').classList.add('hidden')">Cancel</button>
                                    <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
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
                    <td colspan="6" class="text-center px-4 py-2">No expense found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $expenses->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>

</div>
@endsection
