<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) $query->where('student', 'like', "%{$request->search}%");
        return response()->json($query->latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student' => 'required|string|max:120',
            'type'    => 'required|in:Fee Payment,Scholarship,Refund,Fine',
            'amount'  => 'required|numeric',
            'method'  => 'required|in:Online,Cash,Cheque,DD',
        ]);
        $data['status'] = 'Pending';
        $data['date']   = now()->toDateString();
        return response()->json(Transaction::create($data), 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->validate([
            'status' => 'sometimes|in:Pending,Paid,Overdue,Applied,Processed',
            'amount' => 'sometimes|numeric',
        ]));
        return response()->json($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function summary()
    {
        return response()->json([
            'collected' => Transaction::where('status', 'Paid')->sum('amount'),
            'pending'   => Transaction::where('status', 'Pending')->sum('amount'),
            'overdue'   => Transaction::where('status', 'Overdue')->sum('amount'),
        ]);
    }

    public function invoices()
    {
        return response()->json(['data' => [], 'message' => 'Connect invoices here']);
    }

    public function scholarships()
    {
        return response()->json(['data' => [], 'message' => 'Connect scholarships here']);
    }
}
