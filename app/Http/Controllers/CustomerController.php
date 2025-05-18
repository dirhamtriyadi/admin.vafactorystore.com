<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer.index|customer.create|customer.edit|customer.delete', ['only' => ['index','store']]);
        $this->middleware('permission:customer.create', ['only' => ['create','store']]);
        $this->middleware('permission:customer.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.index');
    }

    public function getCustomerDataTable(Request $request)
    {
         $customers = Customer::query();

        if (!auth()->user()->hasPermissionTo('customer.all-data')) {
            $customers->where('created_by', auth()->id())
                ->latest();
        } else {
            $customers->latest();
        }

        return DataTables::of($customers)
            ->addIndexColumn()
            ->addColumn('actions', function ($customer) {
                return view('customer.actions', ['customer' => $customer]);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:customers|max:255',
            'phone' => 'required|unique:customers|max:255',
            'address' => '',
        ]);

        $validatedData['created_by'] = auth()->id();

        $customer = Customer::updateOrCreate($validatedData);

        return redirect()->route('customer.index')->with('success', 'Customer is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:customers,name,' . $id . '|max:255',
            'phone' => 'required|unique:customers,phone,' . $id . '|max:255',
            'address' => '',
        ]);

        $validatedData['updated_by'] = auth()->id();

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        return redirect()->route('customer.index')->with('success', 'Customer is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$customer = Customer::findOrFail($id);
            $customer->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}

        return redirect()->route('customer.index')->with('success', 'Customer is successfully deleted');
    }
}
