@extends('layouts.app')

@section('content')
<div class="space-y-6 relative">

    <h2 class="text-2xl font-semibold text-white">Expense List</h2>

    <div class="flex gap-2 mb-4">
        <a href="{{ route('expenses.create') }}" class="btn-glass px-4 py-2 rounded hover:bg-red-500/20">Add Expense</a>
        <a href="{{ route('dashboard') }}" class="btn-glass px-4 py-2 rounded hover:bg-gray-200/10">Back to Dashboard</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="flex flex-wrap gap-2 mb-4">
        <input type="date" name="from" value="{{ request('from') }}" class="glass-card px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500">
        <input type="date" name="to" value="{{ request('to') }}" class="glass-card px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500">
        <button type="submit" class="btn-glass px-4 py-2 rounded hover:bg-gray-200/10">Filter</button>
    </form>

    <div class="overflow-x-auto glass-card rounded-xl shadow-xl border border-white/10">
        <table class="min-w-full divide-y divide-white/20 text-white ">
            <thead class="">
                <tr>
                    <th class="px-4 py-2 text-left font-bold">Payee</th>
                    <th class="px-4 py-2 text-left font-bold">Amount</th>
                    <th class="px-4 py-2 text-left font-bold">Category</th>
                    <th class="px-4 py-2 text-left font-bold">Date</th>
                    <th class="px-4 py-2 text-left font-bold">Description</th>
                    <th class="px-4 py-2 text-left font-bold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($expenses as $expense)
                <tr class="hover:bg-white/10 transition">
                    <td class="px-4 py-2">{{ $expense->payee ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $expense->amount }}</td>
                    <td class="px-4 py-2">{{ $expense->category->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $expense->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $expense->description ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('expenses.edit', $expense) }}" class="btn-glass px-3 py-1 rounded hover:bg-yellow-500/20 text-sm">Edit</a>
                        <button command="show-modal" commandfor="dialog{{ $expense->id }}" class="btn-glass px-3 py-1 rounded hover:bg-red-500/20 text-sm">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No expense found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 text-white">
        {{ $expenses->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>

</div>

<!-- Modals -->
@foreach($expenses as $expense)
<dialog id="dialog{{ $expense->id }}" class="hidden">
    <div class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="glass-card p-6 rounded-xl w-full max-w-md">
            <h3 class="text-xl font-semibold text-white">Delete Expense</h3>
            <p class="mt-2 text-gray-300">
                Are you sure you want to delete "<strong>{{ $expense->payee }}</strong>"?
                This action cannot be undone.
            </p>

            <div class="mt-4 flex justify-end gap-2">
                <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn-glass hover:bg-red-500/30 px-4 py-2 rounded text-white">
                        Delete
                    </button>
                </form>

                <button data-close="dialog{{ $expense->id }}"
                        class="btn-glass hover:bg-white/20 px-4 py-2 rounded text-white">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</dialog>
@endforeach

@endsection
