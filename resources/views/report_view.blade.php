@extends('layouts.master')
 @section('content')

<div class='page-wrapper'>
	<!-- <div id="editor"></div> -->
<!-- <button id="cmd">generate PDF</button> -->
	<div class='row' id="content">
		@foreach($data as $key=>$value)

		<div class='col-lg-12'> 
			<div class='col-md-2 user-info'>
				<h3>Name: {{$key}}</h3>
			</div> 
			@if(isset($monthly_average) && $monthly_average!='')
			<div class='col-md-2 user-info'>
				<h3>Average Hours Monthly: {{$monthly_average}}</h3>
			</div>
			@endif
			@if(isset($yearly_average) && $yearly_average!='')
			<div class='col-md-2 user-info'>
				<h3>Average Hours Yearly: {{$yearly_average}}</h3>
			</div>
			@endif
		</div>
		<div class='col-lg-12'>
			<div class='table-responsive'>
				<table class='table table-striped custom-table m-b-0'>
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
						
						</tbody>
					</table>
				</div>
				<div class='table-responsive' style='height: 800px;'>
					<table class='table table-striped custom-table m-b-0'>
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
//  	var doc = new jsPDF();
// var specialElementHandlers = {
//     '#editor': function (element, renderer) {
//         return true;
//     }
// };


// $('#cmd').click(function () {
//     doc.fromHTML($('#content').html(), 15, 15, {
//         'width': 170,
//             'elementHandlers': specialElementHandlers
//     });
//     doc.save('sample-file.pdf');
// });
 </script>
 @endsection