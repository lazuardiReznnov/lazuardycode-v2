<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\Pricing;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transaction = Transaction::query();

        $transaction->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.transaction.index', [
            'title' => 'Transaction List',
            'datas' => $transaction
                ->latest()
                ->with('product', 'customer')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.create', [
            'title' => 'Create Transaction',
            'categories' => CategoryProduct::all(),
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(['']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('dashboard.transaction.show', [
            'title' => $transaction->name,
            'data' => $transaction->load('product', 'customer', 'debt'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Transaction::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }

    public function getproduct(Request $request)
    {
        $product = Product::where(
            'category_product_id',
            $request->category
        )->get();
        return response()->json($product);
    }

    public function getamount(Request $request)
    {
        $data = '';
        $prices = Pricing::where('product_id', $request->product)->get();
        foreach ($prices as $price) {
            $y = $request->tenor;
            $data = $price->$y;
        }
        return response()->json($data);
    }
}
