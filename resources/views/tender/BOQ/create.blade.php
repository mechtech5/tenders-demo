@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add BOQ Details</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('tender_boq.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Name <span class="text-danger">*</span></b> </label>
														
										<input type="text" name="name" class="form-control" value="{{old('name')}}">
										@error('name')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                	@enderror								
								</div>
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Mobile No. <span class="text-danger">*</span></b> </label>
									<input class="form-control" name="mobile_no" id="" cols="30" rows="5">
									@error('mobile_no')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                	@enderror
								</div>

								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Emergency Mobile No. <span class="text-danger">*</span></b> </label>
									<input class="form-control" name="emerg_mobile" id="" cols="30" rows="5">
									@error('emerg_mobile')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ 'The emergency mobile no field is required .' }}</strong>
				                    </span>
				                	@enderror
								</div>												
							</div>

							<div class="row form-group">
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Designation<span class="text-danger">*</span></b> </label>
														
										<input type="text" name="desig" class="form-control" value="{{old('name')}}">
										@error('desig')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ 'The designation field is required .' }}</strong>
					                    </span>
					                	@enderror
																	
								</div>
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Office Location<span class="text-danger">*</span></b> </label>
									<input class="form-control" name="office_loc" id="" cols="30" rows="5">
									@error('office_loc')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ 'The office location field is required .' }}</strong>
				                    </span>
				                	@enderror
								</div>	
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2">
									<label for="name"><b>Email ID<span class="text-danger">*</span></b> </label>
									<input class="form-control" name="email" id="" cols="30" rows="5">
									@error('email')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                	@enderror
								</div>										
							</div>
							<div class="col-md-12 mt-3 text-center">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('tender_responsible.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection