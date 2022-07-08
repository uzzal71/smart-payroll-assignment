@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Uplaod</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('upload.create') }}" class="btn btn-primary">
                <span>Add New Upload</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Uploads</h5>
        <form class="" id="sort_categories" action="" method="GET" autocomplete="off">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Year & Enter">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Attendance Month</th>
                    <th>Attendance Year</th>
                    <th>Uplaod Path</th>
                    <th>Process Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($uploads as $key => $upload)
                    <tr>
                        <td>{{ ($key+1) + ($uploads->currentPage() - 1)*$uploads->perPage() }}</td>
                        <td>{{ $upload->attendance_month }}</td>
                        <td>{{ $upload->attendance_year }}</td>
                        <td>{{ $upload->upload_path }}</td>
                        <td>{{ $upload->process_status == 1 ? 'Please Waiting, Your file is processing' : 'File process complete' }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('upload.edit', $upload->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('upload.destroy', $upload->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $uploads->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
