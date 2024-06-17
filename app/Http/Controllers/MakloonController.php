<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Makloon;
use App\Models\MakloonDetail;
use Illuminate\Http\Request;
use PDF;

class MakloonController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:makloon.index|makloon.create|makloon.edit|makloon.delete', ['only' => ['index','store']]);
        $this->middleware('permission:makloon.create', ['only' => ['create','store']]);
        $this->middleware('permission:makloon.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:makloon.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $makloons = Makloon::with('createdBy', 'updatedBy', 'customer', 'details');

        if (!auth()->user()->hasPermissionTo('makloon.all-data')) {
            $makloons->where('created_by', auth()->id())
                ->latest();
        } else {
            $makloons->latest();
        }

        if ($request->has('search')) {
            $makloons->where(function($q) use ($search) {
                $q->where('makloon_number', 'like', '%' . $search . '%')
                    ->orWhereHas('createdBy', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%');
            });
        }

        $makloons = $makloons->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

        return view('makloon.index', [
            'makloons' => $makloons,
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

        return view('makloon.create', [
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'makloon_number' => 'required',
            'user_id' => 'required',
            'customer_id' => 'required',
            'name' => 'required',
            'description' => '',
            'date' => 'required',
        ]);

        if (!$request->has('items')) {
            return response()->json([
                'message' => 'Items is required'
            ], 422);
        }

        $validatedData['created_by'] = auth()->id();

        $makloon = Makloon::create([
            'makloon_number' => 'MKL-' . date('YmdHis'),
            'customer_id' => $validatedData['customer_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'created_by' => $validatedData['created_by'],
        ]);

        if($request->has('items')) {
            foreach($request->items as $item) {
                $item['makloon_id'] = $makloon->id;
                MakloonDetail::create($item);
            }
        }

        return response()->json([
            'message' => 'Makloon created successfully'
        ], 200);
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
        $makloon = Makloon::with('details')->findOrFail($id);
        $customers = Customer::all();

        return view('makloon.edit', [
            'makloon' => $makloon,
            'customers' => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'name' => 'required',
            'description' => '',
            'date' => 'required',
        ]);

        if (!$request->has('items')) {
            return response()->json([
                'message' => 'Items is required'
            ], 422);
        }

        $validatedData['updated_by'] = auth()->id();

        $makloon = Makloon::findOrFail($id);
        $makloon->update($validatedData);

        if($request->has('items')) {
            foreach($request->items as $item) {
                if(isset($item['id'])) {
                    MakloonDetail::findOrFail($item['id'])->update($item);
                } else {
                    $item['makloon_id'] = $makloon->id;
                    MakloonDetail::create($item);
                }
            }
        }

        // return redirect()->route('makloon.index')->with('success', 'Makloon updated successfully');
        return response()->json([
            'message' => 'Makloon updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $makloon = Makloon::findOrFail($id);
            MakloonDetail::where('makloon_id', $makloon->id)->delete();
            $makloon->delete();
        } catch (\Throwable $th) {
            return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
        }

        return redirect()->route('makloon.index')->with('success', 'Makloon is successfully deleted');
    }

    public function print(Request $request)
    {
        $makloon = Makloon::with('details')->findOrFail($request->id);

        $pdf = PDF::loadView('makloon.print', [
            'makloon' => $makloon,
        ]);

        return $pdf->stream();
    }
}
