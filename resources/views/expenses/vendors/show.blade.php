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
					<div class="card-body table-rsponsive">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Unpaid</th>									
									<th>Status </th>
									<th>Action </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>							
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection