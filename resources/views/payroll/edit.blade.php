@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Upload File Edit</h5>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('upload.update', $upload->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Month</label>
                        <div class="col-md-9">
                            <select name="attendance_month" id="attendance_month" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="January" @if("January" == $upload->attendance_month) selected @endif>January</option>
                                <option value="February" @if("February" == $upload->attendance_month) selected @endif>February</option>
                                <option value="March" @if("March" == $upload->attendance_month) selected @endif>March</option>
                                <option value="April" @if("April" == $upload->attendance_month) selected @endif>April</option>
                                <option value="May" @if("May" == $upload->attendance_month) selected @endif>May</option>
                                <option value="June" @if("June" == $upload->attendance_month) selected @endif>June</option>
                                <option value="July" @if("July" == $upload->attendance_month) selected @endif>July</option>
                                <option value="August" @if("August" == $upload->attendance_month) selected @endif>August</option>
                                <option value="September" @if("September" == $upload->attendance_month) selected @endif>September</option>
                                <option value="October" @if("October" == $upload->attendance_month) selected @endif>October</option>
                                <option value="November" @if("November" == $upload->attendance_month) selected @endif>November</option>
                                <option value="December" @if("December" == $upload->attendance_month) selected @endif>December</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Year</label>
                        <div class="col-md-9">
                            <select name="attendance_year" id="attendance_year" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                 <option value="2021" @if(2021 == $upload->attendance_year) selected @endif>2021</option>
                                <option value="2022" @if(2022 == $upload->attendance_year) selected @endif>2022</option>
                                <option value="2023" @if(2023 == $upload->attendance_year) selected @endif>2023</option>
                                <option value="2024" @if(2024 == $upload->attendance_year) selected @endif>2024</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Select Upload Excel</label>
                        <div class="col-md-9">
                            <input type="file" placeholder="Upload File Name" id="upload_file_name" name="upload_file_name" class="form-control">
                            <input type="hidden" name="old_upload_file_name" value="{{ $upload->upload_path }}">
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
