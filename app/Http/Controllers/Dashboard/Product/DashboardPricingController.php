<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class DashboardPricingController extends Controller
{
    public function create(Product $product)
    {
        return view('dashboard.product.pricing.create', [
            'title' => 'Add Or Update Pricing Product',
            'data' => $product->load('pricing'),
        ]);
    }

    public function store(Product $product, Request $request)
    {
        $rules = [
            'cash' => 'required',
            'dp' => 'required',
            'three' => 'required',
            'six' => 'required',
            'nine' => 'required',
            'twelve' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $product->pricing()->update($validatedData);

        return redirect('/dashboard/product/' . $product->slug)->with(
            'success',
            'Data Has Been Deleted.!'
        );
    }
}
