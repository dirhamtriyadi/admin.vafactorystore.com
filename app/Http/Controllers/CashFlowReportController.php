<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashFlow;
use PDF;

class CashFlowReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashflow-report.index|cashflow-report.create|cashflow-report.edit|cashflow-report.delete', ['only' => ['index','store']]);
        $this->middleware('permission:cashflow-report.create', ['only' => ['create','store']]);
        $this->middleware('permission:cashflow-report.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:cashflow-report.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');

        // $cashFlows = CashFlow::with(['createdBy' => function ($query) {
        //     $query->select('id', 'name');
        // }])->orderBy('transaction_date', 'DESC')->paginate(10);

        $cashFlows = CashFlow::with(['createdBy' => function ($query) {
            $query->select('id', 'name');
        }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $cashFlows = CashFlow::with(['createdBy' => function ($query) {
                $query->select('id', 'name');
            }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->paginate($perPage)->withQueryString('perPage=' . $perPage, 'start_date=' . $start_date, 'end_date=' . $end_date);
        }

        return view('cash-flow-report.index', [
            'cashFlows' => $cashFlows,
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

    public function print(Request $request)
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');

        $cashFlows = CashFlow::with(['createdBy' => function ($query) {
            $query->select('id', 'name');
        }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->get();

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $cashFlows = CashFlow::with(['createdBy' => function ($query) {
                $query->select('id', 'name');
            }])->whereBetween('transaction_date', [$start_date, $end_date])->orderBy('transaction_date', 'DESC')->get();
        }

        // dd($cashFlows);

        $pdf = PDF::loadview('cash-flow-report.print', [
            'cashFlows' => $cashFlows,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        return $pdf->stream();
    }
}
