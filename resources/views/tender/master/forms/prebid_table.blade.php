<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Date Time</th>
	      <th>Location</th>
	      <th>Remark</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php $count=0; ?>
	  	@foreach($prebid as $prebids)
	  		<tr>
	  			<td>{{++$count}}</td>
	  			<td>{{$prebids->location}}</td>
	  			<td>{{$prebids->date}}</td>
	  			<td>{{$prebids->remarks}}</td>
	  			<td class="text-center">
		  			<a style="color: #fff" data-id="{{$prebids->id}}" runat="server" class="fa fa-edit btn btn-success edit_meeting" rel="tooltip" title="" data-original-title="Edit"></a>
	                 <a style="color: #fff" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger" rel="tooltip" title="" data-original-title="Delete"></a>
		  		</td>
	  		</tr>
	  	@endforeach		  	
	  </tbody>
</table>