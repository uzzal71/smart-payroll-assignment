@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Cronjobs</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('cronjobs.create') }}" class="btn btn-primary">
                <span>Add New Job</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Cronjobs</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Month & Enter">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Month & Year</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cronjobs as $key => $cronjob)
                    <tr>
                        <td>{{ ($key+1) + ($cronjobs->currentPage() - 1)*$cronjobs->perPage() }}</td>
                        <td>{{ $cronjob->cron_job_month }}</td>
                        <td>{{ $cronjob->cron_job_year }}</td>
                        <td>{{ $cronjob->month_year }}</td>
                        <td>{{ $cronjob->status }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('cronjobs.edit', $cronjob->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('cronjobs.destroy', $cronjob->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $cronjobs->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
