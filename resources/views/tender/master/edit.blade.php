@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Edit Tender Master</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('tender_master.update', ['id'=>$tender->id])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2 ">
									<label for="name"><b>Acount Code <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="account_code" class="form-control" value="{{old('account_code',$tender->account_code)}}" readonly>
									</div>
									@error('account_code')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2">
									<label for="name"><b>Title <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<input type="text" name="title" class="form-control" value="{{old('title',$tender->title)}}">
									</div>
									@error('title')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2 ">
									<label for="name"><b>Status ID <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="status_id" id="" class="form-control">
											<option value="">Select status</option>
											@foreach($tender_statuses as $tender_status)
											<option value="{{$tender_status->id}}" {{old('status_id',$tender->status_id) == $tender_status->id ? 'selected' : ''}}>{{$tender_status->status_name}}</option>
											@endforeach
										</select>
									</div>
									@error('status_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2 ">
									<label for="name"><b>Type ID <span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="type_id" id="" class="form-control">
											<option value="">Select Type</option>
											@foreach($tender_types as $tender_type)
											<option value="{{$tender_type->id}}" {{old('type_id',$tender->type_id) == $tender_type->id ? 'selected' : ''}}>{{$tender_type->type_name}}</option>
											@endforeach
										</select>
									</div>
									@error('type_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-2 ">
									<label for="name"><b>Priority<span class="text-danger">*</span></b> </label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fa fa-id-card-o"></i>	
											</span>
										</div>
										<select name="priority" id="" class='form-control'>
											<option value="1" {{old('priority',$tender->priority) == 1 ? 'selected' : ''}}>very Low</option>
											<option value="2" {{old('priority',$tender->priority) == 2 ? 'selected' : ''}}>Low</option>
											<option value="3" {{old('priority',$tender->priority) == 3 ? 'selected' : ''}}>Medium</option>
											<option value="4" {{old('priority',$tender->priority) == 4 ? 'selected' : ''}}>High</option>
											<option value="5" {{old('priority',$tender->priority) == 5 ? 'selected' : ''}}>Very High</option>
										</select>
									</div>
									@error('prority')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                	@enderror
								</div>
									<div class="col-md-6 col-lg-6 col-xl-6 mt-2 ">
										<label for="name"><b>Is eligible <span class="text-danger">*</span></b> </label>
											<div class="toggle-flip">
			                  <label>
			                    <input type="checkbox" name="is_eligible" value="1" {{old('is_eligible',$tender->is_eligible) == '1' ? 'checked' : ''}}>
			                    <span class="flip-indecator" data-toggle-on="YES" data-toggle-off="NO"></span>
			                  </label>
			                </div>
										@error('description')
	                    <span class="text-danger" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                	@enderror
								</div>
							<div class="col-md-12 mt-3 ">
								<input type="hidden" name="grp_code" value="1">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('tender_master.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
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