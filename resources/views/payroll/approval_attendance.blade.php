@extends('layouts.app')

@section('content')

<!-- get Attendance -->
@isset($attendances)
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                      <h5 class="card-title mt-3">Attendance Approval</h5>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-horizontal" id="search_form" action="{{ route('approval.attendance') }}" method="GET" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="text" class="form-control mt-2" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Card Id & Enter">
                    </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="check-all">
                            </th>
                            <th>Card Id</th>
                            <th>Date</th>
                            <th>In</th>
                            <th>Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $key => $attendance)
                        <tr>
                            <td>
                                <input type="checkbox" class="check-one" name="attendance_date[]" value="{{ $attendance->attendance_date }}:{{ $attendance->employee_id }}" id="attendance_date[]">
                            </td>
                            <td>{{  $attendance->employee_name }}({{ $attendance->employee_id }})</td>
                            <td>{{ $attendance->attendance_date }}</td>
                            <td>{{ $attendance->attendance_in }}</td>
                            <td>{{ $attendance->attendance_out }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Button start -->
                <div class="form-group mb-0 text-right">
                    <button type="button" class="btn btn-primary" id="attendance_approval_save">Save</button>
                </div>
                <!-- Button start -->
            </div>
        </div>
    </div>
</div>
@endisset

@endsection

@section('script')
<script>
$(document).on("change", ".check-all", function() {
    if(this.checked) {
        // Iterate each checkbox
        $('.check-one:checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $('.check-one:checkbox').each(function() {
            this.checked = false;
        });
    }
});

$(document).ready(function() {
    $('#attendance_approval_save').click(function() {

        var attendance_date = [];

        $.each($("input[type=checkbox].check-one:checked"), function(){
            attendance_date.push($(this).val());
        });

        if (attendance_date.length == 0) {
            AIZ.plugins.notify('danger', 'Please select employees');
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'{{ route('approval.attendance.save') }}',
            data: {
                'attendance_date': attendance_date
            },
            success: function(data) {
                AIZ.plugins.notify('success', 'Attendance approval');

                setTimeout(() => {
                    if(data.redirect_url){
                       window.location = data.redirect_url;
                    }
                }, 1000);
            }
        });
    });
});
</script>

<style type="text/css">
    .form-customer {
        width: 90px !important;
        text-align: center !important;
    }
</style>
@endsection
