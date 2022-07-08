<?php

namespace App\Http\Controllers;

use App\Models\ProvidentFund;
use Illuminate\Http\Request;

class ProvidentFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $provident_funds = ProvidentFund::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $provident_funds = $provident_funds->where('provident_fund_name', 'like', '%'.$sort_search.'%');
        }
        $provident_funds = $provident_funds->paginate(100);
        return view('software_settings.provident_funds.index', compact('provident_funds', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.provident_funds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provident_fund = new ProvidentFund;

        $provident_fund->provident_fund_name = $request->provident_fund_name;
        $provident_fund->percentage = $request->percentage;
        $provident_fund->status	 = $request->status;


        $provident_fund->save();

        flash('Provident Fund has been inserted successfully')->success();
        return redirect()->route('provident_funds.index');
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
        $provident_fund = ProvidentFund::findOrFail($id);

        return view('software_settings.provident_funds.edit', compact('provident_fund'));
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
        $provident_fund = ProvidentFund::findOrFail($id);

        $provident_fund->provident_fund_name = $request->provident_fund_name;
        $provident_fund->percentage = $request->percentage;
        $provident_fund->status	 = $request->status;

        $provident_fund->save();

        flash('Provident Fund has been updated successfully')->success();
        return redirect()->route('provident_funds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProvidentFund::find($id)->delete();
        flash('Provident Fund has been deleted successfully')->success();

        return redirect()->route('provident_funds.index');
    }
}
