<!-- resources/views/admin/all_permission.blade.php -->

@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.admin') }}" class="btn btn-inverse-info" rel="noopener noreferrer">Add
                    Admin</a>
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
                        <h6 class="card-title">All Admin</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alladmin as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img class="wd-100 rounded-circle"
                                                    src="{{ !empty($adminUser->item) ? url('upload/admin_image/' . $adminUser->photo) : url('upload/no_image.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>role</td>
                                            <td>
                                                <a href="{{ route('edit.permission', $item->id) }}"
                                                    class="btn btn-inverse-warning">Edit</a>
                                                <a href="{{ route('delete.permission', $item->id) }}"
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
