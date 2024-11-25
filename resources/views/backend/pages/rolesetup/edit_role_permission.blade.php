@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style type="text/css">
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <div class="page-content">
        <div class="row profile-body">

            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Roles and permission</h6>

                            <form class="forms-sample" method="POST" action="{{ route('admin.roles.updates', $roles->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Group name</label>
                                    <h3>{{ $roles->name }}</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                        <label class="form-check-label" for="checkDefaultmain">
                                            All Prmissions
                                        </label>
                                    </div>
                                </div>
                                <hr>

                                @foreach ($permission_group as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName(
                                                    $group->group_name,
                                                );
                                            @endphp
                                            <div class="mb-4">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="checkDefault"
                                                        {{ App\Models\User::roleHasPermission($roles, $permissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkDefault">
                                                        {{ $group->group_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-9">

                                            @foreach ($permissions as $permission)
                                                <div class="mb-4">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="checkDefault{{ $permission->id }}"
                                                            value="{{ $permission->id }}" name="permission[]"
                                                            {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }}>


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
                                <button type="submit" class="btn btn-primary me-2">Save Change </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type = checkbox]').prop('checked', true)
            } else {
                $('input[type = checkbox]').prop('checked', false)
            }
        });
    </script>
@endsection
