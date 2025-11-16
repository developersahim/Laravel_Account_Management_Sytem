<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('category')->orderBy('date','desc');
        if ($request->filled('from')) $query->whereDate('date','>=',$request->from);
        if ($request->filled('to')) $query->whereDate('date','<=',$request->to);
        $expenses = $query->paginate(20);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::where('type','expense')->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(StoreExpenseRequest $request)
    {
        Expense::create($request->validated());
        return redirect()->route('expenses.index')->with('success','Expense added.');
    }

    public function edit(Expense $expense)
    {
        $categories = Category::where('type','expense')->get();
        return view('expenses.edit', compact('expense','categories'));
    }

    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect()->route('expenses.index')->with('success','Expense updated.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return back()->with('success','Expense deleted.');
    }
}
