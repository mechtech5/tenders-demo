@extends('layouts.master')
@push('styles')
	<script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
@php
	$emp_titles = array('Mr.', 'Mrs.', 'Ms.');
	$blood_groups = array('O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-');
	$castes = array('General', 'OBC', 'SC', 'ST');
	$religions = array('Hindu', 'Muslim', 'Christian', 'Sikh', 'Jain');
	$nationalities = array('Indian', 'Other');
@endphp
<main class="app-content">
	@include ('HRD/employees/tabs')
	<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
		@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
		@endif 
		<div id="form-area">
				<form action="{{route('employees.personal', ['id'=>$employee->id])}}" method="POST">
					@csrf
				<div class="container-fluid">
					<div class="row">
						<div class="col-2 form-group">
							<label for="">Title</label>
							<select name="emp_title" class="form-control">
									@foreach($emp_titles as $row)
										<option value="{{$row}}" {{old('emp_title',(explode(' ', $employee->emp_name, 2))[0]) == $row ? 'selected' : ''}} >
											{{ $row }}
										</option>
									@endforeach
							</select>
							@error('emp_title')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            	@enderror
						</div>
						<div class="col-5 form-group">

							<label for="">Full Name</label>
							<input type="text" class="form-control" name="full_name" value="{{old('full_name',(explode(' ', $employee->emp_name, 2))[1])}}" />
							@error('full_name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            	@enderror
						</div>
						<div class="col-4 form-group">
							<label for="">Gender</label>
							<br>
							<div class="row">
									<input type="radio" 
									class="mr-2 mt-1"
									name="emp_gender" 
									value="M" 
									autocomplete="off"
									{{old('emp_gender',$employee->emp_gender) == 'M' ? 'checked' : ''}}
									> Male
									<input type="radio" 
									class="mr-2 mt-1 ml-3"
									name="emp_gender" 
									value="F" 
									autocomplete="off"
									{{old('emp_gender',$employee->emp_gender) == 'F' ? 'checked' : ''}}
									> Female
									<input type="radio" 
									class="mr-2 mt-1 ml-3"
									name="emp_gender" 
									value="O" 
									autocomplete="off"
									{{old('emp_gender',$employee->emp_gender) == 'O' ? 'checked' : ''}}
									> Other
							</div>
							@error('emp_gender')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            	@enderror
						</div>
						<div class="w-100"></div>
						
						<div class="col-3 form-group">
							<label for="">Date of Birth</label>
							<input type="text" name="emp_dob" class="form-control datepicker" value="{{old('emp_dob',$employee->emp_dob)}}">
							@error('emp_dob')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              	@enderror
						</div>
						<div class="col-2 form-group">
							<label for="">Blood Group</label>
							<select name="blood_group" class="form-control">
									@foreach($blood_groups as $row)
										<option value="{{$row}}" {{old('blood_group',$employee->blood_grp) == $row ? 'selected' : ''}} >
											{{ $row }}
										</option>
									@endforeach
							</select>
							@error('blood_group')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col">
							<span><p class="text-center">Current Residence</p></span>
							<div class="form-group col-md-8 offset-md-2">
								<textarea onkeydown="match_addr('curr')" name="curr_addr" id="curr_addr" class="form-control" cols="30" rows="10">{{$employee->curr_addr}}</textarea>
								@error('curr_addr')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              	@enderror
							</div>
						</div>

						<div class="col">
							<span><p class="text-center">Permanent Residence</p></span>
							<div class="form-group col-md-8 offset-md-2">
								<textarea onkeydown="match_addr('perm')" name="perm_addr" class="form-control" id="perm_addr" cols="30" rows="10">{{$employee->perm_addr}}</textarea>
									@error('perm_addr')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
							</div>
						</div>
					</div>
					<div class="custom-control custom-checkbox bg-dark text-white" style="background-color: #fff;">
						<input type="checkbox" class="custom-control-input" id="check-address"
						@if($employee->curr_addr==$employee->perm_addr)
						checked
						@endif
						>
						<label class="custom-control-label" for="check-address">Permanent Residence same as current</label>
					</div>
					<hr/>
					<div class="row">
						<div class="col form-group">
							<label for="">Contact Number</label>
							<input type="text" name="Contact_number" class="form-control" value="{{old('Contact_number',$employee->contact)}}">
								@error('Contact_number')
	                  <span class="text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                  </span>
	              @enderror
						</div>
						<div class="col form-group">
							<label for="">Alternate Contact Number</label>
							<input type="text" name="alternate_contact_number" class="form-control" value="{{old('alternate_contact_number',$employee->alt_contact)}}">
							@error('alternate_contact_number')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
						</div>
						<div class="col form-group">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control" value="{{old('email',$employee->email)}}">
							@error('email')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
						</div>
						<div class="col form-group">
							<label for="">Alternate Email</label>
							<input type="email" name="alternate_email" class="form-control" value="{{old('alternate_email',$employee->alt_email)}}">
							@error('alternate_email')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
						</div>
							<div class="col-12 form-group text-center">
								<button class="btn btn-info btn-sm">Update</button>
								<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
							</div>
					</div>
					<input type="hidden" name="form_type" id="form_type" value="basic">
				</div>
			</form>
		</div>
	</div>
	<div class="img_parent d-none">
		<img src="{{asset('images/loading1.gif')}}" alt="">
	</div>
</main>
<script type="text/javascript">
	$(document).ready(function(){
		$('.personal').addClass('active');
		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
		});

		  $('#check-address').click(function(){
		    if($('#check-address').is(':checked')){
		    	var curr_addr = $('#curr_addr').val();
		    	$('#perm_addr').val(curr_addr);
		    } else {
		      $('#perm_addr').val('');
		    };
		  });
	});
	function match_addr(type){
			var curr_addr = $('#curr_addr').val();
			var perm_addr = $('#perm_addr').val();
			if(curr_addr == perm_addr){
        $("#check-address").prop("checked", true);
			}else{
				 $("#check-address").prop("checked", false);
			}
	}

</script>
@endsection

