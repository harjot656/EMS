@extends('layouts.master')
 @section('content')

<div class='' style="margin-top: 20px;">
	<center><h2>Attandace Sheet</h2></center>
	
	<div class='row' id="content">
		@foreach($data as $key=>$value)

		<div class='col-lg-12'> 
	
		</div>
		<div class='col-lg-12'>
			<div class='table-responsive'>
				<table class='table table-striped custom-table m-b-0'>
					 <caption><h3>Name: {{$key}} &nbsp; &nbsp; &nbsp; &nbsp; @if(isset($monthly_average) && $monthly_average!='') Average Hours Monthly: {{$monthly_average}} @endif &nbsp; &nbsp; &nbsp; &nbsp; @if(isset($yearly_average) && $yearly_average!='') Average Hours Yearly: {{$yearly_average}} @endif</h3>  </caption>
					<thead>
						<tr>
							<th>Date</th>
							<th>Status</th>
							<th>In-Time</th>
							<th>Out-Time</th>
							<th>Shift Hours</th>
							<th>Comments</th>
						</tr>
					</thead>
					
						<tbody>
								@foreach($value['attendance'] as $keyy=>$valuee)
								<tr>
								<td>{{$valuee['date']}}</td>
								<td title="{{ucwords($valuee['status'])}}">{{ucwords($valuee['status'])}}</td>
								<td title="{{ucwords($valuee['in_time'])}}">{{ucwords($valuee['in_time'])}}</td>
								<td title="{{ucwords($valuee['out_time'])}}">{{ucwords($valuee['out_time'])}}</td>
								<td>{{$valuee['shift_hours']}}</td>
								<td>{{$valuee['comments']}}</td>
								</tr>
								@endforeach
						</tbody>
					</table>
				</div>			
		</div>
		@endforeach
	</div>
</div>		

 @endsection

 @section('local_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
 <script type="text/javascript">

 </script>
 @endsection