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
	  @if(session('success'))
         <div class="alert alert-danger">
            {{session('success')}}
        </div>
      @endif
	   <div class="row">
		<div class="col-md-12 m-auto">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-12 col-xl-12 col-sm-12 d-inline-flex radio-group" style=" ">

							<a style="background: #5bc0de;margin-right: 20px;max-width: 325px;" data = 'role' class="col-md-4  text-center btn big active_class get_table"  id="roles_table">
							Roles</a>

							<a style="background: #5bc0de;margin-right: 20px;max-width: 325px;" data = 'permissions_table' class="col-md-4 text-center btn big get_table" id="permissions_table">
							Permissions</a>

							<a style="background: #5bc0de;max-width: 325px;" data="user" class="col-md-4 text-center btn big get_table" id="user_table">
							Users</a>
						</div>
			       	</div>				
				</div>
				<div class="card-body " >
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xl-12  table-responsive " id="mytable1">
							<a style="margin-bottom: 10px;" href="{{route('admin.create')}}" id="add" type="button" class="btn btn-info">Add</a>
							<table class="table table-stripped table-bordered" id="role_table" style="width: 100%">
								<thead>
									<tr>
										<th>SNo.</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php  $count =0;	@endphp 
									@foreach($show_role as $roles)
										<tr>
											<td  style="width: 16.66%">{{ ++$count}}</td>
											<td>{{$roles->name}}</td>
											<td  style="width: 16.66%;text-align: center;">
												<a href="{{route('admin.edit',[$roles->id])}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
												<a href="{{route('delete',$roles->id)}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
												<a href="{{route('admin.show',[$roles->id])}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				
					<div class="row">

					<div class="col-sm-12 col-md-12 col-xl-12  table-responsive " id="mytable2" style="display: none;">
						<a style="margin-bottom: 10px;" href="{{route('permissions.create')}}" id="add" type="button" class="btn btn-info">Add</a>
						<table class="table table-stripped table-bordered" id="role_table1" style="width: 100%">
							<thead>
								<tr>
									<th>SNo.</th>
									<th>Permissions</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php  $count =0;	@endphp 
								@foreach($permissions as $permissionss)
									<tr>
										<td  style="width: 16.66%">{{ ++$count}}</td>
										<td>{{$permissionss->name}}</td>
										<td  style="width: 16.66%; text-align: center;">
											<a href="{{route('permissions.edit',$permissionss->id)}}"><i class="fa fa-pencil-square-o  fa-lg" aria-hidden="true"></i></a>
											<a href="{{route('delete_permissions',$permissionss->id)}}"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			
					<div class="col-sm-12 col-md-12 col-xl-12  table-responsive " style="display: none;" id="mytable3">
						<a style="margin-bottom: 10px;" href="{{route('users.create')}}" id="add" type="button" class="btn btn-info">Add</a>
						<table class="table table-stripped table-bordered" id="role_table2" style="width: 100%">
							<thead>
								<tr>
									<th>SNo.</th>
									<th>User</th>
									<th>Email</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php  $count =0;	@endphp 
								@foreach($user as $users)
									<tr>
										<td style="width: 16.66%">{{ ++$count}}</td>
										<td>{{$users->name}}</td>
										<td>{{$users->email}}</td>
										<td style="width: 16.66%;text-align: center;">
											<a href="{{route('users.edit',$users->id)}}"><i class="fa-lg fa fa-pencil-square-o" aria-hidden="true"></i></a>
											<a href="{{route('destroy',$users->id)}}"><i class="fa-lg fa fa-trash" aria-hidden="true"></i></a>
											<a href="{{route('users.show',$users->id)}}"><i class="fa fa-eye   fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>			

<script>
	$(document).ready(function(){
		$('#role_table').DataTable();
		$('#role_table1').DataTable();
		$('#role_table2').DataTable();

		$('#roles_table,#permissions_table,#user_table').on('click',function(){
			var mylawyers = $(this).attr('data');
		
			if(mylawyers=='role'){
				$('#mytable1').show();
				$('#mytable2').hide();
				$('#mytable3').hide();
			}
			else if(mylawyers=='permissions_table'){
				$('#mytable1').hide();
				$('#mytable2').show();
				$('#mytable3').hide();
			}
			else{
				$('#mytable1').hide();
				$('#mytable2').hide();
				$('#mytable3').show();
			}
		});
	})	
</script>

@endsection