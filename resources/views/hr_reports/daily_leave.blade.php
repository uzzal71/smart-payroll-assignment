@extends('layouts.app')

@section('content')

<div class="row">
    <!-- Select Box -->
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Filters</h5>
            </div>
            <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Date</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="xxxx-xx-xx" id="from_date" name="from_date" value="{{ $from_date }}" class="form-control" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="department_id" id="department_id" data-live-search="true" required>
                                <option value="">Select Department</option>
                                <option value="all">All</option>
                                @foreach (\App\Models\Department::all() as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Designation</label>
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="designation_id" id="designation_id" data-live-search="true" required>
                                <option value="">Select Designation</option>
                                <option value="all">All</option>
                                @foreach (\App\Models\Designation::all() as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Schedule</label>
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="schedule_id" id="schedule_id" data-live-search="true" required>
                                <option value="">Select Schedule</option>
                                <option value="all">All</option>
                                @foreach (\App\Models\Schedule::all() as $schedule)
                                <option value="{{ $schedule->id }}">{{ $schedule->schedule_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="">Select Status</option>
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

               
            </div>
        </div>
    </div>
    <!-- Select Box -->

    <!-- Employee Box -->
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Employee List <span class="badge badge-warning" id="select-box"></span></h5>
            </div>
            <div class="card-body">
                <div class="FixedHeightContainer">
                <div id="result" class="Content">
                    {{-- Get filter employee data --}}
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Employee Box -->
</div>

<div class="row">
    <div class="col-12 text-center">
        <button type="button" class="btn btn-success mt-2 mb-4" id="daily_leave_report">Submit</button>
    </div>
</div>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $( "#department_id" ).change(function() {get_update_employee_list()});
        $( "#designation_id" ).change(function() {get_update_employee_list()});
        $( "#schedule_id" ).change(function() {get_update_employee_list()});
        $( "#status" ).change(function() {get_update_employee_list()});

        function get_update_employee_list() {
            var department_id = document.getElementById('department_id').value;
            var designation_id = document.getElementById('designation_id').value;
            var schedule_id = document.getElementById('schedule_id').value;
            var status = document.getElementById('status').value;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:'{{ route('ajax.get_employee') }}',
                data: {
                    'department_id': department_id,
                    'designation_id': designation_id,
                    'schedule_id': schedule_id,
                    'status': status
                },
                success: function(data) {
                    $('#result').html(data.output);
                }
            });
        }

        for(var i = 0; i < 1000; i++) {
            (function(index) {
                setTimeout(function() {
                    var check = $('#result').find('input[type=checkbox]:checked').length;
                    $('#select-box').html(check);
                }, index*1000);
            })(i);
        }
    });

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
        $('#daily_leave_report').click(function() {
            var from_date = document.getElementById('from_date').value;
            var employee_id = [];
            $.each($("input[type=checkbox].check-one:checked"), function(){
                employee_id.push($(this).val());
            });

            // validation
            if (from_date == '') {
                AIZ.plugins.notify('danger', 'Please input date');
                return false;
            }

            if (employee_id.length == 0) {
                AIZ.plugins.notify('danger', 'Please select employees');
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:'{{ route('daily.leave.report') }}',
                data: {
                    'from_date': from_date,
                    'employee_id': employee_id
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var blob=new Blob([data]);
                    var link=document.createElement('a');
                    link.href=window.URL.createObjectURL(blob);
                    var currentdate = new Date();
                    link.download="daily_leave_report.pdf";
                    link.click();
                },
                error: function(blob){
                    console.log(blob);
                }
            });
        });
    });
</script>

<style>
    .FixedHeightContainer
    {
        float:right;
        height: 292px;
        width:100%;
        padding:3px;
        background:#ef4f2d;
    }
    .Content
    {
        height:286px;
        overflow:auto;
        background:#fff;
    }
</style>
@endsection
