<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Show monthly report filter
    public function monthly(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m')); // default current month

        $from = $month.'-01';
        $to = now()->parse($from)->endOfMonth()->toDateString();

        $incomes = Income::whereBetween('date', [$from, $to])->get();
        $expenses = Expense::whereBetween('date', [$from, $to])->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('reports.monthly', compact('incomes','expenses','totalIncome','totalExpense','balance','month'));
    }

    // Generate PDF
    public function monthlyPdf(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $from = $month.'-01';
        $to = now()->parse($from)->endOfMonth()->toDateString();

        $incomes = Income::whereBetween('date', [$from, $to])->get();
        $expenses = Expense::whereBetween('date', [$from, $to])->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $pdf = Pdf::loadView('reports.monthly_pdf', compact('incomes','expenses','totalIncome','totalExpense','balance','month'));

        return $pdf->download('monthly_report_'.$month.'.pdf');
    }
}
