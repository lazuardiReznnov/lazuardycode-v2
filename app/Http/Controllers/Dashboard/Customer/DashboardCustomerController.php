<?php

namespace App\Http\Controllers\Dashboard\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer = Customer::query();

        $customer->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.customer.index', [
            'title' => 'Customer List',
            'datas' => $customer->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.customer.create', [
            'title' => 'Add New Customer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:customers',
            'slug' => 'required|unique:customers',
            'nik' => 'required|numeric|min:12',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|numeric|min:7',
            'address' => 'required',
        ]);

        $customer = Customer::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('customer-pic');
            $customer->image()->create($data);
        }

        return redirect('/dashboard/customer')->with(
            'success',
            'Data Has Been Aded..!!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('dashboard.customer.show', [
            'title' => 'Detail Customer',
            'data' => $customer->load('image'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customer.edit', [
            'title' => 'Edit Customer',
            'data' => $customer->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'nik' => 'required|numeric|min:12',
            'phone' => 'required|numeric|min:7',
            'address' => 'required',
        ];

        if ($request->name != $customer->name) {
            $rules['name'] = 'required|unique:customers';
        }
        if ($request->slug != $customer->slug) {
            $rules['slug'] = 'required|unique:customers';
        }
        if ($request->email != $customer->email) {
            $rules['email'] = 'required|unique:customers';
        }

        $validatedData = $request->validate($rules);

        Customer::where('id', $customer->id)->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $customer->image()->delete();
            }
            $customer->image()->create([
                'pic' => $request->file('pic')->store('customer-pic'),
            ]);
        }

        return redirect('/dashboard/customer')->with(
            'success',
            'Data Has Been Updated..!!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->destroy($customer->id);
        if ($customer->image) {
            Storage::delete($customer->image->pic);
            $customer->image->delete();
        }
        return redirect('/dashboard/customer')->with(
            'success',
            'Data Has Been Deleted..!!'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Customer::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }

    public function destroyimage(Customer $customer, Request $request)
    {
        $data = $customer
            ->image()
            ->where('id', $request->id)
            ->first();

        storage::delete($data->pic);
        $data->delete();

        return redirect('/dashboard/customer/' . $customer->slug)->with(
            'success',
            'Data Has Been Deleted.!'
        );
    }
}
