@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Employee Attendance</h5>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form class="" id="sort_salary_advances" action="" method="GET" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{ Auth::user()->name; }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Month</label>
                        <div class="col-md-9">
                            <select name="month" id="month" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0">Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Year</label>
                        <div class="col-md-9">
                            <select name="year" id="year" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0">Select Year</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <!-- Search Form -->
            </div>
        </div>
        @if(!empty($attendances))
        @if(!empty($attendance_summary))
        <div class="card">
            <div class="card-body">
                <h5>Attendance Summary</h5>
                <table class="table table-bordered">
                    <tr>
                        <td>Total Days</td>
                        <td>{{ $attendance_summary->number_of_days }}</td>
                        <td>Weekend</td>
                        <td>{{ $attendance_summary->weekend }}</td>
                    </tr>
                    <tr>
                        <td>Holiday</td>
                        <td>{{ $attendance_summary->holiday }}</td>
                        <td>Need To Work</td>
                        <td>{{ $attendance_summary->need_to_work }}</td>
                    </tr>
                    <tr>
                        <td>Present</td>
                        <td>{{ $attendance_summary->present }}</td>
                        <td>Late</td>
                        <td>{{ $attendance_summary->late }}</td>
                    </tr>
                    <tr>
                        <td>Absent</td>
                        <td>{{ $attendance_summary->absent }}</td>
                        <td>Unpaid Leave</td>
                        <td>{{ $attendance_summary->unpaid_leave }}</td>
                    </tr>
                    <tr>
                        <td>Paid Leave</td>
                        <td>{{ $attendance_summary->paid_leave }}</td>
                        <td>Need To Pay</td>
                        <td>{{ $attendance_summary->need_to_pay }}</td>
                    </tr>
                </table>
                <h5>Attendance Time Sheet</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>In-Time</th>
                            <th>Out-Time</th>
                            <th>Late-Time</th>
                            <th>Over-Time</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $key => $row)
                        <tr>
                            <td>{{ $row->attendance_date }}</td>
                            <td>{{ $row->in_time }}</td>
                            <td>{{ $row->out_time }}</td>
                            <td>{{ $row->late_time }}</td>
                            <td>{{ $row->over_time }}</td>
                            <td>{{ $row->attendance_status }}</td>
                            <td>{{ strip_tags($row->remarks) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>

@endsection
