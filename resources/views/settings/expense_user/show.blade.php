@extends('layouts.master')
@section('content')
	<main class="app-content">
			<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Expense User
					<span class="ml-2">
						<a href="{{route('expense_user.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New User</a>
					</span>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
					</div>
				</div>
			</div>
		</div>
	</main>
<script type="text/javascript">
    $(document).ready(function() {
		$(function() {
			$( "#parts-selector-1" ).partsSelector();
		});
    });
</script>
@endsection