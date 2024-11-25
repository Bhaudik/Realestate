@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">


        <div class="row profile-body">

            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Permission Type</h6>

                            <form class="forms-sample" method="POST" action="{{ route('store.permission') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" autocomplete="off" placeholder="Property Type Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Group name</label>
                                    <select class="form-select" name="group_name" id="exampleFormControlSelect1">
                                        <option selected disabled>Select Group</option>
                                        <option value="type">property type</option>
                                        <option value="amenities">Amenities</option>
                                    </select>
                                    @error('type_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>





                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
