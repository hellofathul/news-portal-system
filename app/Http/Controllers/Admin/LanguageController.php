<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();   
        return view("admin.language.index", compact("languages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.language.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreLanguageRequest $request)
    {
        $language = new Language();
        $language->name = $request->name;
        $language->language = $request->language;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;
        $language->save();
        toast(__('Created successfully!'),'success')->width("300");
        return redirect()->route("admin.language.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
