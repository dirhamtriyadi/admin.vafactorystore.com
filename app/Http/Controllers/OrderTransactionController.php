<?php

namespace App\Http\Controllers;

use App\Models\OrderTransaction;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaymentMethod;

class OrderTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderTransactions = OrderTransaction::with(['order', 'paymentMethod'])->paginate(10);

        return view('order-transaction.index', [
            'orderTransactions' => $orderTransactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $paymentMethods = PaymentMethod::all();

        return view('order-transaction.create', [
            'orders' => $orders,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $orderTransaction = OrderTransaction::create($validatedData);

        return redirect()->route('order-transaction.index')->with('success', 'Order transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $orderTransaction = OrderTransaction::findOrFail($id);
        $orderTransaction->delete();

        return redirect()->route('order-transaction.index')->with('success', 'Order transaction deleted successfully.');
    }
}
