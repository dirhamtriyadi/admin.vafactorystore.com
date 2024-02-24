<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Makloon;
use App\Models\MakloonDetail;
use Illuminate\Http\Request;

class MakloonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $makloons = Makloon::with('user', 'customer', 'details')->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if($request->has('search')) {
            $makloons = Makloon::with('user', 'customer', 'details')
                ->where('makloon_number', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('customer', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('date', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        // dd($makloons);

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
        $request->validate([
            // 'makloon_number' => 'required',
            'user_id' => 'required',
            'customer_id' => 'required',
            'name' => 'required',
            'description' => '',
            'date' => 'required',
        ]);

        $makloon = Makloon::create([
            'makloon_number' => 'MKL-' . date('YmdHis'),
            'user_id' => $request->user_id,
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,

        ]);

        if($request->has('items')) {
            foreach($request->items as $item) {
                $item['makloon_id'] = $makloon->id;
                MakloonDetail::create($item);
            }
        }

        return response()->json([
            'message' => 'Transaction created successfully'
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $makloon = Makloon::findOrFail($id);
            $makloon->delete();
        } catch (\Throwable $th) {
            return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
        }

        return redirect()->route('makloon.index')->with('success', 'Makloon is successfully deleted');
    }
}
