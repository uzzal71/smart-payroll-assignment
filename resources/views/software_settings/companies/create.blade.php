@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Company Information</h5>
                <div class="col text-right">
                    <a href="{{ route('companies.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Full Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Company Full Name" id="company_full_name" name="company_full_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">short name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_short_name" id="company_short_name" placeholder="Company short name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Owner name</label>
                        <div class="col-md-9">
                            <input type="text" name="owner_name" class="form-control" id="owner_name" placeholder="Owner name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Website</label>
                        <div class="col-md-9">
                            <input type="text" name="website" class="form-control" id="website" placeholder="Website" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Address</label>
                        <div class="col-md-9">
                            <textarea name="address" id="address" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
