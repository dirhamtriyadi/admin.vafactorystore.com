<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');

        // $transactionReports = Transaction::with(['customer', 'user', 'paymentMethod', 'transactionDetails.product'])->paginate(5);
        $transactionReports = Transaction::with(['customer', 'user', 'paymentMethod', 'transactionDetails.product'])->whereBetween('date', [$start_date, $end_date])->orderBy('date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $transactionReports = Transaction::with(['customer', 'user', 'paymentMethod', 'transactionDetails.product'])->whereBetween('date', [$start_date, $end_date])->orderBy('date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage, 'start_date=' . $start_date, 'end_date=' . $end_date);
        }

        // dd($transactionReports);
        return view('transaction-report.index', [
            'transactionReports' => $transactionReports,
            'perPage' => $perPage,
            'start_date' => $start_date,
            'end_date' => $end_date,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
