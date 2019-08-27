@extends('layouts.master')
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
						<form action="{{route('employees.update', ['id'=>$employee->id])}}" method="post">
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
										<input type="text" name="name" class="form-control" required="" value="{{$employee->emp_name}}">
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
										<input type="text" name="code" class="form-control" required="" value="{{$employee->emp_code}}">
									</div>
									@error('code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Company Code <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="comp_code" id="">
											<option value="">Select Company</option>
											
										</select>
									</div>
									@error('comp_code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection