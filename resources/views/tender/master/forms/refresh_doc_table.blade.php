<table class="table table-striped table-hover table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Document Title</th>
      <th>Note</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody id="docsTbody">
  	<?php $count = 0; ?> 
  	@foreach($data as $Data)
  	<?php $tender = App\Models\Tenders\Tender::find($Data->tender_id);	?>
  		<tr>
  			<td>{{ ++$count }}</td>  			
  			<td>{{ $Data->doc_title }}</td>
  			<td>{{ $Data->note }}</td>
  			<td class="text-center">
  				<a style="color: #fff" href="{{asset("storage/$tender->tender_no/$Data->file")}}" runat="server" class="fa fa-download btn btn-primary" rel="tooltip" title="" data-original-title="Edit"></a>
  				<a style="color: #fff" data-id="{{$Data->id}}" runat="server" class="fa fa-edit btn btn-success edit_meeting" rel="tooltip" title="" data-original-title="Edit"></a>
	       <a style="color: #fff" data-id="{{$Data->id}}" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger doc_delete" rel="tooltip" title="" data-original-title="Delete"></a>
  			</td>
  		</tr>
  	@endforeach	  	
  </tbody>
</table>