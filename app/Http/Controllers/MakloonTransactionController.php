<?php

namespace App\Http\Controllers;

use App\Models\MakloonTransaction;
use Illuminate\Http\Request;
use App\Models\Makloon;
use App\Models\PaymentMethod;

class MakloonTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $makloonTransactions = MakloonTransaction::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $makloonTransactions = MakloonTransaction::with('makloon', 'paymentMethod', 'user')
                ->whereHas('makloon', function ($query) use ($request) {
                    $query->where('makloon_number', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('paymentMethod', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('amount', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('date', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        return view('makloon-transaction.index', [
            'makloonTransactions' => $makloonTransactions,
            'perPage' => $perPage,
            'search' => $search,
        ]);
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
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

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
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

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
