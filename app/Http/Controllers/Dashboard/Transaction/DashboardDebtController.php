<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Debt;
use App\Models\Fintech;
use App\Models\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\acountFintech;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardDebtController extends Controller
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
        $debt = Debt::query();

        $debt->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.transaction.debt.index', [
            'title' => 'Debt List',
            'datas' => $debt
                ->latest()
                ->with('transaction', 'acountFintech')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.debt.create', [
            'title' => 'Create New Debt',
            'fintechs' => Fintech::all(),
            'transactions' => Transaction::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'acount_fintech_id' => 'required',
            'transaction_id' => 'required',
            'name' => 'required|unique:debts',
            'slug' => 'required|unique:debts',
            'tgl' => 'required',
            'amount' => 'required',
            'tenor' => 'required',
        ]);

        Debt::create($validatedData);

        return redirect('dashboard/transaction/debt')->with(
            'success',
            'Data Has Been Added.!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        return view('dashboard.transaction.debt.show', [
            'title' => 'Debt Transaction Detail',
            'data' => $debt->load('acountFintech', 'transaction', 'schadule'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Debt::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function getacount(Request $request)
    {
        $acount = acountFintech::where('fintech_id', $request->acount)->get();
        return response()->json($acount);
    }
}
