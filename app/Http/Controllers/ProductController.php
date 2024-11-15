<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Codexshaper\WooCommerce\Facades\Product as ProductWooCommerce;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product.index|product.create|product.edit|product.delete', ['only' => ['index','store']]);
        $this->middleware('permission:product.create', ['only' => ['create','store']]);
        $this->middleware('permission:product.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $search = $request->search;

        $products = Product::query();

        if (!auth()->user()->hasPermissionTo('product.all-data')) {
            $products->where('created_by', auth()->id())
                ->latest();
        } else {
            $products->latest();
        }

        if ($request->has('search')) {
            $products->where(function($q) use ($search) {
                $q->where('code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            });
        }

        $products = $products->paginate($perPage)->withQueryString('perPage=' . $perPage, 'search=' . $search);

        return view('product.index', [
            'products' => $products,
            'perPage' => $perPage,
            'search' => $search,
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

        $validatedData['created_by'] = auth()->user()->id;

        $product = new Product();
        $product->code = $validatedData['code'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->created_by = $validatedData['created_by'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '-' . $product->code . '-' . $image->getClientOriginalName();
            // $name = date('Y-m-d') . '-' . $product->code . '.' . $image->getClientOriginalExtension();

            // disimpan di folder public/images/products
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);

            // disimpan di folder storage/app/public/images/products
            // $image->storeAs('public/images/products', $name);

            $product->image = $name;
        }

        $product->save();

        // if ($product->image) {
        //     $product_woocommerce = ProductWooCommerce::create([
        //         'name' => $product->name,
        //         'type' => 'simple',
        //         'regular_price' => $product->price,
        //         'description' => $product->description,
        //         'short_description' => $product->description,
        //         'images' => [
        //             [
        //                 'src' => asset('') . '/images/products/' . $product->image,
        //             ]
        //         ]
        //     ]);

        //     $product->woocommerce_id = $product_woocommerce['id'];
        //     $product->save();
        // } else {
        //     $product_woocommerce = ProductWooCommerce::create([
        //         'name' => $product->name,
        //         'type' => 'simple',
        //         'regular_price' => $product->price,
        //         'description' => $product->description,
        //         'short_description' => $product->description,
        //     ]);

        //     $product->woocommerce_id = $product_woocommerce['id'];
        //     $product->save();
        // }

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

        $validatedData['updated_by'] = auth()->user()->id;

        $product = Product::findOrFail($id);
        $product->code = $validatedData['code'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->updated_by = $validatedData['updated_by'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '-' . $product->code . '-' . $image->getClientOriginalName();
            // $name = date('Y-m-d') . '-' . $product->code . '.' . $image->getClientOriginalExtension();

            // Menghapus file dari public
            $file = $product->image;
            if ($file) {
                $path = public_path('images/products/' . $file);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Menghapus file dari storage
            $file = $product->image;
            // if ($file) {
            //     Storage::delete('public/images/products/' . $file);
            // }

            // disimpan di folder public/images/products
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);

            // disimpan di folder storage/app/public/images/products
            // $image->storeAs('public/images/products', $name);

            $product->image = $name;
        }

        $product->save();

        // if ($product->image) {
        //     $product_woocommerce = ProductWooCommerce::update($product->woocommerce_id, [
        //         'name' => $product->name,
        //         'type' => 'simple',
        //         'regular_price' => $product->price,
        //         'description' => $product->description,
        //         'short_description' => $product->description,
        //         'images' => [
        //             [
        //                 'src' => asset('') . '/images/products/' . $product->image,
        //             ]
        //         ]
        //     ]);
        // }

        // $product_woocommerce = ProductWooCommerce::update($product->woocommerce_id, [
        //     'name' => $product->name,
        //     'type' => 'simple',
        //     'regular_price' => $product->price,
        //     'description' => $product->description,
        //     'short_description' => $product->description,
        // ]);

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

            $product_woocommerce = ProductWooCommerce::delete($product->woocommerce_id, ['force' => true]);
		} catch (\Throwable $th) {
			return back()->withErrors(['Data ini tidak dapat dihapus karena memiliki relasi ke data lain.']);
		}


        // Menghapus file dari public
        $file = $product->image;
        if ($file) {
            $path = public_path('images/products/' . $file);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Menghapus file dari storage
        // $file = $product->image;
        // if ($file) {
        //     Storage::delete('public/images/products/' . $file);
        // }

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
