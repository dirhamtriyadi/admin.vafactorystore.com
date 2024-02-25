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

        $makloon = Makloon::create([
            'makloon_number' => 'MKL-' . date('YmdHis'),
            'user_id' => $validatedData['user_id'],
            'customer_id' => $validatedData['customer_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],

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
            $makloon->delete();
        } catch (\Throwable $th) {
            return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
        }

        return redirect()->route('makloon.index')->with('success', 'Makloon is successfully deleted');
    }
}
