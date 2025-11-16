<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        
        $incomeQuery = Income::query();
        $expenseQuery = Expense::query();


        if ($from && $to) {
            $incomeQuery->whereBetween('date', [$from, $to]);
            $expenseQuery->whereBetween('date', [$from, $to]);
        }

        $totalIncome = $incomeQuery->sum('amount');
        $totalExpense = $expenseQuery->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $incomeByCategory = $incomeQuery->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $expenseByCategory = $expenseQuery->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'incomeByCategory',
            'expenseByCategory',
            'from',
            'to'
        ));
    }
}
