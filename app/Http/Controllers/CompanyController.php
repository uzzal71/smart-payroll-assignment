<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $companies = Company::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $companies = $companies->where('company_full_name', 'like', '%'.$sort_search.'%');
        }
        $companies = $companies->paginate(50);
        return view('software_settings.companies.index', compact('companies', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software_settings.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company;

        $company->company_full_name = $request->company_full_name;
        $company->company_short_name = $request->company_short_name;
        $company->owner_name = $request->owner_name;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->address	 = $request->address;
        $company->status	 = $request->status;


        $company->save();

        flash('Company has been inserted successfully')->success();
        return redirect()->route('companies.index');
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
        $company = Company::findOrFail($id);

        return view('software_settings.companies.edit', compact('company'));
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
        $company = Company::findOrFail($id);

        $company->company_full_name = $request->company_full_name;
        $company->company_short_name = $request->company_short_name;
        $company->owner_name = $request->owner_name;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->address	 = $request->address;
        $company->status	 = $request->status;

        $company->save();

        flash('Company has been updated successfully')->success();
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::find($id)->delete();
        flash('Company has been deleted successfully')->success();

        return redirect()->route('companies.index');
    }
}
