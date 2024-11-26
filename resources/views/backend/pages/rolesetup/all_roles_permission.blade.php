<!-- resources/views/admin/all_permission.blade.php -->

@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.permission') }}" class="btn btn-inverse-info" rel="noopener noreferrer">Add
                    Permission</a>
                <!-- Export Button -->
                &nbsp;
                <a href="{{ route('export.permissions') }}" class="btn btn-inverse-success"
                    rel="noopener noreferrer">Export</a>
                <!-- Import Button -->
                &nbsp;
                <a href="{{ route('import.permissions.view') }}" class="btn btn-inverse-danger"
                    rel="noopener noreferrer">Import</a>
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
                                        <th>Roles name</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($item->permissions as $prem)
                                                    <span class="badge bg-danger">{{ $prem->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.permission', $item->id) }}"
                                                    class="btn btn-inverse-warning">Edit</a>
                                                <a href="{{ route('admin.roles.delete', $item->id) }}"
                                                    class="btn btn-inverse-danger">Delete</a>
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
