<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'title' => 'Product',
            'datas' => product::latest()
                ->paginate(10)
                ->withQueryString(),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view('dashboard.product.show', [
            'title' => $product->name,
            'data' => $product->load('CategoryProduct'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
