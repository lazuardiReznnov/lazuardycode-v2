<?php

namespace App\Http\Controllers\Dashboard\Fintech;

use App\Models\Fintech;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\acountFintech;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardFintechController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $fintech = Fintech::query();

        $fintech->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.fintech.index', [
            'title' => 'Fintech',
            'datas' => $fintech
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
        return view('dashboard.fintech.create', [
            'title' => 'Add New Fintech',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:Finteches',
            'slug' => 'required|unique:Finteches',
            'descriptions' => 'required',
        ]);

        $fintech = Fintech::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('card-pic');
            $fintech->image()->create($data);
        }

        return redirect('/dashboard/fintech')->with(
            'success',
            'Data Has Been added..!!'
        );
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
        return view('dashboard.fintech.edit', [
            'title' => 'Edit Fintech',
            'data' => $fintech->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fintech $fintech)
    {
        $rules = [
            'descriptions' => 'required',
        ];

        if ($request->name != $fintech->name) {
            $rules['name'] = 'required|unique:finteches';
        }
        if ($request->slug != $fintech->slug) {
            $rules['slug'] = 'required|unique:finteches';
        }

        $validatedData = $request->validate($rules);

        Fintech::where('id', $fintech->id)->update($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $fintech->image()->delete();
            }
            $data['pic'] = $request->file('pic')->store('card-pic');
            $fintech->image()->create($data);
        }

        return redirect('/dashboard/fintech')->with(
            'success',
            'Data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fintech $fintech)
    {
        if ($fintech->acountFintech) {
            foreach ($fintech->acountFintech as $card) {
                if ($card->image) {
                    storage::delete($card->image);
                    $card->image->delete();
                }
            }
        }
        $fintech->destroy($fintech->id);
        if ($fintech->image) {
            Storage::delete($fintech->image->pic);
            $fintech->image->delete();
        }

        return redirect('/dashboard/fintech')->with(
            'success',
            'Data Has Been Deleted..!!'
        );
    }

    public function createcard(Fintech $fintech)
    {
        return view('dashboard.fintech.card.create', [
            'title' => 'Add Card',
            'data' => $fintech,
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Fintech::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function cardcheckSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            acountFintech::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }

    public function storecard(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:acount_finteches',
            'slug' => 'required|unique:acount_finteches',
            'number' => 'required|numeric|min:4',
        ]);

        $validatedData['fintech_id'] = $request->fintech_id;

        $card = acountFintech::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('card-pic');
            $card->image()->create($data);
        }

        return redirect('/dashboard/fintech/' . $request->fintech_slug)->with(
            'success',
            'Data Has Been Aded..!!'
        );
    }

    public function carddestroy(acountFintech $acountFintech)
    {
        $acountFintech->destroy($acountFintech->id);

        if ($acountFintech->image) {
            Storage::delete($acountFintech->image->pic);
            $acountFintech->image->delete();
        }
        return redirect(
            '/dashboard/fintech/' . $acountFintech->fintech->slug
        )->with('success', 'Data Has Been Deleted..!!');
    }

    public function editcard(acountFintech $acountFintech)
    {
        return view('dashboard.fintech.card.edit', [
            'title' => 'Edit Card',
            'data' => $acountFintech->load('image', 'fintech'),
        ]);
    }

    public function updatecard(acountFintech $acountFintech, Request $request)
    {
        $rules = [
            'number' => 'required|numeric|min:4',
        ];

        if ($request->name != $acountFintech->name) {
            $rules['name'] = 'required|unique:acount_finteches';
        }
        if ($request->slug != $acountFintech->slug) {
            $rules['slug'] = 'required|unique:acount_finteches';
        }

        $validatedData = $request->validate($rules);

        acountFintech::where('id', $acountFintech->id)->update($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $acountFintech->image()->delete();
            }
            $data['pic'] = $request->file('pic')->store('card-pic');
            $acountFintech->image()->create($data);
        }
        return redirect(
            '/dashboard/fintech/' . $acountFintech->fintech->slug
        )->with('success', 'Data Has Been Deleted..!!');
    }
}
