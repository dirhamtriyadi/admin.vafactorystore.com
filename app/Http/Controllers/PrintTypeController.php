<?php

namespace App\Http\Controllers;

use App\Models\PrintType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
    public function index()
    {
        return view('print-type.index');
    }

    public function getPrintTypeDataTable(Request $request)
    {
        $printTypes = PrintType::query();

        if (!auth()->user()->hasPermissionTo('print-type.all-data')) {
            $printTypes->where('created_by', auth()->id())
                ->latest();
        } else {
            $printTypes->latest();
        }

        return DataTables::of($printTypes)
            ->addIndexColumn()
            ->addColumn('actions', function ($printType) {
                return view('print-type.actions', ['printType' => $printType]);
            })
            ->make(true);
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
