@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">Show Payment Details</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h5>Company Name: {{$payment->company->comp_name}}</h5>
								<h5>Account Name: @if($payment->account != null)
									{{$payment->account->name}}
										@endif
								</h5>

								<h5>Amount: {{$payment->amount}}</h5>

								<h5>Vendor Name: 
									@if($payment->vendor != null)
									{{$payment->vendor->name}}
										@endif
									</h5>

								<h5>Payment Status: @if($payment->status == 'A')
												{{'Approved'}}
											@elseif ($payment->status =='H') 
												{{'Hold'}}
											@elseif($payment->status == 'P')
												{{'Pending'}}
											@elseif($payment->status == 'D')
												{{'Declined'}}
											@else
												{{'-'}}
											@endif</h5>
								<h5>Narration: {{$payment->narration}}</h5>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection