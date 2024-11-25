@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">


        <div class="row profile-body">

            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Roles and permission</h6>

                            <form class="forms-sample" method="POST" action="{{ route('store.roles') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Group name</label>
                                    <select class="form-select" name="group_name" id="exampleFormControlSelect1">
                                        <option selected disabled>Select Group</option>
                                        @foreach ($roles as $role)
                                            <option value="amenities">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            All Prmissions
                                        </label>
                                    </div>
                                </div>
                                <hr>

                                @foreach ($permission_group as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-4">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="checkDefault">
                                                    <label class="form-check-label" for="checkDefault">
                                                        {{ $group->group_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-9">
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName(
                                                    $group->group_name,
                                                );
                                            @endphp
                                            @foreach ($permissions as $permission)
                                                <div class="mb-4">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="checkDefault{{ $permission->id }}"
                                                            value="{{ $permission->name }}" name="permission[]">
                                                        <label class="form-check-label"
                                                            for="checkDefault{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
