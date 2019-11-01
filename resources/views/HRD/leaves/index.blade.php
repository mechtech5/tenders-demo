@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Leaves Request
					{{-- <span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							<span class="fa fa-upload"> </span>
							<form action="{{route('employees.import')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="file" onchange="this.form.submit()" name="import" class="hidden">
							</form>
						</button>
					</span>
					<span class="ml-2">
						<a href="{{route('employees.export')}}" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span> 
				</h1>
				<hr>--}}
			</div>
		</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Employee</th>
									<th>Leave</th>
									<th>Details</th>
									<th>Leave starts</th>
									<th>Leave ends</th>
									<th>Duration</th>
									<th>Status</th>
									@if(!empty($appr_sys))
										<th style="text-align: center;">Actions</th>
									@endif
								</tr>
							</thead>
							<tbody>
							@foreach($leave_request as $request) 
								<tr>
									<td>{{$request->id}}</td>
									<td>{{$request->emp_name}}</td>
									<td>{{$request->name}}</td>
									<td>
									<button class="btn btn-sm btn-info modalReq" data-id="{{$request->id}}"><i class="fa fa-eye" style="font-size: 12px;"></i>
																	</button></td>

									<div class="modal fade" id="reqModal" role="dialog">
									     <div class="modal-dialog modal-lg" >
									    	<div class="modal-content" style="width:1250px;margin: auto;right: 27%;">
									        	<div class="modal-header">
									        		<h4 class="modal-title">Request Detail</h4>
									        	</div>
									        	<div class="modal-body table-responsive" id="detailTable">
									        	</div>
									        	 <div class="modal-footer">
									          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
									        </div>
									        </div>
									    </div>
									</div>
									<td>{{$request->from}}</td>
									<td>{{$request->to}}</td>
									<td>{{$request->count}}</td>
									@if($request->status == 1)
									<td>Approved</td>
									@elseif($request->status == 2)
									<td>Declined</td>
									@elseif($request->status == 3)
									<td>Hold</td>
									@else
									<td>Pending</td>
									@endif
									@if(!($request->status == 1 || $request->status == 2 || $request->status == 3 ))
										@if(!empty($appr_sys))
											<td class='d-flex' style="border-bottom:none">
											@foreach($appr_action as $actions)
												@if(in_array($actions->id, json_decode($appr_sys->actions)))
													<span class="ml-2">
													<a href="{{route('leave.details', ['leave_id' => $request->id, 'approver_id' => Auth::id(), 'action' => $actions->id])}}" class="btn btn-sm btn-success">{{$actions->name}}</a>
													</span>
												@endif
											@endforeach
											</td>
										@endif
									@endif
								</tr>
							 @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>

<script >
	
	$(document).ready(function(){

		$('.modalReq').on('click', function(e){
			e.preventDefault();
			var leave_id = $(this).data('id');
			$.ajax({
				type: 'GET',
				url: "{{route('request.detail')}}?leave_id="+leave_id,
				success:function(res){
					$('#detailTable').empty().html(res);
					$('#reqModal').modal('show');
				}
			})


		})

	});
</script>

@endsection