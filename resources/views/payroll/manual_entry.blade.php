@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Munual Entry</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" id="search_form" action="{{ route('attendances.create') }}" method="GET" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">From Date</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="from_date" name="from_date"@isset($from_date) value="{{ $from_date }}" @endisset placeholder="XXXX-XX-XX">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">To Date</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="to_date" name="to_date"@isset($to_date) value="{{ $to_date }}" @endisset placeholder="XXXX-XX-XX">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee Punch Card</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="punch_card" name="punch_card"@isset($punch_card) value="{{ $punch_card }}" @endisset placeholder="Type Card Id & Enter">
                        </div>
                    </div>

                    <button id="myBtn" style="display: none;"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- get Attendance -->
@isset($punch_card)
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="card-title">Save Munual Entry</h5>
                        </div>
                        <div class="col-sm-6">
                            @if ($emp_info)
                                <h5 class="mb-0 h6">{{ $emp_info->employee_name }}({{ $emp_info->employee_punch_card }})</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('attendances.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Id</th>
                                <th>Date</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $key => $attendance)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                {{ $punch_card }}
                                <input type="hidden" name="employee_id[]" value="{{ $attendance['punch_card'] }}">
                                </td>
                                <td>
                                    <input type="text" class="form-customer" id="attendance_date" name="attendance_date[]" value="{{ $attendance['attendance_date'] }}" placeholder="00:00">
                                </td>
                                <td>
                                   <input type="text" class="form-customer" id="attendance_in" name="attendance_in[]" value="{{ $attendance['attendance_in'] }}" placeholder="00:00">
                                </td>
                                <td>
                                   <input type="text" class="form-customer" id="attendance_out" name="attendance_out[]" value="{{ $attendance['attendance_out'] }}" placeholder="00:00">
                                </td>
                                <td>
                                   <input type="text" class="form-customer" id="status" name="status[]" value="{{ $attendance['status'] }}" placeholder="" readonly>
                                </td>
                                <td>
                                   <input type="text[]" class="form-customer" id="remarks" name="remarks" value="{{ strip_tags($attendance['remarks']) }}" placeholder="" readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endisset

@endsection

@section('script')
<script>
var input = document.getElementById("punch_card");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("myBtn").click();
  }
});
</script>

<style type="text/css">
    .form-customer {
        width: 90px !important;
        text-align: center !important;
    }
</style>
@endsection
