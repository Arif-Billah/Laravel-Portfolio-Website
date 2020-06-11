@extends('Layout.app')
@section('title','Visitors')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">NO</th>
	  <th class="th-sm">IP</th>
	  <th class="th-sm">Date & Time</th>
    </tr>
  </thead>
  <tbody><?php// print_r($visitData) ;?>
  
     @foreach($visitData as $visitData)
		<?php// print_r($visitData)?>
		<tr>
			<td>{{ $visitData->id }}</td>
			<td>{{ $visitData->ip_address }}</td>
			<td>{{ $visitData->visit_time }}</td>
		</tr>
		@endforeach
	
  </tbody>
</table>

</div>
</div>
</div>



@endsection
@section('script')
<script type='text/javaScript'>
//visitor page table
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

</script>
@endsection