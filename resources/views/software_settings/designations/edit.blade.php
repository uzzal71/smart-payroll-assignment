@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Designation Edit</h5>
                <div class="col text-right">
                    <a href="{{ route('designations.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('designations.update', $designation->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Designation Name</label>
                        <div class="col-md-9">
                            <input type="text" name="designation_name" value="{{ $designation->designation_name }}" class="form-control" id="name" placeholder="Designation Name" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="active" @if ($designation->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if ($designation->digital == 'inactive') selected @endif>Inactive</option>
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
