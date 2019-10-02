@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Leaves
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							<span class="fa fa-upload"></span> Import
						</button>
					</span>
					<span class="ml-2">
						<a href="#" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span>
					<span class="ml-2">
						<a href="{{route('employee.apply_leaves',['id'=>$employee->id])}}" class="btn btn-sm btn-success" style="font-size:13px">
							<span class="fa fa-arrows"></span> Apply
						</a>
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
		<div class="row">
			<div class="col-sm-3 text-center" >
				<div class="card" style="background-image: linear-gradient(to bottom,#efb1ab, #f77b7b);background-color: #f77b7b;min-height:40px;padding:10px 0">
					<h4>SL</h4>
					<h4 class="text-white"> 2 / 10</h4>
				</div>
      </div>
      <div class="col-sm-3 text-center" >
				<div class="card" style="background-image: linear-gradient(to bottom,#ccb3006e, #ffcc66);background-color: #f77b7b;min-height:40px;padding:10px 0">
					<h4>EL</h4>
					<h4 class="text-white"> 9 / 10</h4>
				</div>
      </div>
      <div class="col-sm-3 text-center" >
				<div class="card" style="background-image: linear-gradient(to bottom, #c7a9ef , #bf38d8); min-height:40px;padding:10px 0">
					<h4>PL</h4>
					<h4 class="text-white"> 0 / 7</h4>
				</div>
      </div>
      <div class="col-sm-3 text-center" >
				<div class="card" style="background-image: linear-gradient(to bottom,#efb1ab, #f77b7b);background-color: #f77b7b;min-height:40px;padding:10px 0">
					<h4>EL</h4>
					<h4 class="text-white"> 2 / 10</h4>
				</div>
      </div>
		</div>
		<div class="row mt-2">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Leave Type</th>
									<th>From</th>
									<th>To</th>									
									<th>Reason</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection