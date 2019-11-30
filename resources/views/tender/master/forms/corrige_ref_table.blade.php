<table class="table table-striped table-hover table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Date Time</th>
      <th>Changes in Terms</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody id="meetingTbody">
  	<?php $count = 0; ?>
  	@foreach($corrigendum as $corrigend)
  		<tr>
  			<td>{{ ++$count }}</td>
  			<td>{{ $corrigend->date }}</td>
  			<td>{{ $corrigend->changes }}</td>
  			<td class="text-center">
          <a style="color: #fff" href="{{Storage::url('public/'.$tender->tender_no.'/Corrigendum/'.$corrigend->file)}}" runat="server" class="fa fa-download btn btn-primary" rel="tooltip" title="" data-original-title="Edit"></a>
  				<a style="color: #fff" data-id="{{$corrigend->id}}" runat="server" class="fa fa-edit btn btn-success edit_corrige" rel="tooltip" title="" data-original-title="Edit"></a>
	        <a style="color: #fff" data-id="{{$corrigend->id}}" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger corrige_delete" rel="tooltip" title="" data-original-title="Delete"></a>
  			</td>
  		</tr>
  		@endforeach
  </tbody>
</table>