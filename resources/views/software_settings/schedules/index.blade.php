@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Schedule</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('schedules.create') }}" class="btn btn-primary">
                <span>Add New Schedule</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Schedules</h5>
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
                    <th>Schedule Name</th>
                    <th>Office Start</th>
                    <th>Late Start</th>
                    <th>Late End</th>
                    <th>Office End</th>
                    <th>OT Start</th>
                    <th>OT End</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $key => $schedule)
                    <tr>
                        <td>{{ ($key+1) + ($schedules->currentPage() - 1)*$schedules->perPage() }}</td>
                        <td>{{ $schedule->schedule_name }}</td>
                        <td>{{ $schedule->office_start }}</td>
                        <td>{{ $schedule->office_late_start }}</td>
                        <td>{{ $schedule->office_late_end }}</td>
                        <td>{{ $schedule->office_end }}</td>
                        <td>{{ $schedule->office_over_time_start }}</td>
                        <td>{{ $schedule->office_over_time_end }}</td>
                        <td>{{ $schedule->status }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('schedules.edit', $schedule->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('schedules.destroy', $schedule->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $schedules->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
