@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	@include ('HRD/employees/tabs')
	<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
		@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
		@endif 
	<form action="{{route('employees.documents', ['id'=>$employee->id])}}" method="POST">
		@csrf
		<div class="row">
	    <div class="col form-group">
	    	<label for="">Document Title</label>
	    	<select name="docTitle" id="docTitle" class="form-control select2">
	    		<option value="">--- Please Select ---</option>
	    	</select>
	    </div>
	    <div class="col form-group">
	    	<label for="">Attachment</label>
	    	<input type="file" name="docFile" id="docFile">
	    </div>
	    <div class="col form-group">
	    	<label for="">Note</label>
	    	<textarea name="docSpecialNote" id="docSpecialNote" class="form-control" cols="30" rows="10"></textarea>
	    </div>
		</div>
		<input type="hidden" id="form_type" value="docs">
	</form>
	<hr>
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Document Title</th>
	      <th>File</th>
	      <th>Note</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="docsTbody">
	  	
	  </tbody>
	</table>
	</div>
</main>
<script>
$(document).ready(function(){
	$('.documents').addClass('active');
});
</script>
@endsection
