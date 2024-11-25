@extends('admin.admin_dashboard')
@section('admin')



	<div class="page-content">

       
        <div class="row profile-body">
 
<div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="card">
              <div class="card-body">

								<h6 class="card-title">Update Amenities</h6>

								<form class="forms-sample" method="POST" action="{{route('update.amenities')}}" enctype="multipart/form-data">
									@csrf
                    <input type="hidden" name="id" value="{{ $amenities->id}}">
                  <div class="mb-3">
                    <label for="amenities_name" class="form-label">Amenities name</label>
                    <input type="text" class="form-control @error('amenities_name') is-invalid @enderror" id="amenities_name" name="amenities_name" value="{{$amenities->amenities_name}}" autocomplete="off" placeholder="Property Amenities Name">
                    @error('amenities_name')
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