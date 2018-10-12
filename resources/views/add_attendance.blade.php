@extends('layouts.master')
 @section('content')

 <style>
td:hover {
    background-color: #e4e4e4;
}
</style>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="{{asset('css/timedropper.css')}}" rel="stylesheet" type="text/css">

            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Attendance Sheet</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<!-- <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Attendance</a> -->
						</div>
					</div>
					<div class="row filter-row">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Employee ID</label>
								<input type="text" class="form-control floating" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Select Month</label>
								<select class="select floating"> 
									<option>-</option>
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>Jul</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Select Year</label>
								<select class="select floating"> 
									<option>-</option>
									<option>2017</option>
									<option>2016</option>
									<option>2015</option>
									<option>2014</option>
									<option>2013</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<a href="#" class="btn btn-success btn-block"> Search </a>  
						</div>     
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0">
									<thead>
										<tr>
											<th>Employee</th>
											@for($i=1;$i<=$data['number_days'];$i++)
											<th>{{$i}}</th>
											@endfor
											
										</tr>
									</thead>
									<tbody>
										
										@foreach($data['value'] as $key=>$value)
										<tr>	
											<td><a href="#" onclick="open_attendance_modal(this.text,<?php echo $value['employee_id'];?>,<?php echo "'$key'"; ?>) "data-toggle="modal" data-target="#add_attendence">{{$value['first_name']}} {{''}} {{$value['last_name']}}</a></td>
											@for($j=0;$j<$data['number_days'];$j++)
												<td title="In Time: 09:20 AM -- Out Time: 05:30 PM" ><i class="fa fa-check text-success"></i> </td>
											@endfor
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
				
				<div id="add_attendence" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Attendance</h4>
						</div>
						<div class="modal-body">
							<form id="add_attendance" method="Post" action="{{route('saveAttendance')}}">
								@csrf
								<div class="form-group">
											<label>Select Staff</label>
											<input class="form-control" type="text" value="name" id="name" readonly="">
										</div>
								<div class="form-group">
									<label>Select Date <span class="text-danger">*</span></label>
									<div class="cal-icon"><input class="form-control datetimepicker" name="attendance_date" type="text"></div>
								</div>
								<div class="alert-danger date"></div>
								<div class="form-group">
									<label>In Time <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="in_time" id="in_time">
								</div>
								<div class="form-group" >
									<label>Out time <span class="text-danger">*</span></label>
									<input class="form-control" value="" type="text" name="out_time" id="out_time">
									
								</div>
								<div class="form-group">
									<label>Comments <span class="text-danger">*</span></label>
									<textarea rows="4" cols="5" name="comments" class="form-control"></textarea>
								</div>
								<input type="hidden" id="employee_id" name="employee_id">
								<input type="hidden" name="node" id="node">
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" id="submit">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
				
            </div>

         </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>	
@endsection
@section('local_script')
<script src="{{asset('js/timedropper.js')}}"></script>
		<script>$( "#in_time" ).timeDropper();</script>
		<script>$( "#out_time" ).timeDropper();</script>
		<script type="text/javascript">
			function open_attendance_modal(text,employee_id,node){
				// alert(text+" "+employee_id+" "+node);
				$("#name").val(text);
				$("#employee_id").val(employee_id);
				$("#node").val(node);
			}
	    $("#add_attendance").validate({
	    	rules:{
	    		// attendance_date:{
	    		// 	required:true,
	    		// 	date:true
	    		// },
	    		in_time:{
	    			required:true
	    		},
	    		out_time:{
	    			required:true
	    		}
	    		// comments:{
	    		// 	required:true
	    		// }
	    	}
	    });		
	    $("#submit").on('click',function(e){
	    	var valid = $("#add_attendance").valid();
	    	if(valid){
	    		$.ajax({
	    			headers: {
                      'X-CSRF-TOKEN': $('input[name="_token"]').val()
                  },
	    			url: '{{route("saveAttendance")}}',
	    			type: 'POST',
	    			data: {param1: $("#add_attendance").serialize()},
	    		})
	    		.done(function(data) {
	    			// console.log(data);
	    			console.log("success");
	    		})
	    		.fail(function(data) {
	    			var response = JSON.parse(data.responseText);
	    			$.each(response.errors, function(index, val) {
	    				 $("input[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
	    				 $("textarea[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
	    			});
	    			// console.log(response);
	    			// console.log("error");
	    		})
	    		.always(function() {
	    			console.log("complete");
	    		});
	    		
	    	}
	    	console.log(valid);
	    	e.preventDefault();
	    });
		</script>
@endsection