@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	@include ('HRD/employees/tabs')
	<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
		@if($message = Session::get('success'))
		<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
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

						<option value="{{ $doc_type->id }}" {{old('doc_title') == $doc_type->id ? 'selected' : ''}}
		    			>{{ $doc_type->name }}</option>
					@endforeach
		    	</select>
		    	@error('doc_title')
					<span class="text-danger" role="alert">
						<strong>* {{ $message }}</strong>
					</span>
				@enderror
		    </div>
	    <div class="col-4 form-group">
	    	<label for="">Upload Documents</label>
	    	<input type="file" name="file_path" id="file_path" value="{{ old('file_path') }}">
	    	@error('file_path')
				<span class="text-danger" role="alert">
					<strong> {{ $message }}</strong>
				</span>
			@enderror
	    </div>
	    <div class="col-4 form-group">
		    	<label for="">Document Status</label>
		    	<select name="doc_status" id="doc_status" class="form-control select2">
		    		<option value="">--- Please Select ---</option>
		    		<option value="s"  {{ old('doc_status') == 's' ? 'selected' : ''}} >Submitted</option>
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
	    	<textarea name="remarks" id="remark" class="form-control" cols="10" rows="10">{{old('remark')}}</textarea>
	    	@error('remarks')
					<span class="text-danger" role="alert">
						<strong>* {{ $message }}</strong>
					</span>
				@enderror
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
	  	
	  	@foreach($employee->documents as $emp_documents)
	  	<tr>
	  		<td>{{ $emp_documents->id }}</td>
			<td>{{$emp_documents['doctypemast']->name}}</td>
			<td><a href="{{ route('employees.download', ['db_table'=>'emp_docs', 'id'=>$emp_documents->id]) }}" ><i class="fa fa-arrow-down"></i> Download</a>
			</td>
		  		<td>{{ $emp_documents->doc_status }}</td>
		  		<td>{{ $emp_documents->remark }}</td>
		  		<td>
				<form action="{{route('employee.delete_row', ['db_table'=>'emp_docs', 'id'=>$emp_documents->id])}}" method="GET" id="delform_{{ $emp_documents->id}}">
				<a href="javascript:$('#delform_{{ $emp_documents->id }}').submit();" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
				</form>
				</td>
		</tr>
	  		@endforeach
	  </tbody>
	</table>
	@php
	@endphp
	</div>
</main>
<script>
$(document).ready(function(){
	$('.documents').addClass('active');
});
</script>
@endsection


