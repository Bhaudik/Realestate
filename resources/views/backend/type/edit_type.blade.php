@extends('admin.admin_dashboard')
@section('admin')



	<div class="page-content">

       
        <div class="row profile-body">
 
<div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="card">
              <div class="card-body">

								<h6 class="card-title">Add Propperty Type</h6>

								<form class="forms-sample" method="POST" action="{{route('update.type')}}" enctype="multipart/form-data">
									@csrf
                                      <input type="hidden" name="id" value="{{ $type->id}}">
                                
                                    <div class="mb-3">
										<label for="type_name" class="form-label">Type name</label>
										<input type="text" class="form-control @error('type_name') is-invalid @enderror" id="type_name" name="type_name" value="{{$type->type_name}}" autocomplete="off" placeholder="Property Type Name">
                                        @error('type_name')
                                            <span class="text-danger">{{ $message }}</span>                                            
                                        @enderror
									</div>

                                    <div class="mb-3">
										<label for="type_icon" class="form-label">Type Icon</label>
										<input type="text" class="form-control @error('type_icon') is-invalid @enderror" id="type_icon" name="type_icon" value="{{$type->type_icon}}" autocomplete="off" placeholder="Property tpe Icon">
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