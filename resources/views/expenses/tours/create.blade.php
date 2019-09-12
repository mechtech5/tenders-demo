@extends('layouts.master')
@section('content')
	<main class="app-content">	
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Tour	
				</h1>
				<hr>
			</div>
		</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('tours.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Employee name <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-user"></i>	
											</span>
										</div>
										<input type="text" name="name" class="form-control" value="{{$logged_emp->name}}" readonly>
										<input type="hidden" name="emp_id" class="form-control" value="{{$logged_emp->id}}" readonly>
									</div>
									@error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Purpose <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="purpose" class="form-control" value="{{old('purpose')}}">
									</div>
									@error('purpose')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="start_loc"><b>Start Location<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-location-arrow"></i>	
											</span>
										</div>
										<input type="text" name="start_loc" class="form-control" value="{{old('start_loc')}}">
									</div>
									@error('start_loc')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="start_loc"><b>End Location<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-map-signs"></i>	
											</span>
										</div>
										<input type="text" name="end_loc" class="form-control" value="{{old('end_loc')}}">
									</div>
									@error('end_loc')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="start_loc"><b>Advance Amount<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-inr"></i>	
											</span>
										</div>
										<input type="text" name="advance_amount" class="form-control advance_amount"  value="{{old('advance_amount')}}">
									</div>
									@error('advance_amount')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Note <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-asterisk"></i>	
											</span>
										</div>
										<textarea class="form-control" name="note" id="" cols="30" rows="5">{{old('note')}}</textarea>
									</div>
									@error('note')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-12 mt-3">
									<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
									<span class="ml-2" ><a href="{{route('tours.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</main>
	<script>
		$(".advance_amount").keypress(function (e) {
    if(e.which == 46){
        if($(this).val().indexOf('.') != -1) {
            return false;
        }
    }

    if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
	</script>
@endsection