@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Salary Setting Edit</h5>
                <div class="col text-right">
                    <a href="{{ route('salary_settings.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('salary_settings.update', $salary_setting->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Gross salary</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="gross_salary" value="{{ $salary_setting->gross_salary }}" placeholder="Gross salary">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Basic salary</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="basic_salary" value="{{ $salary_setting->basic_salary }}" placeholder="Basic salary">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">House Rent</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="house_rent" value="{{ $salary_setting->house_rent }}" placeholder="House Rent">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Medical Allowance</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="medical_allowance" value="{{ $salary_setting->medical_allowance }}" placeholder="Medical Allowance">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Transport Allowance</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="transport_allowance" value="{{ $salary_setting->transport_allowance }}" placeholder="Transport Allowance">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Food Allowance</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="food_allowance" value="{{ $salary_setting->food_allowance }}" placeholder="Food Allowance">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
