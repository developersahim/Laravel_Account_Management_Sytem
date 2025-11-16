<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report ({{ $month }})</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        td.amount { text-align: right; }
        .summary p { margin: 4px 0; }
    </style>
</head>
<body>
<h3>Monthly Report ({{ $month }})</h3>

<h4>Incomes</h4>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Payer</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($incomes as $inc)
        <tr>
            <td>{{ $inc->date->format('Y-m-d') }}</td>
            <td>{{ $inc->category?->name ?? 'Uncategorized' }}</td>
            <td>{{ $inc->payer }}</td>
            <td class="amount">{{ number_format($inc->amount,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Expenses</h4>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Payee</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $exp)
        <tr>
            <td>{{ $exp->date->format('Y-m-d') }}</td>
            <td>{{ $exp->category?->name ?? 'Uncategorized' }}</td>
            <td>{{ $exp->payee }}</td>
            <td class="amount">{{ number_format($exp->amount,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="summary">
    <h4>Summary</h4>
    <p><strong>Total Income:</strong> {{ number_format($totalIncome,2) }}</p>
    <p><strong>Total Expense:</strong> {{ number_format($totalExpense,2) }}</p>
    <p><strong>Balance:</strong> {{ number_format($balance,2) }}</p>
</div>
</body>
</html>
