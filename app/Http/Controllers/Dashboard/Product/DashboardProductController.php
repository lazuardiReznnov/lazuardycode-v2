<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = product::query();

        $product->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });
        return view('dashboard.product.index', [
            'title' => 'Product',
            'datas' => $product->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.product.create', [
            'title' => 'New Product',
            'categories' => CategoryProduct::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_product_id' => 'required',
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'brand' => 'required',
            'descriptions' => 'required',
        ]);

        $product = product::create($validatedData);
        $product->pricing()->create(['product_id' => $product->id]);

        return redirect('/dashboard/product')->with(
            'success',
            'Product Has Been Updated.!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view('dashboard.product.show', [
            'title' => $product->name,
            'data' => $product->load('CategoryProduct', 'image', 'pricing'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('dashboard.product.edit', [
            'title' => 'Edit Product',
            'data' => $product,
            'categories' => CategoryProduct::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $rules = [
            'category_product_id' => 'required',
            'brand' => 'required',
            'descriptions' => 'required',
        ];

        if ($request->name != $product->name) {
            $rules['name'] = 'required|unique:products';
        }
        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);
        product::where('id', $product->id)->update($validatedData);

        return redirect('/dashboard/product')->with(
            'success',
            'Product Has Been Upadated.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->destroy($product->id);
        if ($product->image) {
            foreach ($product->image as $image) {
                storage::delete($image->pic);
                $image->delete();
            }
        }

        return redirect('/dashboard/product')->with(
            'success',
            'New Post Has Been Deleted.'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function createimage(product $product)
    {
        return view('dashboard.product.create-image', [
            'title' => 'File Upload',
            'data' => $product,
        ]);
    }

    public function storeimage(Request $request)
    {
        $validatedData = $request->validate([
            'pic' => 'image|file|max:2048',
            'name' => 'required',
            'description' => 'required',
        ]);

        $validatedData['pic'] = $request->file('pic')->store('product-pic');

        $product = product::find($request->product_id);

        $product->image()->create($validatedData);

        return redirect('/dashboard/product/' . $request->product_slug)->with(
            'success',
            'New Data Has Been Aded.!'
        );
    }

    public function destroyimage(product $product, Request $request)
    {
        $data = $product
            ->image()
            ->where('id', $request->id)
            ->first();

        storage::delete($data->pic);
        $data->delete();

        return redirect('/dashboard/product/' . $product->slug)->with(
            'success',
            'Data Has Been Deleted.!'
        );
    }

    public function pricingcreate(Product $product)
    {
        return view('dashboard.product.pricing.create', [
            'title' => 'Add Or Update Pricing Product',
            'data' => $product->load('pricing'),
        ]);
    }

    public function pricingstore(Product $product, Request $request)
    {
        $rules = [
            'cash' => 'required',
            'dp' => 'required',
            'three' => 'required',
            'six' => 'required',
            'nine' => 'required',
            'twelve' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $product->pricing()->update($validatedData);

        return redirect('/dashboard/product/' . $product->slug)->with(
            'success',
            'Data Has Been Updated.!'
        );
    }
}
