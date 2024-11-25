<!-- resources/views/admin/all_permission.blade.php -->

@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.permission') }}" class="btn btn-inverse-info" rel="noopener noreferrer">Add Permission</a>
            <!-- Export Button -->
            <a href="{{ route('export.permissions') }}" class="btn btn-success" rel="noopener noreferrer">Export</a>
            <!-- Import Button -->
            <a href="{{ route('import.permissions.view') }}" class="btn btn-primary" rel="noopener noreferrer">Import</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Permission All</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Permission name</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permission as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->group_name }}</td>
                                        <td>
                                            <a href="{{ route('edit.permission', $item->id) }}" class="btn btn-inverse-warning">Edit</a>
                                            <a href="{{ route('delete.permission', $item->id) }}" class="btn btn-inverse-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
