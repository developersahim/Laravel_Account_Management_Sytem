<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use App\Http\Requests\StoreIncomeRequest;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Income::with('category')->orderBy('date','desc');
        if ($request->filled('from')) $query->whereDate('date','>=',$request->from);
        if ($request->filled('to')) $query->whereDate('date','<=',$request->to);
        $incomes = $query->paginate(20);
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $categories = Category::where('type','income')->get();
        return view('incomes.create', compact('categories'));
    }

    public function store(StoreIncomeRequest $request)
    {
        Income::create($request->validated());
        return redirect()->route('incomes.index')->with('success','Income added.');
    }

    public function edit(Income $income)
    {
        $categories = Category::where('type','income')->get();
        return view('incomes.edit', compact('income','categories'));
    }

    public function update(StoreIncomeRequest $request, Income $income)
    {
        $income->update($request->validated());
        return redirect()->route('incomes.index')->with('success','Income updated.');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return back()->with('success','Income deleted.');
    }
}
