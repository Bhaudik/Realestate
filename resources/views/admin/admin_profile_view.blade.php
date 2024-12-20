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

								<form class="forms-sample" method="POST" action="{{route('admin.profile.store')}}" enctype="multipart/form-data">
									@csrf
                                    <div class="mb-3">
										<label for="username" class="form-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" value="{{$adminUser->username}}" autocomplete="off" placeholder="username">
									</div>
                                    <div class="mb-3">
										<label for="name" class="form-label">Name</label>
										<input type="text" class="form-control" id="name" name="name" value="{{$adminUser->name}}" autocomplete="off" placeholder="name">
									</div>
									<div class="mb-3">
										<label for="phone" class="form-label">Phone</label>
										<input type="number" class="form-control" id="phone" placeholder="phone" value="{{$adminUser->phone}}" name="phone">
									</div>
                                    <div class="mb-3">
										<label for="address" class="form-label">Address</label>
										<input type="text" class="form-control" id="address" name="address" value="{{$adminUser->address}}" autocomplete="off" placeholder="address">
									</div>
                                    <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Email address</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$adminUser->email}}" name="email">
									</div>
                                    <div class="mb-3">
										<label class="form-label" for="photo">Photo upload</label>
										<input class="form-control" type="file" id="image" name="photo">
									</div>
                                    <div class="mb-3">
                                        <img id="showImage" class="wd-80 rounded-circle" src="{{ (!empty($adminUser->photo)) ? url('upload/admin_image/'.$adminUser->photo): url('upload/no_image.jpg') }}" alt="profile">
									</div>									
									<button type="submit" class="btn btn-primary me-2">Submit</button>
									<button class="btn btn-secondary">Cancel</button>
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

<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);

            }
            reader.readAsDataURL(e.target.files['0']);            
        });
    });
</script>

@endsection