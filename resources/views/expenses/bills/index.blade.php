@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Bills
					<span class="ml-2">
						<a href="{{route('bills.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
			</div>
		</div>
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-header bg-white">
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
						</div>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Vendor</th>
									<th>Amount</th>
									<th>Bill Date</th>
									<th>Due Date</th>
									<th>Status</th>
									<th>Actions</th>
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