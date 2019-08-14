@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Vendors
					<span class="ml-2">
						<a href="{{route('vendors.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New</a>
					</span>
					<span class="ml-2">
						<a href="" class="btn btn-sm btn-info" style="font-size:13px">
							<span class="fa fa-upload"></span> Import
						</a>
					</span>
					<span class="ml-2">
						<a href="" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span>
				</h1>
				<hr>
				@if($message = Session::get('success'))
					<div class="alert alert-success">
						{{$message}}
					</div>
				@endif
			</div>
		</div>
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-header bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 >Search: 
									<span class="ml-2 ">
										<input type="text" name="search" placeholder="type to search..." class="p-1"/>
									</span> 
									<span class="ml-1">
										<a href="" class="btn btn-sm btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd; font-size: 13px;" ><i class="fa fa-filter"></i> Filter</a>
									</span>
								</h5>
							</div>
							
						</div>
					</div>
					<div class="card-body table-responsive">

						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Company Name</th>	
									<th>Phone</th>								
									<th>Tax Number</th>	
									<th>Address</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($vendors as $vendor)
								<tr>
									<td>{{$vendor->name}}</td>
									<td>{{$vendor->email}}</td>
									<td>
										@foreach($companies as $comp)
											@if($comp->comp_code == $vendor->comp_code)
												{{$comp->comp_name}}
											@endif
										@endforeach
									</td>
									<td>{{$vendor->phone != '' ? $vendor->phone : '-'}}</td>
									
									<td>{{$vendor->tax_number != '' ? $vendor->tax_number : '-'}}</td>	
									<td>{{$vendor->address != '' ? $vendor->address : '-'}}</td>
									<td>
										@if($vendor->enabled == '1')
											{{__('Enabled')}}
										@else
											{{__('Disabled')}}
										@endif

									</td>
									<td class="d-flex">
										
										<span>
											<a href="{{route('vendors.edit',$vendor->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-3">
											<form action="{{route('vendors.destroy',$vendor->id)}}" method="POST" id="delform_{{ $vendor->id}}">
													@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_{{ $vendor->id}}').submit();" class="btn btn-sm btn-danger"><i class="fa fa-trash text-white" onclick="return confirm('Are you sure?')" style="font-size: 12px;"></i></a>
										
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