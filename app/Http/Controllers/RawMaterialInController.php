<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialIn;
use App\Models\RawMaterial;
use Yajra\DataTables\Facades\DataTables;

class RawMaterialInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('raw-material-in.index');
    }

    public function getRawMaterialInDataTable(Request $request)
    {
        $rawMaterialsIn = RawMaterialIn::query();

        if (!auth()->user()->hasPermissionTo('raw-material-in.all-data')) {
            $rawMaterialsIn->where('created_by', auth()->id())
                ->latest();
        } else {
            $rawMaterialsIn->latest();
        }

        return DataTables::of($rawMaterialsIn)
            ->addIndexColumn()
            ->addColumn('name', function ($rawMaterialIn) {
                return $rawMaterialIn->rawMaterial->name ?? '-';
            })
            ->addColumn('created_by', function ($rawMaterialIn) {
                return $rawMaterialIn->createdBy->name ?? '-';
            })
            ->addColumn('actions', function ($rawMaterialIn) {
                return view('raw-material-in.actions', ['rawMaterialIn' => $rawMaterialIn]);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rawMaterials = RawMaterial::all();

        return view('raw-material-in.create', [
            'rawMaterials' => $rawMaterials,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'qty' => 'required|numeric',
            'date' => 'required',
            'description' => 'nullable',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        $rawMaterialsIn = RawMaterialIn::create($validatedData);

        $rawMaterial = RawMaterial::findOrFail($rawMaterialsIn->raw_material_id);
        $rawMaterial->qty += $rawMaterialsIn->qty;
        $rawMaterial->save();

        return redirect()->route('raw-material-in.index')->with('success', 'Raw material in created successfully');
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
        $rawMaterialIn = RawMaterialIn::findOrFail($id);
        $rawMaterials = RawMaterial::all();

        return view('raw-material-in.edit', [
            'rawMaterialIn' => $rawMaterialIn,
            'rawMaterials' => $rawMaterials,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'raw_material_id' => 'required',
            'qty' => 'required|numeric',
            'date' => 'required',
            'description' => 'nullable',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        $rawMaterialIn = RawMaterialIn::findOrFail($id);

        $rawMaterial = RawMaterial::findOrFail($rawMaterialIn->raw_material_id);
        $rawMaterial->qty -= $rawMaterialIn->qty;
        $rawMaterial->qty += $validatedData['qty'];
        $rawMaterial->save();

        $rawMaterialIn->update($validatedData);

        return redirect()->route('raw-material-in.index')->with('success', 'Raw material in updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rawMaterialIn = RawMaterialIn::findOrFail($id);

        $rawMaterial = RawMaterial::findOrFail($rawMaterialIn->raw_material_id);
        $rawMaterial->qty -= $rawMaterialIn->qty;
        $rawMaterial->save();

        $rawMaterialIn->delete();

        return redirect()->route('raw-material-in.index')->with('success', 'Raw material in deleted successfully');
    }
}
