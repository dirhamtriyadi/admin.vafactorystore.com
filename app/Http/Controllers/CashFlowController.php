<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class CashFlowController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashflow.index|cashflow.create|cashflow.edit|cashflow.delete', ['only' => ['index','store']]);
        $this->middleware('permission:cashflow.create', ['only' => ['create','store']]);
        $this->middleware('permission:cashflow.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:cashflow.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');

        // $cashFlows = CashFlow::with(['user' => function ($query) {
        //     $query->select('id', 'name');
        // }])->orderBy('transaction_date', 'DESC')->paginate(10);

        $cashFlows = CashFlow::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $cashFlows = CashFlow::with(['user' => function ($query) {
                $query->select('id', 'name');
            }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage);
        }

        return view('cash-flow.index', [
            'cashFlows' => $cashFlows,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentMethods = PaymentMethod::all();
        return view('cash-flow.create', [
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_date' => 'required|date',
            'user_id' => 'required',
            'cash_flow_type' => 'required',
            'payment_method_id' => '',
            'amount' => 'required|numeric',
            'description' => '',
        ]);

        CashFlow::updateOrCreate($validatedData);

        return redirect()->route('cash-flow.index')->with('success', 'Cash Flow is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashFlow $cashFlow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $cashFlow = CashFlow::findOrFail($id);
        $paymentMethods = PaymentMethod::all();

        return view('cash-flow.edit', [
            'cashFlow' => $cashFlow,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'transaction_date' => 'required|date',
            'user_id' => 'required',
            'cash_flow_type' => 'required',
            'payment_method_id' => '',
            'amount' => 'required|numeric',
            'description' => '',
        ]);

        $cashFlow = CashFlow::findOrFail($id);
        $cashFlow->update($validatedData);

        return redirect()->route('cash-flow.index')->with('success', 'Cash Flow is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $cashFlow = CashFlow::findOrFail($id);
        $cashFlow->delete();

        return redirect()->route('cash-flow.index')->with('success', 'Cash Flow is successfully deleted');
    }
}
