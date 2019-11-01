@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	<div class="row">
		<div class="col-md-12 col-xl-12">
			<h1 style="font-size: 24px">Set Permission</h1>
		</div>
	</div>
			<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
				@if($message = Session::get('success'))
				<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
					{{$message}}
				</div>
				@endif 
					<form action="{{route('permissions.store')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<table class="table table-striped table-hover table-bordered">
				  <thead class="thead-dark">
				    <tr>
				      <th>#</th>
				      <th>Role Name</th>
				      <th>Approval</th>
				      <th>Decline</th>
				      {{-- <th>Hold</th> --}}
				      <th>Order</th>
				    </tr>
				  </thead>
				  <tbody id="academicsTbody">
				  	@php $i = 1; @endphp
					@foreach($designations as $desig)
						<tr>
							<td>#</td>
							<td>{{$desig->name}}</td>
							<input type="hidden" name="desig[{{$i}}]" value="{{$desig->id}}">
							<td><center><input type="checkbox" class="form-check-input" style="text-align: center" name="approve[{{$i}}]"></center></td>
							<td><center><input type="checkbox" class="form-check-input" name="decline[{{$i}}]"></center></td>
							<td><center><input type="text" class="form-control-input col-xs-4" name="priority[{{$i}}]"></center></td>
						</tr>
						@php $i+=1 ;@endphp
					@endforeach
				  </tbody>
				</table>
				<div class="col-12 form-group text-center">
					<button class="btn btn-info btn-sm m-2">Save</button>
					<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
				</div>
			</div>
			</form>
	</main>
	<script>
		$(document).ready(function(){
			$('.experience').addClass('active');
			$('.datepicker').datepicker({
				orientation: "bottom",
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
			});
		});
	</script>
@endsection
