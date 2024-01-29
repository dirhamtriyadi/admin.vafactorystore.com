<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:products|max:255',
            'name' => 'required',
            'description' => '',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->code = $validatedData['code'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '-' . $product->code . '-' . $image->getClientOriginalName();
            // $name = date('Y-m-d') . '-' . $product->code . '.' . $image->getClientOriginalExtension();

            // disimpan di folder public/images/products
            // $destinationPath = public_path('/images/products');
            // $image->move($destinationPath, $name);

            // disimpan di folder storage/app/public/images/products
            $image->storeAs('public/images/products', $name);
            $product->image = $name;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
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
        $product = Product::findOrFail($id);

        return view('product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:255|unique:products,code,' . $id,
            'name' => 'required',
            'description' => '',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->code = $validatedData['code'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '-' . $product->code . '-' . $image->getClientOriginalName();
            // $name = date('Y-m-d') . '-' . $product->code . '.' . $image->getClientOriginalExtension();

            // Menghapus file dari public
            // $file = $product->image;
            // if ($file) {
            //     $path = public_path('images/products/' . $file);
            //     if (file_exists($path)) {
            //         unlink($path);
            //     }
            // }

            // Menghapus file dari storage
            $file = $product->image;
            if ($file) {
                Storage::delete('public/images/products/' . $file);
            }

            // disimpan di folder public/images/products
            // $destinationPath = public_path('/images/products');
            // $image->move($destinationPath, $name);

            // disimpan di folder storage/app/public/images/products
            $image->storeAs('public/images/products', $name);
            $product->image = $name;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
			$product = Product::findOrFail($id);
            $product->delete();
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}


        // Menghapus file dari public
        // $file = $product->image;
        // if ($file) {
        //     $path = public_path('images/products/' . $file);
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        // Menghapus file dari storage
        $file = $product->image;
        if ($file) {
            Storage::delete('public/images/products/' . $file);
        }

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
