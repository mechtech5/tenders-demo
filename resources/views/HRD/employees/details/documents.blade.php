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
	<form action="{{route('employees.documents', ['id'=>$employee->id])}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
		    <div class="col-4 form-group">
		    	<label for="">Document Title</label>
		    	<select name="doc_title" id="doc_title" class="form-control select2">
		    		<option value="">--- Please Select ---</option>
		    		@foreach($meta['doc_types'] as $doc_type)
		    			<option value="{{ $doc_type->id }}">{{ $doc_type->name }}</option>
					@endforeach
		    	</select>
		    </div>
	    <div class="col-4 form-group">
	    	<label for="">Attachment</label>
	    	<input type="file" name="file_path" id="file_path">
	    </div>
	    <div class="col-4 form-group">
		    	<label for="">Document Status</label>
		    	<select name="doc_status" id="doc_status" class="form-control select2">
		    		<option value="">--- Please Select ---</option>
		    		<option value="s">Submitted</option>
		    		<option value="p">Provided</option>
		    	</select>
		    	@error('doc_status')
					<span class="text-danger" role="alert">
						<strong>* {{ $message }}</strong>
					</span>
				@enderror
		    </div>
	    <div class="col-12 form-group ">
	    	<label for="">Remark</label>
	    	<textarea name="remark" id="remark" class="form-control" cols="10" rows="10"></textarea>
	    </div>

	    <div class="col-12 form-group text-center">
			<button class="btn btn-info btn-sm">Save</button>
			<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
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
	      <th>Status</th>
	      <th>Remark</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="docsTbody">
	  	<?php  ?>
	  	@foreach($employee->documents as $emp_documents)
	  	<tr>
	  		<td>{{ $emp_documents->id }}</td>
	  		<td>{{ $emp_documents->name }}</td>
<td> <img src="{{ asset('storage/app/public/hrm/employees/ysir_1/'.$emp_documents->file_path) }}" > </td>
	  		<td>{{ $emp_documents->doc_status }}</td>
	  		<td>{{ $emp_documents->remark }}</td>
	  		<td><span class="ml-2">
							<form action="" method="POST" id="delform_">
								@csrf
								@method('DELETE')
								<a href="javascript:$('#delform_').submit();" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
							</form>
						</span></td>
</tr>
	  		@endforeach
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
