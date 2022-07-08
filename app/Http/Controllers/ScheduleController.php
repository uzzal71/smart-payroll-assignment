<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $schedules = Schedule::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $schedules = $schedules->where('schedule_name', 'like', '%'.$sort_search.'%');
        }
        $schedules = $schedules->paginate(100);
        return view('software_settings.schedules.index', compact('schedules', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedule;

        $schedule->schedule_name = $request->schedule_name;
        $schedule->office_start = $request->office_start;
        $schedule->office_late_start = $request->office_late_start;
        $schedule->office_late_end = $request->office_late_end;
        $schedule->office_end = $request->office_end;
        $schedule->office_over_time_start = $request->office_over_time_start;
        $schedule->office_over_time_end	 = $request->office_over_time_end;
        $schedule->status	 = $request->status;


        $schedule->save();

        flash('Schedule has been inserted successfully')->success();
        return redirect()->route('schedules.index');
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
        $schedule = Schedule::findOrFail($id);

        return view('software_settings.schedules.edit', compact('schedule'));
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
        $schedule = Schedule::findOrFail($id);

        $schedule->schedule_name = $request->schedule_name;
        $schedule->office_start = $request->office_start;
        $schedule->office_late_start = $request->office_late_start;
        $schedule->office_late_end = $request->office_late_end;
        $schedule->office_end = $request->office_end;
        $schedule->office_over_time_start = $request->office_over_time_start;
        $schedule->office_over_time_end	 = $request->office_over_time_end;
        $schedule->status	 = $request->status;

        $schedule->save();

        flash('Schedule has been updated successfully')->success();
        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::find($id)->delete();
        flash('Schedule has been deleted successfully')->success();

        return redirect()->route('schedules.index');
    }
}
