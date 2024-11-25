@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">


        <div class="row profile-body">

            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Edit Roles</h6>

                            <form class="forms-sample" method="POST" action="{{ route('update.roles') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $roles->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Roles name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="role_name" name="name" value="{{ $roles->name }}" autocomplete="off"
                                        placeholder="Property Type Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Change Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
