<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','store']]);
        $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
        $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $customers = Customer::all();
        $paymentMethods = PaymentMethod::all();

        return view('transaction.index', [
            'products' => $products,
            'customers' => $customers,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'date' => 'required',
                'user_id' => 'required',
                'customer_id' => 'required',
                'payment_method_id' => 'required',
                'items' => 'required',
            ]);

            $transaction = Transaction::create([
                'date' => $validatedData['date'],
                'transaction_number' => 'TRX-'.date('YmdHis'),
                'user_id' => $validatedData['user_id'],
                'customer_id' => $validatedData['customer_id'],
                'payment_method_id' => $validatedData['payment_method_id'],
            ]);

            foreach($validatedData['items'] as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'description' => $item['description'],
                ]);
            }

            return response()->json([
                'message' => 'Transaction created successfully',
            ]);
        }
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
        //
    }
}
