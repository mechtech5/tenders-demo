@extends('layouts.master')
@section('content')
	<main class="app-content">
		@include ('HRD/employees/tabs')
		<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
			@if($message = Session::get('success'))
				<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
					{{$message}}
				</div>
			@endif 
			<div id="form-area">
				<form action="{{route('employees.main', ['id'=>$employee->id])}}" method="POST">
					@csrf
					<div class="container-fluid">
						<div class="row">
							<div class="col-4 form-group">
								<label for="">Name</label>
								<input type="text" class="form-control" name="name" value="{{old('name',$employee->emp_name)}}" />
								@error('name')
				          <span class="text-danger" role="alert">
				            <strong>{{ $message }}</strong>
				          </span>
				      	@enderror
							</div>
							<div class="col-4 form-group">
								<label for="">Email</label>
								<input type="email" class="form-control" name="email" value="{{$employee->email}}" />
								@error('email')
				          <span class="text-danger" role="alert">
				            <strong>{{ $message }}</strong>
				          </span>
				      	@enderror
							</div>
							<div class="col-4 form-group">
								<label for="">Contact No. </label>
								<input type="text" class="form-control" name="contact" value="{{$employee->contact}}" />
								@error('contact')
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
					</div>
					<input type="hidden" name="form_type" id="form_type" value="main">
				</form>
			</div>
		</div>
		<div class="img_parent d-none">
			<img src="{{asset('images/loading1.gif')}}" alt="">
		</div>
		
	</main>
	<script>
	$(document).ready(function(){
		$('.main').addClass('active');
	});
	</script>
@endsection