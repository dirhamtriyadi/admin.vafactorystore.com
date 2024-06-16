<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tracking-index|tracking-create|tracking-edit|tracking-delete', ['only' => ['index','store']]);
        $this->middleware('permission:tracking-create', ['only' => ['create','store']]);
        $this->middleware('permission:tracking-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tracking-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 5;
        $search = $request->search;

        $trackings = Tracking::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $trackings = Tracking::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        return view('tracking.index', [
            'trackings' => $trackings,
            'perPage' => $perPage,
            'search' => $search,
        ]);
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
