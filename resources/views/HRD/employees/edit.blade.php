@extends('layouts.master')
@push('styles')
    <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Edit Employee Details</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('employees.update', ['id'=>$employee->id])}}" method="POST">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Name <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="name" class="form-control" value="{{old('name',$employee->emp_name)}}">
									</div>
									@error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Employee Code <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="emp_code" class="form-control" value="{{old('emp_code',$employee->emp_code)}}">
									</div>
									@error('emp_code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
				{{-- 				<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Company Code <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="comp_id" class="form-control" id="comp_id" onchange="fetchDesignation();">
											<option value="">Select Company</option>	
											@foreach($companies as $company)
											<option value="{{$company->id}}" {{old('comp_id',$employee->comp_id) == $company->id ? 'selected' : ''}}>{{$company->comp_name}}</option>
											@endforeach
										</select>
									</div>
									@error('comp_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div> --}}
								{{-- Fetch all Employee of the same company--}}
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Works Under<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="parent_id" class="form-control" id="">
											<option value="">Select Employee</option>	
											@foreach($parent_ids as $parent)
											<option value="{{$parent->id}}" {{old('parent_id',$employee->parent_id) == $parent->id ? 'selected' : ''}}>{{$parent->emp_name}}</option>
											@endforeach
										</select>
									</div>
									@error('parent_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								{{-- fetch all grades of company1  --}}
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Grade<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="grade_id" class="form-control" id="">
											<option value="">Select Grade</option>	
											@foreach($grades as $grade)
											<option value="{{$grade->id}}" {{old('grade_id',$employee->grade_id) == $grade->id ? 'selected' : ''}}>{{$grade->name}}</option>
											@endforeach
										</select>
									</div>
									@error('grade_code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Gender<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend mt-1">
											<input type="radio" 
															value="M" 
															name="emp_gender" 
															class="mt-1 mr-1" 
															{{old('emp_gender',$employee->emp_gender) == 'M' ? 'checked' : ''}}
														>Male
											<input type="radio" 
														value="F" 
														name="emp_gender" 
														class="mt-1 mr-1 ml-3"
														{{old('emp_gender',$employee->emp_gender) == 'F' ? 'checked' : ''}}
														>Female
											<input type="radio" 
														value="O" 
														name="emp_gender" 
														class="mt-1 mr-1 ml-3"
														{{old('emp_gender',$employee->emp_gender) == 'O' ? 'checked' : ''}}
														>Other
										</div>
									</div>
									@error('emp_gender')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Date Of Birth <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="emp_dob" class="datepicker form-control" value="{{old('emp_dob',$employee->emp_dob)}}">
									</div>
									@error('emp_dob')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Date Of Joining <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="join_dt" value="{{old('join_dt',$employee->join_dt)}}" class="datepicker form-control" >
									</div>
									@error('join_dt')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Designation<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<div class="designation_div">
											<select name="emp_desg" class="form-control" id="">
												<option value="">Select designation</option>	
												@foreach($designations as $designation)
												<option value="{{$designation->id}}" {{old('emp_desg',$employee->desg_id) == $designation->id ? 'selected' : ''}}>{{$designation->desg_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									@error('emp_desg')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
							{{-- 	<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Status<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<input type="radio" 
															value="1" 
															name="active" 
															class="mt-1 mr-2" 
															{{old('active',$employee->active) == 1 ? 'checked' : ''}}
														>Active
												<input type="radio" 
													value="0" 
													name="active" 
													class="mt-1 mr-2 ml-3" 
													{{old('active',$employee->active) == 0 ? 'checked' : ''}}
												>Inactive
										</div>
									</div>
									@error('active')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div> --}}
								<div class="col-md-12 mt-3">
								<input type="hidden" name="grp_code" value="1">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('employees.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>


<script type="text/javascript">

		$(document).ready(function(){
			$('.datepicker').datepicker({
				orientation: "bottom",
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
			});
		});
		function fetchDesignation(){
			var comp_id  = $('#comp_id').val();
			console.log('comp_id',comp_id);
			 $.ajax({
			 	type:'POST',
    		url:"{{route('employees.fetch_designation')}}",
    		data: {
    			 "_token": "{{ csrf_token() }}",
    			 "comp_id":comp_id
    		},
    		success:function(data){
    			console.log(data);
    			var designations = (data);
    			var html='<select name="emp_desg" class="form-control" id=""><option value="">Select designation</option>';
    			$.each(designations ,function(k,v){
    				console.log(k,v);
    				html = html + '<option value="'+v.id+'">'+v.title+'</option>';  
    			})
    			html = html + '</select>';
    			$('.designation_div').html(html);
    			console.log(html);
    		}
			 });
		}
	</script>
@endsection