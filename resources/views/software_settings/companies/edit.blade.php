@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Advance Salry Edit</h5>
                <div class="col text-right">
                    <a href="{{ route('advance_salaries.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Full Name</label>
                        <div class="col-md-9">
                            <input type="text" name="company_full_name" value="{{ $company->company_full_name }}" class="form-control" id="name" placeholder="Company Full Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">short name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_short_name" value="{{ $company->company_short_name }}" placeholder="Company short name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Owner name</label>
                        <div class="col-md-9">
                            <input type="text" name="owner_name" value="{{ $company->owner_name }}" class="form-control" id="name" placeholder="Owner name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" name="phone" value="{{ $company->phone }}" class="form-control" id="phone" placeholder="Phone" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" name="email" value="{{ $company->email }}" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Website</label>
                        <div class="col-md-9">
                            <input type="text" name="website" value="{{ $company->website }}" class="form-control" id="website" placeholder="Website" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Address</label>
                        <div class="col-md-9">
                            <textarea name="address" rows="5" class="form-control">{{ $company->address }}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="active" @if ($company->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if ($company->digital == 'inactive') selected @endif>Inactive</option>
                            </select>
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
