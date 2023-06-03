<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Acount;
use App\Models\Cashflow;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardCashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo2 = 0;
        $saldos = Cashflow::select('debet', 'credit')
            ->whereMonth('tgl', '<', date('m'))
            ->get();

        foreach ($saldos as $saldo) {
            $saldo2 = $saldo2 + $saldo->credit - $saldo->debet;
        }

        return view('dashboard.transaction.cashflow.index', [
            'title' => 'Cash In-Out',
            'saldo' => $saldo2,
            'datas' => Cashflow::with('acount', 'transaction')
                ->whereMonth('tgl', '=', date('m'))
                ->orderBY('tgl', 'ASC')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.cashflow.create-in', [
            'title' => 'Add Transaction',
            'datas' => Acount::where('state', '=', 0)->get(),
            'transactions' => Transaction::with('customer')->get(),
        ]);
    }

    public function createout()
    {
        return view('dashboard.transaction.cashflow.create-out', [
            'title' => 'Add Transaction',
            'datas' => Acount::where('state', '=', 1)->get(),
            'transactions' => Transaction::with('customer')->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'acount_id' => 'required',
            'description' => 'required',
            'tgl' => 'required',
            'debet' => 'required',
            'credit' => 'required',
            'transaction_id' => 'required',
        ]);

        $validatedData['slug'] = Str::slug(
            $request->acount_id . $request->tgl . $request->description,
            '-'
        );

        $cashflow = Cashflow::create($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('cashflow-pic');
            $cashflow->image()->create($data);
        }

        return redirect('/dashboard/transaction/cashflow')->with(
            'success',
            'data Has Been Added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashflow $cashflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashflow $cashflow)
    {
        return view('dashboard.transaction.cashflow.edit', [
            'title' => 'Edit Data',
            'data' => $cashflow,
            'datas' => Acount::all(),
            'transactions' => Transaction::with('customer')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashflow $cashflow)
    {
        $rules = [
            'acount_id' => 'required',
            'description' => 'required',
            'tgl' => 'required',
            'debet' => 'required',
            'credit' => 'required',
            'transaction_id' => 'required',
        ];

        $validatedData = $request->validate($rules);
        Cashflow::where('id', $cashflow->id)->update($validatedData);
        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $cashflow->image()->delete();
            }
            $cashflow->image()->create([
                'pic' => $request->file('pic')->store('cashflow-pic'),
            ]);
        }

        return redirect('/dashboard/transaction/cashflow')->with(
            'success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashflow $cashflow)
    {
        $cashflow->destroy($cashflow->id);

        return redirect('/dashboard/transaction/cashflow')->with(
            'success',
            'data Has Been Deleted'
        );
    }
}
