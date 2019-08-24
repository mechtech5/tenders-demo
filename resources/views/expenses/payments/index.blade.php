@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Payments
					<span class="ml-2">
						<a href="{{route('payments.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New</a>
					</span>
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							<span class="fa fa-upload"></span> Import
						</button>
					</span>
					<span class="ml-2">
						<a href="{{route('payments.export')}}" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span>
				</h1>
				<hr>
			</div>
		</div>
		<div class="modal fade" id="import-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Import Payments Report</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body ">
						<form action="{{route('payments.imports')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row form-group">
								<div class="col-md-12 col-lg-12">
									<label>Import File</label>
									<input type="file" name="file" class="form-control">
								</div>
								<div class="col-md-12 col-lg-12 mt-2">
									<button type="submit" class="btn btn-primary">Submit</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</form> 
					</div>
				
				</div>
			</div>
		</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif
		@if(Session::get('error'))
			<div class="alert alert-danger">
				{{session('error')}}
			</div>
		@endif		
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-header bg-white">
						<div class="row">
							<div class="col-md-12">
								
							</div>
							
						</div>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Company Name</th>
									<th>Date</th>									
									<th>Amount</th>
									<th>Vendor</th>
									<th>Narration</th>
									<th>Category</th>
									<th>Account</th>
									<th>Payment Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments as $payment)
									<tr>
										<td>{{$payment->company->comp_name}}</td>
										<td>{{date('d-m-Y', strtotime($payment->paid_at))}}</td>
										<td><i class="fa fa-inr"> </i> {{$payment->amount}}</td>
										<td>{{$payment->vendor_id != null ? $payment->vendor->name : '-' }}</td>
										<td>{{$payment->narration}}</td>
										
										<td>{{$payment->catg_id !=null ? $payment->expense_category->name : ''}}</td>

										<td>{{$payment->account_id !=null ? $payment->account->name : ''}}</td>
										<td>
											@if($payment->status == 'A')
												{{'Approved'}}
											@elseif ($payment->status =='H') 
												{{'Hold'}}
											@elseif($payment->status == 'P')
												{{'Pending'}}
											@elseif($payment->status == 'D')
												{{'Declined'}}
											@else
												{{'-'}}
											@endif

										</td>
										<td class="d-flex">
										{{-- 
											<span>
												<a href="{{route('payments.edit',$payment->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
											</span>
											<span class="ml-2">
												<form action="{{route('payments.destroy',$payment->id)}}" method="POST" id="delform_{{ $payment->id}}">
														@csrf
													@method('DELETE')
													<a href="javascript:$('#delform_{{ $payment->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
											
												</form>
											</span>
 --}}											<span class="">
												<a href="{{route('payments.show',$payment->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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