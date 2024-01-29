<?php

namespace App\Http\Controllers;

use App\Models\PrintType;
use Illuminate\Http\Request;

class PrintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printTypes = PrintType::paginate(10);

        return view('print-type.index', [
            'printTypes' => $printTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('print-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:print_types|max:255',
            'price' => 'required|numeric',
            'description' => '',
        ]);

        PrintType::updateOrCreate($validatedData);

        return redirect()->route('print-type.index')->with('success', 'Print type is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintType $printType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $printType = PrintType::findOrFail($id);

        return view('print-type.edit', [
            'printType' => $printType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:print_types,name,' . $id . '|max:255',
            'price' => 'required|numeric',
            'description' => '',
        ]);

        $printType = PrintType::findOrFail($id);
        $printType->update($validatedData);

        return redirect()->route('print-type.index')->with('success', 'Print type is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$printType = PrintType::findOrFail($id);
            $printType->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}

        return redirect()->route('print-type.index')->with('success', 'Print type is successfully deleted');
    }
}
