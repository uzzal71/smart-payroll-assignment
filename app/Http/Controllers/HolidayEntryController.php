<?php

namespace App\Http\Controllers;

use App\Models\OfficeHolidayDetail;
use App\Models\HolidayEntry;
use Illuminate\Http\Request;
use DateTime;

class HolidayEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $holiday_entries = HolidayEntry::orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $holiday_entries = $holiday_entries->where('holiday_name', 'like', '%'.$sort_search.'%');
        }
        $holiday_entries = $holiday_entries->paginate(10);
        return view('hr_management.holiday_entry.index', compact('holiday_entries', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr_management.holiday_entry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $holiday_entry = new HolidayEntry();

        $begin = new DateTime( $request->from_date );
        $end   = new DateTime( $request->to_date );
        $year = $end->format('Y');
        $month = $end->format('m');

        $days = 0;
        $dates =array();

        for($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $days += 1;
            $dates[] = $i->format('Y-m-d');
        }

        $holiday_entry->holiday_name = $request->holiday_name;
        $holiday_entry->from_date = $request->from_date;
        $holiday_entry->to_date = $request->to_date;
        $holiday_entry->holiday_days = $days;
        $holiday_entry->holiday_month = $month;
        $holiday_entry->holiday_year = $year;
        $holiday_entry->remarks = $request->remarks;
        $holiday_entry->status	 = 'active';

        $holiday_entry->save();

        foreach ($dates as $value) {
            $holiday_detail = new OfficeHolidayDetail;

            $holiday_detail->holiday_id  = $holiday_entry->id ;
            $holiday_detail->holiday_date = $value;
            $holiday_detail->remarks = $request->remarks;

            $holiday_detail->save();
        }

        flash('Holiday Entries has been inserted successfully')->success();
        return redirect()->route('holiday_entries.index');
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
        $holiday = HolidayEntry::findOrFail($id);

        return view('hr_management.holiday_entry.edit', compact('holiday'));
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
        $holiday_entry = HolidayEntry::findOrFail($id);
        OfficeHolidayDetail::where('holiday_id', $id)->delete();

        $begin = new DateTime( $request->from_date );
        $end   = new DateTime( $request->to_date );
        $year = $end->format('Y');
        $month = $end->format('m');

        $days = 0;
        $dates =array();

        for($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $days += 1;
            $dates[] = $i->format('Y-m-d');
        }

        $holiday_entry->holiday_name = $request->holiday_name;
        $holiday_entry->from_date = $request->from_date;
        $holiday_entry->to_date = $request->to_date;
        $holiday_entry->holiday_days = $days;
        $holiday_entry->holiday_month = $month;
        $holiday_entry->holiday_year = $year;
        $holiday_entry->remarks = $request->remarks;
        $holiday_entry->status	 = 'active';

        $holiday_entry->save();

        foreach ($dates as $value) {
            $holiday_detail = new OfficeHolidayDetail;

            $holiday_detail->holiday_id  = $holiday_entry->id ;
            $holiday_detail->holiday_date = $value;
            $holiday_detail->remarks = $request->remarks;

            $holiday_detail->save();
        }

        flash('Holiday Entries has been updated successfully')->success();
        return redirect()->route('holiday_entries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OfficeHolidayDetail::where('holiday_id', $id)->delete();
        HolidayEntry::find($id)->delete();

        flash('Holiday entries has been deleted successfully')->success();

        return redirect()->route('holiday_entries.index');
    }
}
