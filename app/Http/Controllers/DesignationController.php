<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $designations = Designation::orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $designations = $designations->where('designation_name', 'like', '%'.$sort_search.'%');
        }

        $designations = $designations->paginate(50);

        return view('software_settings.designations.index', compact('designations', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.designations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designation = new Designation;

        $designation->designation_name = $request->designation_name;
        $designation->status	 = $request->status;


        $designation->save();

        flash('Designation has been inserted successfully')->success();
        return redirect()->route('designations.index');
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
        $designation = Designation::findOrFail($id);

        return view('software_settings.designations.edit', compact('designation'));
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
        $designation = Designation::findOrFail($id);

        $designation->designation_name = $request->designation_name;
        $designation->status	 = $request->status;

        $designation->save();

        flash('Designation has been updated successfully')->success();
        return redirect()->route('designations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Designation::find($id)->delete();
        flash('Designation has been deleted successfully')->success();

        return redirect()->route('designations.index');
    }
}
