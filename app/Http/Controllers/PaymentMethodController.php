<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment-method.index|payment-method.create|payment-method.edit|payment-method.delete', ['only' => ['index','store']]);
        $this->middleware('permission:payment-method.create', ['only' => ['create','store']]);
        $this->middleware('permission:payment-method.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:payment-method.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $search = $request->search;

        $paymentMethods = PaymentMethod::query();

        if (!auth()->user()->hasPermissionTo('payment-method.all-data')) {
            $paymentMethods->where('created_by', auth()->id())
                ->latest();
        } else {
            $paymentMethods->latest();
        }

        if ($request->has('search')) {
            $paymentMethods->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $paymentMethods = $paymentMethods->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

        return view('payment-method.index', [
            'paymentMethods' => $paymentMethods,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:payment_methods|max:255',
            'description' => '',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        PaymentMethod::updateOrCreate($validatedData);

        return redirect()->route('payment-method.index')->with('success', 'Payment method is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return view('payment-method.edit', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:payment_methods,name,' . $id . '|max:255',
            'description' => '',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($validatedData);

        return redirect()->route('payment-method.index')->with('success', 'Payment method is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$paymentMethod = PaymentMethod::findOrFail($id);
            $paymentMethod->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}


        return redirect()->route('payment-method.index')->with('success', 'Payment method is successfully deleted');
    }
}
