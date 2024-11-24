@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


	<div class="page-content">

       
        <div class="row profile-body">
          <!-- left wrapper start -->
          <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                     <div>
                    <img class="wd-100 rounded-circle" src="{{ (!empty($adminUser->photo)) ? url('upload/admin_image/'.$adminUser->photo): url('upload/no_image.jpg') }}" alt="profile">
                    <span class="h4 ms-3 ">{{$adminUser->name}}</span>
                  </div>
                 
                </div>
                               
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                  <p class="text-muted">{{$adminUser->name}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
                  <p class="text-muted">{{$adminUser->address}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                  <p class="text-muted">{{$adminUser->email}}</p>
                </div>
                 <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                  <p class="text-muted">{{$adminUser->phone}}</p>
                </div>
               
              </div>
            </div>
          </div>
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="card">
              <div class="card-body">

								<h6 class="card-title">Basic Form</h6>

								<form class="forms-sample" method="POST" action="{{route('admin.update.password')}}" enctype="multipart/form-data">
									@csrf
                                    <div class="mb-3">
										<label for="old_password" class="form-label">Old Password</label>
										<input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" autocomplete="off" placeholder="Old password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>                                            
                                        @enderror
									</div>

                                     <div class="mb-3">
										<label for="new_password" class="form-label">New Password</label>
										<input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" autocomplete="off" placeholder="New password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>                                            
                                        @enderror
									</div>

                                     <div class="mb-3">
										<label for="new_confirm_password" class="form-label">New Confirm Password</label>
										<input type="password" class="form-control " id="new_password_confirmation" name="new_password_confirmation" autocomplete="off" placeholder="Confirm New password">
									</div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
								</form>

              </div>
            </div>
            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->
       
          <!-- right wrapper end -->
        </div>

			</div>


@endsection