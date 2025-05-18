<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrackingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tracking.index|tracking.create|tracking.edit|tracking.delete', ['only' => ['index','store']]);
        $this->middleware('permission:tracking.create', ['only' => ['create','store']]);
        $this->middleware('permission:tracking.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tracking.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tracking.index');
    }

    public function getTrackingDataTable(Request $request)
    {
        $trackings = Tracking::query();

        if (!auth()->user()->hasPermissionTo('tracking.all-data')) {
            $trackings->where('created_by', auth()->id())
                ->latest();
        } else {
            $trackings->latest();
        }

        return DataTables::of($trackings)
            ->addIndexColumn()
            ->addColumn('actions', function ($tracking) {
                return view('tracking.actions', [
                    'tracking' => $tracking,
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:trackings|max:255',
            'description' => '',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        Tracking::updateOrCreate($validatedData);

        return redirect()->route('tracking.index')->with('success', 'Tracking is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tracking $tracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $tracking = Tracking::findOrFail($id);

        return view('tracking.edit', [
            'tracking' => $tracking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:trackings|max:255',
            'description' => '',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        $tracking = Tracking::findOrFail($id);
        $tracking->update($validatedData);

        return redirect()->route('tracking.index')->with('success', 'Tracking is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$tracking = Tracking::findOrFail($id);
            $tracking->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}

        return redirect()->route('tracking.index')->with('success', 'Tracking is successfully deleted');
    }
}
