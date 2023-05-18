<?php

namespace App\Http\Controllers\Dashboard\Product;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\support\Facades\Storage;

class DashboardCategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $category = CategoryProduct::query();

        $category->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.product.category.index', [
            'title' => 'Category Product',
            'datas' => $category
                ->with('image')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.product.category.create', [
            'title' => 'Create Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:category_products',
            'slug' => 'required|unique:category_products',
            'descriptions' => 'required',
            'pic' => 'image|file|max:2048',
        ]);

        $category = CategoryProduct::create($validatedData);

        if ($request->file('pic')) {
            $category->image()->create([
                'pic' => $request->file('pic')->store('categoryproduct-pic'),
            ]);
        }

        return redirect('/dashboard/product/CategoryProduct')->with(
            'success',
            'New Data Has Been Aded.!'
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryProduct $CategoryProduct)
    {
        return view('dashboard.product.category.edit', [
            'title' => 'Edit Category',
            'data' => $CategoryProduct->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryProduct $CategoryProduct)
    {
        $rules = [
            'descriptions' => 'required',
        ];

        if ($request->name != $CategoryProduct->name) {
            $rules['name'] = 'required|unique:category_products';
        }
        if ($request->slug != $CategoryProduct->slug) {
            $rules['slug'] = 'required|unique:category_products';
        }

        $validatedData = $request->validate($rules);

        CategoryProduct::where('id', $CategoryProduct->id)->update(
            $validatedData
        );

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $CategoryProduct->image()->delete();
            }
            $CategoryProduct->image()->create([
                'pic' => $request->file('pic')->store('categoryproduct-pic'),
            ]);
        }
        return redirect('/dashboard/product/CategoryProduct')->with(
            'success',
            'New Data Has Been Update.!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryProduct $CategoryProduct)
    {
        $CategoryProduct->destroy($CategoryProduct->id);
        if ($CategoryProduct->image) {
            storage::delete($CategoryProduct->image->pic);
            $CategoryProduct->image->delete();
        }

        return redirect('/dashboard/product/CategoryProduct')->with(
            'success',
            'New Post Has Been Deleted.'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            CategoryProduct::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }
}
