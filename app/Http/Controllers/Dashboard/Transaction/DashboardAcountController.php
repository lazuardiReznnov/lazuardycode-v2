<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Acount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardAcountController extends Controller
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
        $acount = acount::query();
        $acount->when($request->search, function ($query) use ($request) {
            return $query
                ->where('description', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.transaction.cashflow.acount.index', [
            'title' => 'Acount',
            'datas' => $acount
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.cashflow.acount.create', [
            'title' => 'Create Acount',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:acounts',
            'slug' => 'required|unique:acounts',
            'description' => 'required',
            'state' => 'required',
        ]);

        acount::create($validateData);

        return redirect('dashboard/transaction/cashflow/acount')->with(
            'success',
            'Data Has Been added.!!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Acount $acount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acount $acount)
    {
        return view('dashboard.transaction.cashflow.acount.edit', [
            'title' => 'Edit Acount',
            'data' => $acount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acount $acount)
    {
        $rules = [
            'description' => 'required',
            'state' => 'required',
        ];

        if ($request->name != $acount->name) {
            $rules['name'] = 'required|unique:acounts';
        }
        if ($request->slug != $acount->slug) {
            $rules['slug'] = 'required|unique:acounts';
        }

        $validateData = $request->validate($rules);

        acount::where('id', $acount->id)->update($validateData);
        return redirect('dashboard/transaction/cashflow/acount')->with(
            'success',
            'Data has Been Updated.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acount $acount)
    {
        $acount->destroy($acount->id);

        return redirect('dashboard/transaction/cashflow/acount')->with(
            'success',
            'Data has Been Deleted.'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(acount::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
