<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $rawMaterials = RawMaterial::query();

        if (!auth()->user()->hasPermissionTo('raw-material.all-data')) {
            $rawMaterials->where('created_by', auth()->id())
                ->latest();
        } else {
            $rawMaterials->latest();
        }

        if ($request->has('search')) {
            $rawMaterials->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('qty', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('created_by', 'like', '%' . $search . '%');
            });
        }

        $rawMaterials = $rawMaterials->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

        return view('raw-material.index', [
            'rawMaterials' => $rawMaterials,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('raw-material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:raw_materials|max:255',
            'unit' => 'required',
            'qty' => 'required|numeric',
            'description' => 'required',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        RawMaterial::create($validatedData);

        return redirect()->route('raw-material.index')
            ->with('success', 'Raw Material created successfully.');
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
        $rawMaterial = RawMaterial::findOrFail($id);

        return view('raw-material.edit', [
            'rawMaterial' => $rawMaterial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:raw_materials,name,' . $id . '|max:255',
            'unit' => 'required',
            'qty' => 'required|numeric',
            'description' => 'required',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        $rawMaterial = RawMaterial::findOrFail($id);
        $rawMaterial->update($validatedData);

        return redirect()->route('raw-material.index')
            ->with('success', 'Raw Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $rawMaterial = RawMaterial::findOrFail($id);
            $rawMaterial->delete();
        } catch (\Exception $e) {
            return redirect()->route('raw-material.index')
                ->with(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
        }

        return redirect()->route('raw-material.index')
                ->with('success', 'Raw Material deleted successfully.');
    }
}
