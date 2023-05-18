<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
