<?php

namespace App\Http\Controllers\Dashboard\Marketing;

use App\Models\Marketing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $marketing = Marketing::query();

        $marketing->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.marketing.index', [
            'title' => 'Marketing Management',
            'datas' => $marketing
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
        return view('dashboard.marketing.create', [
            'title' => 'Add New Marketing',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:marketings',
            'slug' => 'required|unique:marketings',
            'nik' => 'required|numeric|min:12',
            'email' => 'required|email|unique:marketings',
            'phone' => 'required|numeric|min:7',
            'address' => 'required',
        ]);

        $marketing = Marketing::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('marketing-pic');
            $marketing->image()->create($data);
        }

        return redirect('/dashboard/marketing')->with(
            'success',
            'Data Has Been Aded..!!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Marketing $marketing)
    {
        return view('dashboard.marketing.show', [
            'title' => 'Detail Marketing',
            'data' => $marketing->load('image'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marketing $marketing)
    {
        return view('dashboard.marketing.edit', [
            'title' => 'Edit Marketing',
            'data' => $marketing->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marketing $marketing)
    {
        $rules = [
            'nik' => 'required|numeric|min:12',
            'phone' => 'required|numeric|min:7',
            'address' => 'required',
        ];

        if ($request->name != $marketing->name) {
            $rules['name'] = 'required|unique:marketings';
        }
        if ($request->slug != $marketing->slug) {
            $rules['slug'] = 'required|unique:marketings';
        }
        if ($request->email != $marketing->email) {
            $rules['email'] = 'required|unique:marketings';
        }

        $validatedData = $request->validate($rules);

        Marketing::where('id', $marketing->id)->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $marketing->image()->delete();
            }
            $marketing->image()->create([
                'pic' => $request->file('pic')->store('marketing-pic'),
            ]);
        }

        return redirect('/dashboard/marketing')->with(
            'success',
            'Data Has Been Updated..!!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marketing $marketing)
    {
        $marketing->destroy($marketing->id);
        if ($marketing->image) {
            Storage::delete($marketing->image->pic);
            $marketing->image->delete();
        }
        return redirect('/dashboard/marketing')->with(
            'success',
            'Data Has Been Deleted..!!'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Marketing::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }

    public function destroyimage(Marketing $marketing, Request $request)
    {
        $data = $marketing
            ->image()
            ->where('id', $request->id)
            ->first();

        storage::delete($data->pic);
        $data->delete();

        return redirect('/dashboard/marketing/' . $marketing->slug)->with(
            'success',
            'Data Has Been Deleted.!'
        );
    }
}
