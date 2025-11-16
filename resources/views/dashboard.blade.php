@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <h3 class="text-2xl font-semibold text-gray-800">Dashboard</h3>

    <!-- Date Filter -->
    <form class="flex flex-wrap gap-3 items-center mb-4">
        <input type="date" name="from" value="{{ $from }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <input type="date" name="to" value="{{ $to }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Filter</button>
    </form>

    <!-- Monthly Report -->
    <div class="flex flex-wrap gap-3 mb-6">
        <form method="GET" action="{{ route('reports.monthly') }}" class="flex items-center gap-2">
            <input type="month" name="month" value="{{ now()->format('Y-m') }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">View Report</button>
        </form>

        <a href="{{ route('reports.monthly.pdf', ['month' => now()->format('Y-m')]) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Download PDF
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded-2xl p-6 text-center">
            <p class="text-gray-500 font-medium">Total Income</p>
            <h4 class="text-2xl font-bold text-gray-800">{{ number_format($totalIncome,2) }}</h4>
        </div>
        <div class="bg-white shadow rounded-2xl p-6 text-center">
            <p class="text-gray-500 font-medium">Total Expense</p>
            <h4 class="text-2xl font-bold text-gray-800">{{ number_format($totalExpense,2) }}</h4>
        </div>
        <div class="bg-white shadow rounded-2xl p-6 text-center">
            <p class="text-gray-500 font-medium">Balance</p>
            <h4 class="text-2xl font-bold text-gray-800">{{ number_format($balance,2) }}</h4>
        </div>
    </div>

    <!-- Income & Expense by Category -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Income Categories -->
        <div>
            <h5 class="text-lg font-semibold mb-3">Income by Category</h5>
            <ul class="divide-y divide-gray-200 bg-white shadow rounded-2xl">
                @foreach($incomeByCategory as $c)
                <a href="{{ route('incomes.index') }}" class="block hover:bg-indigo-50 transition">
                    <li class="flex justify-between px-4 py-3">
                        <span>{{ $c->category?->name ?? 'Uncategorized' }}</span>
                        <span class="font-medium">{{ number_format($c->total,2) }}</span>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>

        <!-- Expense Categories -->
        <div>
            <h5 class="text-lg font-semibold mb-3">Expense by Category</h5>
            <ul class="divide-y divide-gray-200 bg-white shadow rounded-2xl">
                @foreach($expenseByCategory as $c)
                <li class="flex justify-between px-4 py-3 hover:bg-red-50 transition">
                    <span>{{ $c->category?->name ?? 'Uncategorized' }}</span>
                    <span class="font-medium">{{ number_format($c->total,2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection
