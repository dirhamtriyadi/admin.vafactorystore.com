<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 2;
        $search = $request->search;

        $products = Product::latest()->paginate($perPage)->withQueryString('perPage=' . $perPage);

        if ($request->has('search')) {
            $products = Product::where('code', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->paginate($perPage)
                ->withQueryString('perPage=' . $perPage, 'search=' . $request->search);
        }

        // return response()->json([$products]);

        return response()->json([
            'data' => ProductResource::collection($products),
            'meta' => [
                'first_page' => $products->url(1),
                'next_page' => $products->nextPageUrl() ?? 'null',
                'prev_page' => $products->previousPageUrl() ?? 'null',
                'last_page' => $products->url($products->lastPage()),
                'path' => $products->path(),
                'total' => $products->total(),
                'perPage' => $products->perPage(),
                'currentPage' => $products->currentPage(),
                'lastPage' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
