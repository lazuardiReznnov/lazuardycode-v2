<?php

namespace App\Http\Controllers\Dashboard\Fintech;

use App\Http\Controllers\Controller;
use App\Models\Fintech;
use Illuminate\Http\Request;

class DashboardFintechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fintech = Fintech::query();

        $fintech->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.fintech.index', [
            'title' => 'Fintech',
            'datas' => $fintech->paginate(10)->withQueryString(),
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
    public function show(Fintech $fintech)
    {
        return view('dashboard.fintech.show', [
            'title' => 'Detail Fintech',
            'data' => $fintech->load('image', 'acountfintech'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fintech $fintech)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fintech $fintech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fintech $fintech)
    {
        //
    }
}
