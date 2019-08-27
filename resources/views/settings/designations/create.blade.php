@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Designation</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('designations.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Title <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="title" class="form-control" value="{{old('title')}}">
									</div>
									@error('title')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Company<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-building-o"></i>	
											</span>
										</div>
										<select name="company" id="" class="form-control">
											<option value="">Select Company</option>
											@foreach($companies as $company)
											<option value="{{$company->comp_code}}" {{old('company') == $company->comp_code ? 'selected' : ''}}>{{$company->comp_name}}</option>
											@endforeach
										</select>
									</div>
									@error('company')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
							<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Description <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-asterisk"></i>	
											</span>
										</div>
										<textarea class="form-control" name="description" id="" cols="30" rows="5">{{old('description')}}</textarea>
									</div>
									@error('description')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
							<div class="col-md-12 mt-3">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('designations.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
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