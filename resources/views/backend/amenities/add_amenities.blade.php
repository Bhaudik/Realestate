@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>




	<div class="page-content">

       
        <div class="row profile-body">
 
<div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="card">
              <div class="card-body">

								<h6 class="card-title">Add amenities Type</h6>

								<form class="forms-sample" method="POST" action="{{route('store.amenities')}}" enctype="multipart/form-data" id="myform">
									@csrf

                                      <div class="form-group mb-3">
										<label for="amenities_name" class="form-label">Amenities name</label>
										<input type="text" class="form-control " id="amenities_name" name="amenities_name" autocomplete="off" placeholder="Property Amenities Name">
                                        {{-- @error('amenities_name')
                                            <span class="text-danger">{{ $message }}</span> 
                                            
                                            @error('amenities_name') is-invalid @enderror
                                        @enderror --}}
									</div>

                                   

                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
								</form>

              </div>
            </div>
            </div>
          </div>

        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function (){
        $('#myform').validate({
            rules: {
                amenities_name: {
                    required : true,
                }, 
                
            },
            messages :{
                amenities_name: {
                    required : 'Please Enter amenities name',
                }, 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection