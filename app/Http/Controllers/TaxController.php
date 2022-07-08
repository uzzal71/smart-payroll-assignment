<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $taxs = Tax::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $taxs = $taxs->where('tax_name', 'like', '%'.$sort_search.'%');
        }
        $taxs = $taxs->paginate(100);
        return view('software_settings.taxs.index', compact('taxs', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.taxs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tax = new Tax;

        $tax->tax_name = $request->tax_name;
        $tax->percentage = $request->percentage;
        $tax->status	 = $request->status;


        $tax->save();

        flash('Tax has been inserted successfully')->success();
        return redirect()->route('taxs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Tax::findOrFail($id);

        return view('software_settings.taxs.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tax = Tax::findOrFail($id);

        $tax->tax_name = $request->tax_name;
        $tax->percentage = $request->percentage;
        $tax->status	 = $request->status;

        $tax->save();

        flash('Tax has been updated successfully')->success();
        return redirect()->route('taxs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tax::find($id)->delete();
        flash('Tax has been deleted successfully')->success();

        return redirect()->route('taxs.index');
    }
}
