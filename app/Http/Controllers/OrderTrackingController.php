<?php

namespace App\Http\Controllers;

use App\Models\OrderTracking;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Tracking;

class OrderTrackingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-tracking-index|order-tracking-create|order-tracking-edit|order-tracking-delete', ['only' => ['index','store']]);
        $this->middleware('permission:order-tracking-create', ['only' => ['create','store']]);
        $this->middleware('permission:order-tracking-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order-tracking-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $orderTrackings = OrderTracking::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $orderTrackings = OrderTracking::with('order', 'tracking')
                ->whereHas('order', function ($query) use ($request) {
                    $query->where('order_number', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('tracking', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%')
                ->orWhere('date', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        return view('order-tracking.index', [
            'orderTrackings' => $orderTrackings,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $trackings = Tracking::all();

        return view('order-tracking.create', [
            'orders' => $orders,
            'trackings' => $trackings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tracking_id' => 'required|exists:trackings,id',
            'description' => 'required|string',
            'status' => 'required',
            'date' => 'required|date',
        ]);

        OrderTracking::create($validatedData);

        return redirect()->route('order-tracking.index');
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
        $orderTracking = OrderTracking::findOrFail($id);
        $orders = Order::all();
        $trackings = Tracking::all();

        return view('order-tracking.edit', [
            'orderTracking' => $orderTracking,
            'orders' => $orders,
            'trackings' => $trackings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tracking_id' => 'required|exists:trackings,id',
            'description' => 'required|string',
            'status' => 'required',
            'date' => 'required|date',
        ]);

        $orderTracking = OrderTracking::findOrFail($id);
        $orderTracking->update($validatedData);

        return redirect()->route('order-tracking.index')->with('success', 'Order tracking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $orderTracking = OrderTracking::findOrFail($id);
        $orderTracking->delete();

        return redirect()->route('order-tracking.index')->with('success', 'Order tracking deleted successfully.');
    }
}
