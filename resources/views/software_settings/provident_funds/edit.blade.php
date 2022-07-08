@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Provident Fund Edit</h5>
                <div class="col text-right">
                    <a href="{{ route('provident_funds.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('provident_funds.update', $provident_fund->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Provident Fund Name</label>
                        <div class="col-md-9">
                            <input type="text" name="provident_fund_name" value="{{ $provident_fund->provident_fund_name }}" class="form-control" id="provident_fund_name" placeholder="Provident Fund Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Percentage</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="percentage" value="{{ $provident_fund->percentage }}" placeholder="Percentage">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="active" @if ($provident_fund->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if ($provident_fund->digital == 'inactive') selected @endif>Inactive</option>
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
