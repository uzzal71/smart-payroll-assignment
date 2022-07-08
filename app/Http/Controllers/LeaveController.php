<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $leaves = Leave::orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $leaves = $leaves->where('leave_name', 'like', '%'.$sort_search.'%');
        }
        $leaves = $leaves->paginate(100);
        return view('software_settings.leaves.index', compact('leaves', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = new Leave();

        $leave->leave_name = $request->leave_name;
        $leave->short_name = $request->short_name;
        $leave->leave_days = $request->leave_days;
        $leave->status	 = $request->status;


        $leave->save();

        flash('Leave has been inserted successfully')->success();
        return redirect()->route('leaves.index');
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
        $leave = Leave::findOrFail($id);

        return view('software_settings.leaves.edit', compact('leave'));
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
        $leave = Leave::findOrFail($id);

        $leave->leave_name = $request->leave_name;
        $leave->short_name = $request->short_name;
        $leave->leave_days = $request->leave_days;
        $leave->status	 = $request->status;

        $leave->save();

        flash('Leave has been updated successfully')->success();
        return redirect()->route('leaves.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leave::find($id)->delete();
        flash('Leave has been deleted successfully')->success();

        return redirect()->route('leaves.index');
    }
}
