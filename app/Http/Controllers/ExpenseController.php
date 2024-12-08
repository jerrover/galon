<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10
        $expenses = Expense::orderBy('date', 'desc')->paginate($perPage);

        return view('transactions.expenses.index', compact('expenses', 'perPage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function destroy($id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();

            return response()->json(['success' => true, 'message' => 'Pengeluaran berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
} 