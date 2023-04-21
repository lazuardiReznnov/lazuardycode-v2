<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Cashflow;
use Illuminate\Http\Request;

class DashboardCashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldo2 = 0;
        $saldos = Cashflow::select('debet', 'credit')
            ->where('tgl', '<', date('Y-m-d'))
            ->get();

        foreach ($saldos as $saldo) {
            $saldo2 = $saldo2 + $saldo->credit - $saldo->debet;
        }

        return view('dashboard.transaction.cashflow.index', [
            'title' => 'Cash In-Out',
            'saldo' => $saldo2,
            'datas' => Cashflow::with('acount')
                ->where('tgl', '=', date('Y-m-d'))
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
        //
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
    public function show(Cashflow $cashflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashflow $cashflow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashflow $cashflow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashflow $cashflow)
    {
        //
    }
}
