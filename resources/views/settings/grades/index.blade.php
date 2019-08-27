@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Grades
					<span class="ml-2">
						<a href="{{route('grades.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
									<th>Grade Code</th>
									<th>Entitled Amount</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($grades as $grade)
								<tr>
									<td>{{$grade->grade_code}}</td>
									<td>{{$grade->entitled_amt}}</td>
									<td>{{$grade->description}}</td>
									<td class="d-flex">
										<span>
												<a href="{{route('grades.edit',$grade->grade_code)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form  action="{{route('grades.destroy',$grade->grade_code)}}" method="POST" id="delform_{{ $grade->grade_code}}">
													@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_{{ $grade->grade_code}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										
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