<?php

namespace App\Http\Controllers;

use App\Models\CronJob;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $cronjobs = CronJob::orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $cronjobs = $cronjobs->where('cron_job_month', 'like', '%'.$sort_search.'%');
        }
        $cronjobs = $cronjobs->paginate(500);
        return view('payroll.cronjobs.index', compact('cronjobs', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payroll.cronjobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cronjob = new CronJob;

        $cronjob->cron_job_month = $request->cron_job_month;
        $cronjob->cron_job_year = $request->cron_job_year;
        $cronjob->month_year = $request->cron_job_month.'-'.$request->cron_job_year;
        $cronjob->status	 = $request->status;

        $cronjob->save();

        flash('Cron jobs has been inserted successfully')->success();
        return redirect()->route('cronjobs.index');
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
        $cronjob = CronJob::findOrFail($id);

        return view('payroll.cronjobs.edit', compact('cronjob'));
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
        $cronjob = CronJob::findOrFail($id);

        $cronjob->cron_job_month = $request->cron_job_month;
        $cronjob->cron_job_year = $request->cron_job_year;
        $cronjob->month_year = $request->cron_job_month.'-'.$request->cron_job_year;
        $cronjob->status	 = $request->status;

        $cronjob->save();

        flash('Cron jobs has been updated successfully')->success();
        return redirect()->route('cronjobs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CronJob::find($id)->delete();
        flash('Cron jobs has been deleted successfully')->success();

        return redirect()->route('cronjobs.index');
    }
}
