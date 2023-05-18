<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marketing;

class DashboardFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $marketing = Marketing::query();
        $marketing->when($request->search, function ($query) use ($request) {
            return $query
                ->where('description', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        });
        return view('dashboard.transaction.fee.index', [
            'title' => 'Fee Marketing Data',
            'datas' => $marketing
                ->with('transaction')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
