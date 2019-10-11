@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Leave</h1>
				<hr>
			</div>
		</div>
		@if(session('status'))
         	 <div class="alert alert-success alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Notification!</strong> Successfully Inserted.
			</div>
        @endif
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('emp_leave_store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6 col-lg- col-xl-6 mt-2">
									<label for="leave_type"><b>Leave Type <span class="text-danger">*</span></b> </label>
									<div class="input-group" >
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-list-alt"></i>	
											</span>
										</div>
										<select class="custom-select" name="leave_type">
											<option value="0">Select Option</option>
											@foreach($leave_type as $type)
											<option value="{{$type->id}}">{{$type->name}}</option>
											@endforeach
										</select>
									</div>
									@error('leave_type')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="count"><b>Count <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="count" class="form-control" value="{{old('count')}}">
									</div>
									@error('count')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="generates_in"><b>Generates In <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="generates_in" class="form-control" value="{{old('generates_in')}}">
									</div>
									@error('generates_in')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="max_apply_once"><b>Max Apply Once <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>	
											</span>
										</div>
										  <input type="text" name="max_apply_once" class="form-control" value="{{old('max_apply_once')}}">
									</div>
									@error('max_apply_once')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="min_apply_once"><b>Min Apply Once <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>	
											</span>
										</div>
										<input type="text" name="min_apply_once" class="form-control" value="{{old('min_apply_once')}}">
									</div>
									@error('min_apply_once')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="max_days_month"><b>Max Days Month <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>	
											</span>
										</div>
										<input type="text" name="max_days_month" class="form-control" value="{{old('max_days_month')}}">
									</div>
									@error('max_days_month')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="max_apply_month"><b>Max Apply Month <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>	
											</span>
										</div>
										<input type="text" name="max_apply_month" class="form-control" value="{{old('max_apply_month')}}">
									</div>
									@error('max_apply_month')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="max_apply_year"><b>Max Apply Year <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-calendar"></i>	
											</span>
										</div>
										<input type="text" name="max_apply_year" class="form-control" value="{{old('max_apply_year')}}">
									</div>
									@error('max_apply_year')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>	
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="carry_forward"><b>Carry Forward <span class="text-danger">*</span></b> </label>
										<div class="input-group">
											<div class="animated-checkbox">
										         <div class="radio">
												   <label><input type="radio" name="carry_forward" value="1" >Yes</label>
												   <label style="margin-left: 20px"><input type="radio" value="0" name="carry_forward">No</label>
												 </div>
											</div>
										</div>
									@error('carry_forward')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
                					@enderror
								</div>
							</div>
							<div class="col-md-12 mt-3">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('emp_leave')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
						</form>
					</div>
				</div>			
			</div>
		</div>
	</main>
@endsection