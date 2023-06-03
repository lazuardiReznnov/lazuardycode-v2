<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Debt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schadule;

class DashboardSchaduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    public function editschadule(Schadule $schadule)
    {
        return view('dashboard.transaction.debt.schadule.edit', [
            'title' => 'Edit Schadule',
            'data' => $schadule->load('debt'),
        ]);
    }

    public function updateschadule(Schadule $schadule, Request $request)
    {
        $rules = [
            'debt_id' => 'required',
            'tgl' => 'required',
            'amount' => 'required',
        ];

        $validatedData = $request->validate($rules);
        Schadule::where('id', $schadule->id)->update($validatedData);

        return redirect(
            '/dashboard/transaction/debt/' . $request->debt_slug
        )->with('success', 'Data Has Been added .!');
    }

    public function editstate(Schadule $schadule)
    {
        return view('dashboard.transaction.debt.schadule.editstate', [
            'title' => 'Update State',
            'data' => $schadule->load('debt'),
        ]);
    }

    public function updatestate(Schadule $schadule, Request $request)
    {
        $validatedData = $request->validate(['status' => 'required']);

        Schadule::where('id', $schadule->id)->update($validatedData);

        return redirect(
            '/dashboard/transaction/debt/' . $request->debt_slug
        )->with('success', 'Data Has Been added .!');
    }
}
