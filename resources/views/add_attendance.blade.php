@extends('layouts.master')
 @section('content')

 <style>
td:hover {
    background-color: #e4e4e4;
}
.days_list
{	
	display:flex;	
}

.days_list li
{
	list-style:none;
	font-weight:bold;
}

.status_nme h4
{
	padding-top:15px;
}

.time_select , .text_area , .time_select2
{
	border: 1px solid #ccc;
    height: 50px;
    border-radius: 0;
	width:100%;	
}
.mod
{
	width:100%;
}
.btn2
{
width: 100%;
padding: 12px;
border-radius: 0;
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
										<?php $arr= array(); ?>
										@foreach($data['value'] as $key=>$value)
										<tr>	
											<td><a href="#" onclick="open_attendance_modal(this.text,<?php echo $value['employee_id'];?>,<?php echo "'$key'"; ?>) "data-toggle="modal" data-target="#add_attendence">{{$value['first_name']}} {{''}} {{$value['last_name']}}</a></td>
											@if(isset($value['attendance']))
												


												@foreach($value['attendance'] as $keyy=>$valuee)
													<?php 
														
														$a = (int)date('d',strtotime($keyy)) - 1;
														$data['attendance'][$a]	= 1;

													 ?>

												@endforeach


												@for($j=0;$j<=(count($data['list_date']));$j++)
												
												 
													@if($data['attendance'][$j] == 1)	

														<td title="In Time: 09:20 AM -- Out Time: 05:30 PM" ><i class="fa fa-check text-success"></i> </td>
														<?php $data['attendance'][$j] = 0; ?>

												 	@else
												 
													<td title="Absent"><i class="fa fa-close text-danger"></i> </td> 
													@endif

												@endfor
											@else
												@for($j=0;$j<(count($data['list_date']));$j++)
													<td title="NA">N/A </td>	 
												@endfor
											@endif 
										</tr>
										<?php $arr =array();?>
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
					@csrf
					<div class="modal-content modal-md mod">
						<div class="modal-header">
							<h4 class="modal-title">Add Attendance</h4>
						</div>
						<div class="modal-body">
							 <div class="content container-fluid">
					<div class="row">
					 <div class="col-sm-2" id="name">
					 <h3></h3>
					 <h5>(Employee ID: XYZ)</h5>
					 </div>
					 <div class="col-sm-10">
					 <ul class="days_list">
						 <li class="col-sm-2">Monday</li>
						 <li class="col-sm-2">Tuesday</li>
						 <li class="col-sm-2">Wednesday</li>
						 <li class="col-sm-2">Thursday</li>
						 <li class="col-sm-2">Friday</li>
						 <li class="col-sm-2">Saturday</li>
						 <li class="col-sm-2">Sunday</li>
					 </ul>
					 <ul class="days_list">
					 	@foreach($data['date'] as $key=>$value)
					 	<li class="col-sm-2">{{@$value}}</li>
					 @endforeach
					 </ul>
					<!--  <ul class="days_list">
					 	@foreach($data['date'] as $key=>$value)
							<div class="col-sm-2 col-xs-6"> 
								<div class="form-group form-focus select-focus">
									<label class="control-label"></label>
									@if(strtotime($value)>=strtotime(date('d-m-Y')))
									<input class="time_select" id="in_time" name="in_time#{{$value}}" disabled  onclick ="attach_timer('{{$value}}',this.name);" type="text" placeholder=""/>
									@else
									<input class="time_select" id="in_time" name="in_time#{{$value}}"  onclick ="attach_timer('{{$value}}',this.name);" type="text" placeholder=""/>
									@endif
								</div>
							</div>
						@endforeach
					 </ul> -->
					 </div>
					 
					 
					</div>
					
					<div class="col-sm-2 status_nme">
					 <h4>Status:</h4></div>
					 <div class="col-sm-10">
					 	@foreach($data['date'] as $key=>$value)
					 	<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label"></label>
								<select class="select floating" name="status_presence" id="status#{{$value}}">
								@if(strtotime($value)>=strtotime(date('d-m-Y')))
									<option value="">--Select--</option>
								@endif 
									<option value="present">Present</option>
									<option value="absent">Absent</option>
									<option value="sick">Sick</option>
									<option value="vacation">Vacation</option>
									<option value="weekend">Weekend</option>
								</select>
							</div>
						</div>
						@endforeach
						
					</div>
					<div class="col-sm-2 status_nme">
					 <h4>TimeIn:</h4></div>
					<div class="col-sm-10">
					 	@foreach($data['date'] as $key=>$value)
							<div class="col-sm-2 col-xs-6"> 
								<div class="form-group form-focus select-focus">
									<label class="control-label"></label>
									@if(strtotime($value)>=strtotime(date('d-m-Y')))
									<input class="time_select in_time" id="in_time#{{$value}}" name="in_time#{{$value}}" disabled   type="text" placeholder=""/>
									@else
									<input class="time_select in_time" id="in_time#{{$value}}" name="in_time#{{$value}}"   type="text" placeholder=""/>
									@endif
								</div>
							</div>
						@endforeach
					</div>
						
						<div class="col-sm-2 status_nme">
					 <h4>TimeOut:</h4></div>
				<div class="col-sm-10">
					@foreach($data['date'] as $key=>$value)
					<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label"></label>
								@if(strtotime($value)>=strtotime(date('d-m-Y')))
								<input class="time_select out_time" name="out_time#{{$value}}" id="out_time" disabled  type="text" placeholder=""/>
								@else
								<input class="time_select out_time" name="out_time#{{$value}}" id="out_time"  type="text" placeholder=""/>
								@endif
							</div>
						</div>
						@endforeach
						</div>
						
						
						<div class="col-sm-2 status_nme">
					 <h4>TotalHrs.:</h4></div>
				<div class="col-sm-10">
					
						@foreach($data['date'] as $key=>$value)
						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label"></label>
								@if(strtotime($value)>=strtotime(date('d-m-Y')))
								<input class="time_select" name="total_time#{{$value}}" readonly id="total_time#{{$value}}" disabled type="text" placeholder=""/>
								@else
								<input class="time_select" readonly="readonly" name="total_time#{{$value}}" id="total_time#{{$value}}" type="text" placeholder=""/>
								@endif
							</div>
						</div>
						@endforeach	
						
						
						</div>
						
						
						<div class="col-sm-2 status_nme">
					 <h4>Comment:</h4></div>
						
						<div class="col-sm-10">
						@foreach($data['date'] as $key=>$value)	
						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								@if(strtotime($value)>=strtotime(date('d-m-Y')))
								<textarea class="text_area" name="comments#{{$value}}" disabled id="comments#{{$value}}"></textarea>
								@else
								<textarea class="text_area" name="comments#{{$value}}" id="comments#{{$value}}"></textarea>
								@endif
						</div>
						</div>
						@endforeach
						
						
						</div>
						<div class="col-sm-2">
						</div>
						<div class="col-sm-10">
							@foreach($data['date'] as $key=>$value)	
							<div class="col-sm-2">
							<div class="m-t-20">
								@if(strtotime($value)>=strtotime(date('d-m-Y')))
								<button class="btn btn2 btn-primary" id="submit#{{$value}}" disabled name="submit#{{$value}}">Save</button>
								@else
									<button class="btn btn2 btn-primary" id="submit#{{$value}}" name="submit#{{$value}}">Save</button>
								@endif
								</div>
							</div>
							@endforeach
						</div>
						<input type="hidden" id="employee_id" name="employee_id">
							</form>
						</div>
					</div>
				</div>




				<!-- <div class="modal-dialog">
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
				</div> -->
			</div>
				
            </div>

         </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>	
@endsection
@section('local_script')
<script src="{{asset('js/timedropper.js')}}"></script>
		<script>
			$( ".time_select" ).datetimepicker({
				format: 'LT'
			});
		</script>
		<script>
			// $( "#out_time" ).timeDropper();
		</script>
		<script type="text/javascript">
			$(".in_time").on('focusout',function(){
				// console.log($(this).val())
				var in_time = $(this).val();
				console.log(in_time);
				var name = $(this).attr('name');
				var split = name.split("#");
				var out_time = $("input[name='out_time#"+split[1]+"']").val();
				if(in_time!='' && (out_time!='' && out_time !=null)){
					calculate_difference(split[1],in_time,out_time);
				}
			});
			$(".out_time").on('focusout',function(){
				
				var out_time = $(this).val();
				
				var name = $(this).attr('name');
				var split = name.split("#");
				var in_time = $("input[name='in_time#"+split[1]+"']").val();
				
				if(out_time!='' && (in_time!='' && in_time !=null)){
					calculate_difference(split[1],in_time,out_time);
				}
			});
			$(".time_select").on('focusout',function(){
				var name = $(this).attr('name');
				// console.log(name);
				var split = name.split("#");
				var in_time ='';out_time ='';
				if(split[0]=='in_time'){
					in_time = $("input[name='"+name+"']").val();
				}else if(split[0]=='out_time'){
					out_time = $("input[name='"+name+"']").val();
				}
			
				if(in_time !='' && out_time !=''){
					var date1 = split[1]+in_time;
					var date2 = split[1]+out_time;
					console.log(date1+" "+date2);
				}
				// console.log($(this).attr('name'));
			});
			function attach_timer(id,value=null){
				
				if(value!=null){
					$("input[name='"+value+"']").datetimepicker();
				}else{
				$("#"+id).timeDropper();
					
				}
			}
			function open_attendance_modal(text,employee_id,node){
				// alert(text+" "+employee_id+" "+node);
				$("div #name>h3").text(text);
				$("div #name>h5").text('').text('Employee ID '+node);
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
	    $("button").on('click',function(e){
	    	var id = $(this).attr('id');
	    	var arr = id.split("#");
	    	var span = '"select2-status#'+arr[1]+'-container"';
	    	var status = $("span [id="+span+"]").text();
	    				 	
	    	var in_time = $("input[name='in_time#"+arr[1]+"']").val();
	    	var out_time = $("input[name='out_time#"+arr[1]+"']").val();

	    	var total_time = $("input[name='total_time#"+arr[1]+"']").val();

	    	var comments = $("textarea[name='comments#"+arr[1]+"']").val();

	    	console.log(arr+" "+status+" "+in_time+" "+out_time+" "+total_time+" "+comments);
	    	if(in_time==undefined){
	    		alert("Please select in time");
	    		return false;
	    		// alert('<div class="alert alert-danger"><p>Please select in time</p></div>');
	    		// $("#"+"in_time#"+arr[1]).after('<div class="alert alert-danger"><p>Please select in time</p></div>');
	    	}else if(out_time ==undefined){
	    		alert("Please select out time");
	    		return false;
	    	}else if(total_time==undefined){
	    		alert("Please enter total time");
	    		return false;
	    	}else if(comments ==undefined){
	    		alert("Please enter your comments");
	    		return false;
	    	}else{
	    		$.ajax({
	    			headers: {
                      'X-CSRF-TOKEN': $('input[name="_token"]').val()
                  },
	    			url: '{{route("saveAttendance")}}',
	    			type: 'POST',
	    			data: {status: status,in_time:in_time,out_time:out_time,total_time:total_time,comments:comments,employee_id:$("#employee_id").val(),date:arr[1]},
	    		})
	    		.done(function(data) {
	    			alert(data);
	    			if(data ==1){
	    				alert("Attendance added successfully");
	    			}
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

	    	// var valid = $("#add_attendance").valid();
	    	// if(valid){
	    	// 	$.ajax({
	    	// 		headers: {
      //                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
      //             },
	    	// 		url: '{{route("saveAttendance")}}',
	    	// 		type: 'POST',
	    	// 		data: {param1: $("#add_attendance").serialize()},
	    	// 	})
	    	// 	.done(function(data) {
	    	// 		if(data ==1){
	    	// 			alert("Attendance added successfully");
	    	// 		}
	    	// 		// console.log(data);
	    	// 		console.log("success");
	    	// 	})
	    	// 	.fail(function(data) {
	    	// 		var response = JSON.parse(data.responseText);
	    	// 		$.each(response.errors, function(index, val) {
	    	// 			 $("input[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
	    	// 			 $("textarea[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
	    	// 		});
	    	// 		// console.log(response);
	    	// 		// console.log("error");
	    	// 	})
	    	// 	.always(function() {
	    	// 		console.log("complete");
	    	// 	});
	    		
	    	// }
	    	// console.log(valid);
	    	e.preventDefault();
	    });

	    function calculate_difference(date,in_time,out_time){
	    	// alert(date+" "+in_time+" "+out_time);
	    	console.log(date);
	    	 var day = '1 1 1970 ',  // 1st January 1970
		        start = in_time;   //eg "09:20 PM"
		        end = out_time;   //eg "10:00 PM"
		        diff_in_min = ( Date.parse(day + end) - Date.parse(day + start) ) / 1000 / 60;
		        hours = diff_in_min/60;
		        minutes = diff_in_min%60;
		        if(minutes>0)
		        time = parseInt(hours)+" hours "+parseInt(minutes)+" minutes";
		    	else
		    	time = hours+" hours";	
		    if(diff_in_min >0){
		    	var value = 'total_time#'+date;
		    	$("input[name='"+value+"']").val(time);

		    	// $("#"+"total_time#"+date).val(diff_in_min);
		    }else{
		    	var value = 'total_time#'+date;
		    	$("input[name='"+value+"']").val('');
		    }
	    }

		</script>
@endsection