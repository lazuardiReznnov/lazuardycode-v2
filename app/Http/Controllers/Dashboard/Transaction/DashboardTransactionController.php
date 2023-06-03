<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\Marketing;
use App\Models\Pricing;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardTransactionController extends Controller
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
        $transaction = Transaction::query();

        $transaction->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.transaction.index', [
            'title' => 'Transaction List',
            'datas' => $transaction
                ->with('cashflow')
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
            'marketings' => Marketing::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'marketing_id' => 'required',
            'name' => 'required|unique:transactions',
            'slug' => 'required|unique:transactions',
            'tgl' => 'required',
            'tenor' => 'required',
            'dp' => 'required',
            'amount' => 'required',
        ]);

        if ($request->tenor == 'three') {
            $validatedData['tenor'] = 3;
        } elseif ($request->tenor == 'six') {
            $validatedData['tenor'] = 6;
        } elseif ($request->tenor == 'nine') {
            $validatedData['tenor'] = 9;
        } elseif ($request->tenor == 'twelve') {
            $validatedData['tenor'] = 12;
        }
        Transaction::create($validatedData);

        return redirect('/dashboard/transaction')->with(
            'success',
            'Data Has Been Added.!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('dashboard.transaction.show', [
            'title' => $transaction->name,
            'data' => $transaction->load(
                'product',
                'customer',
                'debt',
                'cashflow',
                'marketing'
            ),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('dashboard.transaction.edit', [
            'title' => 'Edit Transaction',
            'data' => $transaction->load('product', 'customer'),
            'categories' => CategoryProduct::all(),
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $rules = [
            'customer_id' => 'required',
            'product_id' => 'required',
            'tgl' => 'required',
            'tenor' => 'required',
            'dp' => 'required',
            'amount' => 'required',
        ];
        if ($request->name != $transaction->name) {
            $rules['name'] = 'required|unique:transactions|max:25';
        }
        if ($request->slug != $transaction->slug) {
            $rules['slug'] = 'required|unique:transactions';
        }

        $validatedData = $request->validate($rules);

        if ($request->tenor == 'three') {
            $validatedData['tenor'] = 3;
        } elseif ($request->tenor == 'six') {
            $validatedData['tenor'] = 6;
        } elseif ($request->tenor == 'nine') {
            $validatedData['tenor'] = 9;
        } elseif ($request->tenor == 'twelve') {
            $validatedData['tenor'] = 12;
        }

        Transaction::where('id', $transaction->id)->update($validatedData);

        return redirect('/dashboard/transaction')->with(
            'success',
            'Data Has Been Updated.!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->destroy($transaction->id);

        return redirect('/dashboard/transaction')->with(
            'success',
            'Data Has Been Deleted.!'
        );
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
        $data = [];
        $prices = Pricing::where('product_id', $request->product)->get();
        foreach ($prices as $price) {
            $y = $request->tenor;
            $data['amount'] = $price->$y;
            $data['dp'] = $price->dp;
        }
        return response()->json($data);
    }
}
