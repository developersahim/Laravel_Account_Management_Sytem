@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">

    <h2 class="text-2xl text-gray-400 font-bold">Monthly Report</h2>

    <!-- Filter Form -->
    <form class="flex flex-wrap gap-3 items-center mb-4" method="GET">
        <input type="month" name="month" value="{{ $month }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition glass-card">Filter</button>
        <a href="{{ route('reports.monthly.pdf', ['month'=>$month]) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition glass-card">Download PDF</a>
        {{-- Dashboard Button --}}
          <a href="{{ route('dashboard') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition glass-card">Back to Dashboard</a>
    </form>

    <!-- Incomes Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <h3 class="text-lg font-semibold mb-2 px-4 pt-4">Incomes</h3>
        <table class="min-w-full divide-y divide-gray-200 mb-4 border-separate">
            <thead class="bg-gray-50 ">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Category</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Payer</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($incomes as $inc)
                <tr class="">
                    <td class="px-4 py-2">{{ $inc->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $inc->category?->name ?? 'Uncategorized' }}</td>
                    <td class="px-4 py-2">{{ $inc->payer }}</td>
                    <td class="px-4 py-2">{{ number_format($inc->amount,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Expenses Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <h3 class="text-lg font-semibold mb-2 px-4 pt-4">Expenses</h3>
        <table class="min-w-full divide-y divide-gray-200 mb-4 border-separate">
            <thead class="bg-gray-50 ">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Category</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Payee</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-bold">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($expenses as $exp)
                <tr class="">
                    <td class="px-4 py-2">{{ $exp->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $exp->category?->name ?? 'Uncategorized' }}</td>
                    <td class="px-4 py-2">{{ $exp->payee }}</td>
                    <td class="px-4 py-2">{{ number_format($exp->amount,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-2">Summary</h3>
        <p class="text-white-700"><span class="font-medium">Total Income:</span> {{ number_format($totalIncome,2) }}</p>
        <p class="text-white-700"><span class="font-medium">Total Expense:</span> {{ number_format($totalExpense,2) }}</p>
        <p class="text-white-700"><span class="font-medium">Balance:</span> {{ number_format($balance,2) }}</p>
    </div>

</div>
@endsection
