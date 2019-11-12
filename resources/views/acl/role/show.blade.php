@extends('layouts.master')
@section('title','Welcom: To Admin Panel')
@section('meta')
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@endsection
@section('content')

  <main class="app-content">
	  <div class="app-title">
	    <div>
	      <h1><i class="fa fa-dashboard"></i>ACL</h1>
	    </div>
	    <ul class="app-breadcrumb breadcrumb">
	      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
	      <li class="breadcrumb-item"><a href="#">ACL</a></li>
	    </ul>
	  </div>
	  <div class="row">
		<div class="col-md-12 m-auto">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<label>Name</label><br>
							<span>{{$role->name}}</span>
							<input id="id" type="hidden" name="id" value="{{$role->id}}">
						</div>
						<div class="col-sm-9 col-md-9">
							<label>Permissions</label>
							<form>
								@foreach($permissions as $permission)
							    <label class="checkbox-inline">
							      <input class="taskchecker" <?php if(in_array($permission->id,$permission_ids)){echo 'checked'; }?>
							    	type="checkbox" value="{{$permission->id}}">{{$permission->name}}
							   	</label>
							   	@endforeach
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>			
<script>
	$(document).ready(function(){
	
		$(".taskchecker").on("change", function() {
   			var id  = $('#id').val();
   			var val = [];
        	$(':checkbox:checked').each(function(i){
        		  val[i] = $(this).val();
       		 });
   			 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
         	 });
  			$.post("/saveChanges", {'roleId':id, 'permissionId':val}, function() {

  			});
		})
	})
</script>

@endsection
