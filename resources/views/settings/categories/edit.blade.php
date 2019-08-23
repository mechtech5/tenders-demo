@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Edit Category</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('categories.update', ['id'=>$category->id])}}" method="post">
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
										<input type="text" name="name" class="form-control" required="" value="{{$category->name}}">
									</div>
									@error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                	@enderror
								</div>


								<div class="col-md-6 mt-2">
								<label for="enabled" ><b>Enabled <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="btn-group radio-inline">
										<label id="enabled_1" class="btn btn-default ">
											<input type="radio" name="enabled" value="1" id="enabled" {{$category->enabled=='1' ? 'checked' : ''}}>
											<span class="radiotext">Yes</span>
										</label>
										<label id="enabled_0" class="btn btn-default">
											<input type="radio" name="enabled" value="0" id="enabled"  {{$category->enabled=='0' ? 'checked' : ''}}>
											<span class="radiotext" >No</span>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-12 mt-3">
								<input type="hidden" name="grp_code" value="1">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('categories.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
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