<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Debt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schadule;

class DashboardSchaduleController extends Controller
{
    public function addschadule(Debt $debt)
    {
        return view('dashboard.transaction.debt.schadule.create', [
            'title' => 'Add Schadule',
            'data' => $debt,
        ]);
    }

    public function storeschadule(Request $request)
    {
        $validatedData = $request->validate([
            'debt_id' => 'required',
            'tgl' => 'required',
            'amount' => 'required',
        ]);

        Schadule::create($validatedData);

        return redirect(
            '/dashboard/transaction/debt/' . $request->debt_slug
        )->with('success', 'Data Has Been added .!');
    }
}
