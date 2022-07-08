@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Holiday Entry</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('holiday_entries.create') }}" class="btn btn-primary">
                <span>Add New Holiday</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Holiday Entries</h5>
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
                    <th>Holiday name</th>
                    <th>Form date</th>
                    <th>To date</th>
                    <th>Holiday days</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holiday_entries as $key => $holiday_entry)
                    <tr>
                        <td>{{ ($key+1) + ($holiday_entries->currentPage() - 1)*$holiday_entries->perPage() }}</td>
                        <td>{{ $holiday_entry->holiday_name }}</td>
                        <td>{{ $holiday_entry->from_date }}</td>
                        <td>{{ $holiday_entry->to_date }}</td>
                        <td>{{ $holiday_entry->holiday_days }}</td>
                        <td><?php echo $holiday_entry->remarks; ?></td>
                        <td>{{ $holiday_entry->status }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('holiday_entries.edit', $holiday_entry->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('holiday_entries.destroy', $holiday_entry->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $holiday_entries->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
