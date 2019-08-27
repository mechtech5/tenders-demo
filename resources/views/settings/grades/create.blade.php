@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Grade</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('grades.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="code"><b>Code <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="grade_code" class="form-control" value="{{old('grade_code')}}">
									</div>
									@error('grade_code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>

								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="amount"><b>Amount <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="amount" class="amount form-control" value="{{old('amount')}}">
									</div>
									@error('amount')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>

							<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="description"><b>Description <span class="text-danger">*</span></b> </label>
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
								<span class="ml-2" ><a href="{{route('grades.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
						</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
<script>
$(".amount").keypress(function (e) {
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