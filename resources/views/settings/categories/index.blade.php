@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Categories
					<span class="ml-2">
						<a href="{{route('categories.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New</a>
					</span>
					
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
					
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{$category->name}}</td>
									<td>
										@if($category->enabled == '1')
												<span class="btn btn-success btn-sm" >Enabled</span>	
											@else
												<span class="btn btn-danger btn-sm" >Disabled</span>
											@endif
									</td>
									<td class="d-flex">
										<span>
												<a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
											</span>
											<span class="ml-2">
												<form action="{{route('categories.destroy',$category->id)}}" method="POST" id="delform_{{ $category->id}}">
														@csrf
													@method('DELETE')
													<a href="javascript:$('#delform_{{ $category->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
											
												</form>
											</span>
										
									</td>		
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</main>
@endsection