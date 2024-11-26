@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Update Admin</h6>

                            <form class="forms-sample" method="POST" action="{{ route('update.admin', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" autocomplete="off" placeholder="Admin Name"
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" autocomplete="off" placeholder="Username"
                                        value="{{ $user->username }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" autocomplete="off" placeholder="Email Address"
                                        value="{{ $user->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" autocomplete="off" placeholder="Phone Number"
                                        value="{{ $user->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                        placeholder="Address">{{ $user->address }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- role11 --}}
                                <div class="mb-3">
                                    <label for="address" class="form-label">Role name</label>
                                    <select class="form-select" name="roles" id="exampleFormControlSelect1">
                                        <option selected disabled>Select Group</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}> {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
