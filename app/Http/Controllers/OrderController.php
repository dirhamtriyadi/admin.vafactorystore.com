<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PrintType;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order.index|order.create|order.edit|order.delete', ['only' => ['index','store']]);
        $this->middleware('permission:order.create', ['only' => ['create','store']]);
        $this->middleware('permission:order.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $orders = Order::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $orders = Order::with('user', 'customer', 'printType')
                ->where('order_number', 'like', '%' . $request->search . '%')
                ->orWhereHas('customer', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('printType', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('date', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }
        // dd($orders);

        return view('order.index', [
            'orders' => $orders,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $printTypes = PrintType::all();

        return view('order.create', [
            'customers' => $customers,
            'printTypes' => $printTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'order_number' => 'required|unique:orders',
            'customer_id' => 'required|numeric',
            'print_type_id' => 'required|numeric',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'total' => 'required|numeric',
            'name' => 'required',
            'description' => '',
            'date' => 'required|date',
        ]);

        $order = Order::create([
            'order_number' => 'ORD-' . date('YmdHis'), // 'ORD-20210601000001
            'customer_id' => $validatedData['customer_id'],
            'print_type_id' => $validatedData['print_type_id'],
            'qty' => $validatedData['qty'],
            'price' => $validatedData['price'],
            'subtotal' => $validatedData['subtotal'],
            'discount' => $validatedData['discount'],
            'total' => $validatedData['total'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('order.index')->with('success', 'Order created successfully');
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
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $printTypes = PrintType::all();

        return view('order.edit', [
            'order' => $order,
            'customers' => $customers,
            'printTypes' => $printTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|numeric',
            'print_type_id' => 'required|numeric',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'total' => 'required|numeric',
            'name' => 'required',
            'description' => '',
            'date' => 'required|date',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'customer_id' => $validatedData['customer_id'],
            'print_type_id' => $validatedData['print_type_id'],
            'qty' => $validatedData['qty'],
            'price' => $validatedData['price'],
            'subtotal' => $validatedData['subtotal'],
            'discount' => $validatedData['discount'],
            'total' => $validatedData['total'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$$order = Order::findOrFail($id);
            $order->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}


        return redirect()->route('order.index')->with('success', 'Order is successfully deleted');
    }
}
