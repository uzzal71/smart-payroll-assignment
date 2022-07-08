@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Employee Leave</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('employee_leaves.create') }}" class="btn btn-primary">
                <span>Add New Leave</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Employee Leaves</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name & Enter">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Form Date</th>
                    <th>To Date</th>
                    <th>Leave Days</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee_leaves as $key => $employee_leave)
                    <tr>
                        <td>{{ ($key+1) + ($employee_leaves->currentPage() - 1)*$employee_leaves->perPage() }}</td>
                        <td>
                            {{ $employee_leave->employee->employee_name  }}
                            ({{ $employee_leave->employee->employee_punch_card  }})
                        </td>
                        <td>{{ $employee_leave->leave->leave_name  }}</td>
                        <td>{{ $employee_leave->from_date  }}</td>
                        <td>{{ $employee_leave->to_date  }}</td>
                        <td>{{ $employee_leave->leave_days  }}</td>
                        <td>{{ $employee_leave->status == 0 ? 'Pending' : 'Approve' }}</td>
                        <td>
                            <form action="{{ route('employee_leaves.approval', $employee_leave->id) }}" style="display: inline-block;" method="post">
                                @csrf
                                @if($employee_leave->status == 0)
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Approved">
                                    AP
                                </button>
                                @else
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Unapproved">
                                        UP
                                    </button>
                                @endif
                            </form>

                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('employee_leaves.edit', $employee_leave->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('employee_leaves.destroy', $employee_leave->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $employee_leaves->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
