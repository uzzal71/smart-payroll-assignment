@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Leave</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('leaves.create') }}" class="btn btn-primary">
                <span>Add New Leave</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Leaves</h5>
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
                    <th>Leave Name</th>
                    <th>Leave Days</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $key => $leave)
                    <tr>
                        <td>{{ ($key+1) + ($leaves->currentPage() - 1)*$leaves->perPage() }}</td>
                        <td>{{ $leave->leave_name }}</td>
                        <td>{{ $leave->leave_days }}</td>
                        <td>{{ $leave->status }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('leaves.edit', $leave->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('leaves.destroy', $leave->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $leaves->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
