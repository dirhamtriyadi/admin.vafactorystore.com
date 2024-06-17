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
        $this->middleware('permission:order-tracking.index|order-tracking.create|order-tracking.edit|order-tracking.delete', ['only' => ['index','store']]);
        $this->middleware('permission:order-tracking.create', ['only' => ['create','store']]);
        $this->middleware('permission:order-tracking.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order-tracking.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $search = $request->search;

        $orderTrackings = OrderTracking::with('order', 'tracking');

        if (!auth()->user()->hasPermissionTo('order-tracking.all-data')) {
            $orderTrackings->where('created_by', auth()->id())
                ->latest();
        } else {
            $orderTrackings->latest();
        }

        if ($request->has('search')) {
            $orderTrackings->where(function($q) use ($search) {
                $q->whereHas('order', function ($query) use ($search) {
                    $query->where('order_number', 'like', '%' . $search . '%');
                })
                ->orWhereHas('tracking', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('date', 'like', '%' . $search . '%');
            });
        }

        $orderTrackings = $orderTrackings->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

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

        $validatedData['created_by'] = auth()->id();

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

        $validatedData['updated_by'] = auth()->id();

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
