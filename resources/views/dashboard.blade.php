@extends('layouts.app')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Title -->
    <div class="flex items-center justify-between">
        <h3 class="text-3xl font-bold text-white">Dashboard</h3>
    </div>

    <!-- Filter Card -->
    <div class="glass-card p-6 rounded-2xl shadow-xl border border-white/10">
        <h4 class="text-lg font-semibold mb-4 text-white">Filter Records</h4>

        <!-- Date Range Filter -->
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">
            <input type="date" name="from" value="{{ $from }}" class="px-3 py-2 rounded-xl border border-white/20 focus:ring-indigo-400 bg-white/5 text-white">
            <input type="date" name="to" value="{{ $to }}" class="px-3 py-2 rounded-xl border border-white/20 focus:ring-indigo-400 bg-white/5 text-white">
            <button class="bg-indigo-600/50 hover:bg-indigo-600/70 text-white px-5 py-2 rounded-xl font-medium transition w-full">Filter</button>
        </form>

        <!-- Monthly Report -->
        <div class="flex flex-wrap gap-3 items-center">
            <form method="GET" action="{{ route('reports.monthly') }}" class="flex items-center gap-3">
                <input type="month" name="month" value="{{ now()->format('Y-m') }}" class="px-3 py-2 rounded-xl border border-white/20 focus:ring-indigo-400 bg-white/5 text-white">
                <button class="bg-indigo-600/50 hover:bg-indigo-600/70 text-white px-5 py-2 rounded-xl font-medium transition">View Report</button>
            </form>
            <a href="{{ route('reports.monthly.pdf', ['month' => now()->format('Y-m')]) }}" class="bg-green-600/50 hover:bg-green-600/70 text-white px-5 py-2 rounded-xl transition font-medium">Download PDF</a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass-card flex flex-col items-center p-6 rounded-2xl border border-white/10">
            <p class="text-gray-300 text-medium">Total Income</p>
            <h4 class="text-4xl font-bold text-amber-500 mt-2">{{ number_format($totalIncome,2) }}</h4>
        </div>
        <div class="glass-card flex flex-col items-center p-6 rounded-2xl border border-white/10">
            <p class="text-gray-300 text-medium">Total Expense</p>
            <h4 class="text-4xl font-bold text-red-500 mt-2">{{ number_format($totalExpense,2) }}</h4>
        </div>
        <div class="glass-card flex flex-col items-center p-6 rounded-2xl border border-white/10">
            <p class="text-gray-300 text-medium">Balance</p>
            <h4 class="text-4xl font-bold text-indigo-500 mt-2">{{ number_format($balance,2) }}</h4>
        </div>
    </div>

    <!-- Income & Expense Category Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Income Category Card -->
        <div class="glass-card p-6 rounded-2xl border border-white/10">
            <h5 class="text-xl font-semibold mb-4 text-white">Income by Category</h5>
            <ul class="divide-y divide-white/10 rounded-xl overflow-hidden">
                @foreach($incomeByCategory as $c)
                <a href="{{ route('incomes.index') }}" class="block hover:bg-white/10 transition">
                    <li class="flex justify-between px-4 py-3">
                        <span class="font-medium text-white">{{ $c->category?->name ?? 'Uncategorized' }}</span>
                        <span class="font-semibold text-white">{{ number_format($c->total,2) }}</span>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>

        <!-- Expense Category Card -->
        <div class="glass-card p-6 rounded-2xl border border-white/10">
            <h5 class="text-xl font-semibold mb-4 text-white">Expense by Category</h5>
            <ul class="divide-y divide-white/10 rounded-xl overflow-hidden">
                @foreach($expenseByCategory as $c)
                <a href="{{ route('expenses.index') }}" class="block hover:bg-white/10 transition">
                    <li class="flex justify-between px-4 py-3">
                        <span class="font-medium text-white">{{ $c->category?->name ?? 'Uncategorized' }}</span>
                        <span class="font-semibold text-white">{{ number_format($c->total,2) }}</span>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>

    </div>

</div>
@endsection
