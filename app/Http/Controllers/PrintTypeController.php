<?php

namespace App\Http\Controllers;

use App\Models\PrintType;
use Illuminate\Http\Request;

class PrintTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:print-type.index|print-type.create|print-type.edit|print-type.delete', ['only' => ['index','store']]);
        $this->middleware('permission:print-type.create', ['only' => ['create','store']]);
        $this->middleware('permission:print-type.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:print-type.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $printTypes = PrintType::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $printTypes = PrintType::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        return view('print-type.index', [
            'printTypes' => $printTypes,
            'perPage' => $perPage,
            'search' => $search,
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

        $validatedData['created_by'] = auth()->user()->id;

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

        $validatedData['updated_by'] = auth()->user()->id;

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
