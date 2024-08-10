<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialOut;
use App\Models\RawMaterial;

class RawMaterialOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $search = $request->search;

        $rawMaterialsOut = RawMaterialOut::query();

        if (!auth()->user()->hasPermissionTo('raw-material-out.all-data')) {
            $rawMaterialsOut->where('created_by', auth()->id())
                ->latest();
        } else {
            $rawMaterialsOut->latest();
        }

        if ($request->has('search')) {
            $rawMaterialsOut->where(function($q) use ($search) {
                $q->where('raw_material_id', 'like', '%' . $search . '%')
                    ->orWhere('quantity', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('created_by', 'like', '%' . $search . '%');
            });
        }

        $rawMaterialsOut = $rawMaterialsOut->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

        return view('raw-material-out.index', [
            'rawMaterialsOut' => $rawMaterialsOut,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rawMaterials = RawMaterial::all();

        return view('raw-material-out.create', [
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
            'date' => 'required|date',
            'description' => 'nullable',
        ]);

        $validatedData['created_by'] = auth()->id();

        $rawMaterialsOut = RawMaterialOut::create($validatedData);

        $rawMaterial = RawMaterial::findOrFail($request->raw_material_id);
        $rawMaterial->qty -= $request->qty;
        $rawMaterial->save();

        return redirect()->route('raw-material-out.index')->with('success', 'Raw material out created successfully');
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
        $rawMaterialsOut = RawMaterialOut::findOrFail($id);
        $rawMaterials = RawMaterial::all();

        return view('raw-material-out.edit', [
            'rawMaterialsOut' => $rawMaterialsOut,
            'rawMaterials' => $rawMaterials,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'qty' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        $rawMaterialsOut = RawMaterialOut::findOrFail($id);

        $rawMaterial = RawMaterial::findOrFail($rawMaterialsOut->raw_material_id);
        $rawMaterial->qty += $rawMaterialsOut->qty;
        $rawMaterial->qty -= $request->qty;
        $rawMaterial->save();

        $rawMaterialsOut->update($validatedData);

        return redirect()->route('raw-material-out.index')->with('success', 'Raw material out updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rawMaterialsOut = RawMaterialOut::findOrFail($id);

        $rawMaterial = RawMaterial::findOrFail($rawMaterialsOut->raw_material_id);
        $rawMaterial->qty += $rawMaterialsOut->qty;
        $rawMaterial->save();

        $rawMaterialsOut->delete();

        return redirect()->route('raw-material-out.index')->with('success', 'Raw material out deleted successfully');
    }
}
