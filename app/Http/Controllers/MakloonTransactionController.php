<?php

namespace App\Http\Controllers;

use App\Models\MakloonTransaction;
use Illuminate\Http\Request;
use App\Models\Makloon;
use App\Models\PaymentMethod;
use Yajra\DataTables\Facades\DataTables;

class MakloonTransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:makloon-transaction.index|makloon-transaction.create|makloon-transaction.edit|makloon-transaction.delete', ['only' => ['index','store']]);
        $this->middleware('permission:makloon-transaction.create', ['only' => ['create','store']]);
        $this->middleware('permission:makloon-transaction.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:makloon-transaction.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('makloon-transaction.index');
    }

    public function getMakloonTransactionDataTable(Request $request)
    {
        $makloonTransactions = MakloonTransaction::with('makloon', 'paymentMethod', 'createdBy', 'updatedBy');

        if (!auth()->user()->hasPermissionTo('makloon-transaction.all-data')) {
            $makloonTransactions->where('created_by', auth()->id())
                ->latest();
        } else {
            $makloonTransactions->latest();
        }

        return DataTables::of($makloonTransactions)
            ->addIndexColumn()
            ->addColumn('makloon_number', function ($makloonTransaction) {
                return $makloonTransaction->makloon->makloon_number ?? '-';
            })
            ->addColumn('created_by', function ($makloonTransaction) {
                return $makloonTransaction->createdBy->name ?? '-';
            })
            ->addColumn('payment_method', function ($makloonTransaction) {
                return $makloonTransaction->paymentMethod->name ?? '-';
            })
            ->addColumn('actions', function ($makloonTransaction) {
                return view('makloon-transaction.actions', [
                    'makloonTransaction' => $makloonTransaction,
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makloons = Makloon::all();
        $paymentMethods = PaymentMethod::all();

        return view('makloon-transaction.create', [
            'makloons' => $makloons,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'makloon_id' => 'required|exists:makloons,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $validatedData['created_by'] = auth()->id();

        $makloonTransaction = MakloonTransaction::create($validatedData);

        return redirect()->route('makloon-transaction.index')->with('success', 'Makloon Transaction created successfully.');
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
        $makloonTransaction = MakloonTransaction::findOrFail($id);
        $makloons = Makloon::all();
        $paymentMethods = PaymentMethod::all();

        return view('makloon-transaction.edit', [
            'makloonTransaction' => $makloonTransaction,
            'makloons' => $makloons,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'makloon_id' => 'required|exists:makloons,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $validatedData['updated_by'] = auth()->id();

        $makloonTransaction = MakloonTransaction::findOrFail($id);
        $makloonTransaction->update($validatedData);

        return redirect()->route('makloon-transaction.index')->with('success', 'Makloon Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $makloonTransaction = MakloonTransaction::findOrFail($id);
        $makloonTransaction->delete();

        return redirect()->route('makloon-transaction.index')->with('success', 'Makloon Transaction deleted successfully.');
    }
}
