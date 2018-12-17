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
.day_name th span{
font-size: 12px;
}
</style>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="{{secure_asset('css/timedropper.css')}}" rel="stylesheet" type="text/css">
<!-- <link rel="stylesheet" type="text/css" href="{{secure_asset('css/jquery.datetimepicker.min.css')}}"> -->

            <div class="page-wrapper">
            	<meta name="csrf-token" content="{{ csrf_token() }}">
                <data></data>
				
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Attendance Sheet</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<!-- <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Attendance</a> -->
						</div>
					</div>
					<form id="search_attendance" name="search_attendance" method="post" action="{{route('add-attendance3')}}">
						@csrf
						<div class="row filter-row">
							<!-- <div class="col-sm-3 col-xs-6">  
								<div class="form-group form-focus">
									<label class="control-label">Employee ID</label>
									<input type="text" class="form-control floating" />
								</div>
							</div> -->
							<div class="col-sm-3 col-xs-6"> 
								<div class="form-group form-focus select-focus">
									<label class="control-label" name="month">Select Month</label>
									<select class="select floating" name="select_month"> 
										<option>-Select Month-</option>
										@for ($m=1; $m<=12; $m++)
										<?php if($m ==$data['currently_selected_month']) $selected ='selected';else $selected =''; ?>

										<option value="{{$m}}" <?php echo $selected; ?>>{{date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
									    @endfor
									</select>
								</div>
							</div>

							<div class="col-sm-3 col-xs-6"> 
								<div class="form-group form-focus select-focus">
									<label class="control-label">Select Year</label>
									<select id="specify-year" name="year" class="select floating"> 
										@foreach(range( $data['latest_year'], $data['earliest_year'] ) as $key)
										<?php if($key ==$data['currently_selected']) $selected="selected";else $selected = ''; ?>
										<option {{$selected}} value="{{$key}}">{{$key}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">  
								<button class="btn btn-success btn-block"> Search </button>  
							</div>     
	                    </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 day_name">
									<thead>
										<tr>
											<th>Employee</th>
											@foreach($data['day'] as $key=>$value)
											<th>{{$value['day_number']}} <br> <span>{{$value['day_name']}}</span></th>
											@endforeach
											
										</tr>
									</thead>
									<tbody>
									@if(!empty($data['value']))
										@foreach($data['value'] as $key=>$value)
										<tr>	
											<?php //echo "<pre>"; echo count($data['list_date']); print_r($data['list_date']);die?>
											<!-- <input type="hidden" name="last_date" id="last_date" value="{{@$data['last_date']}}">
											<input type="hidden" name="prev_week_sunday" id="prev_week_sunday" value="{{@$data['prev_week_sunday']}}">
											<input type="hidden" name="prev_week_monday" id="prev_week_monday" value="{{@$data['prev_week_monday']}}"> -->
											<?php $name = ucwords($value['first_name'].' '.$value['last_name']); ?>
											<td><a href="#" onclick="open_attendance_modal(this.text,'{{$value['employee_id']}}',<?php echo "'$key'"; ?>,'{{@$data['last_date']}}','{{@$data['prev_week_sunday']}}','{{@$data['prev_week_monday']}}') "data-toggle="modal" data-target="#add_attendence">{{$name}}</a></td>
											
											@if(isset($value['attendance']))																
												@for($j=0;$j<(count($data['list_date']));$j++)
												    @if(strtotime($data['list_date'][$j])<= strtotime(date('d-m-Y')))
														@if(array_key_exists($data['list_date'][$j],$value['attendance']))

																<?php $status =ucwords($value['attendance'][$data['list_date'][$j]]['status']);  ?>
																@if($status =='Present' )
																	<?php $sign = "<i class='fa fa-check text-success'></i>"; ?>
																@else
																	<?php $sign = "<i class='fa fa-close text-danger'></i>"; ?>
																@endif
																<td title="{{ucwords($status) }}{{' '}}{{ $value['attendance'][$data['list_date'][$j]]['in-time']}}" ><?= $sign ?></td>
														@else
														<td title="#"><i class='fa fa-close text-danger'></i></td>
														@endif
													@else
													    <td title="#"></td>
													@endif	
												@endfor
											@else
												@for($j=0;$j<(count($data['list_date']));$j++)
													@if(strtotime($data['list_date'][$j])<= strtotime(date('d-m-Y')))
														<td title="#"><i class='fa fa-close text-danger'></i></td>
													@else
														<td title="#"></td>
													@endif	 
												@endfor
											@endif 
										</tr>
										@endforeach
									@else
									<p>No Employee Available</p>
									@endif	
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
				

<!-- <div id="loader" ><img src="{{secure_asset('giphy.gif')}}" style="width: 100%"> </div> -->

<div id="add_attendence" class="modal custom-modal fade" role="dialog">
	
	<div class="modal-dialog">
		
		<button type="button" id="myModal" class="close m-b-20" data-dismiss="modal">&times;</button>
			<div class="modal-content modal-md mod">
				<div class="modal-header">
					<h4 class="modal-title">Add Attendance</h4>

					<div class=" col-sm-6 m-b-20">
						<button class="btn btn2 btn-primary" id="previous_week"  name="submit">< Previous week </button>
						</div>
						<div class="m-b-20 col-sm-6">
						<button class="btn btn2 btn-primary col-sm-6" id="next_week"  name="submit">Next week ></button> 
					</div>
				</div>

			<div class="modal-body">
				<div class="content container-fluid">	
					<div class="loader" style="height: 500px; width: 500px; z-index: 9; position: absolute; left: 0; right: 0; top:0;
					bottom: 0; margin: auto;">
					<img src="{{secure_asset('41322699_2151382915135308_775881985141768192_n.gif')}}" style="width: 100%">
					</div>
					<!--new-->
					<div class="row">
                        <div class="col-lg-12" id="main_div">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0">
									<thead>
										<tr>
											<th id="name_employee_id">
												<h4>Harjot Sahota</h4>
												<h6>Employee ID: 326</h6>
											</th>
											@foreach($data['date'] as $key=>$value)	
											<th> 
												<h5>{{@$value['name']}}</h5>
												<h6>{{@$value['date']}}</h6>
											</th>
											@endforeach
										</tr>
									</thead>
									<tbody>
										<tr>	
											<td>Status:</td>
											@foreach($data['date'] as $key=>$value)
											<td>
												<div class=" form-focus select-focus">
													<label class="control-label"></label>
													<select class="select status_presence"  name="status_presence#{{$value['date']}}">
														<option  value="">--Select--</option>	
														<option value="present">Present</option>
														<option value="absent">Absent</option>
														<option value="sick">Sick</option>
														<option value="vacation">Vacation</option>
														<option value="weekend">Weekend</option>
													</select>
												</div>
											</td>
											@endforeach											
										</tr>
										
										<tr>
											<td>TimeIn:</td>
											@foreach($data['date'] as $key=>$value)
											<td>
												<div class=" form-focus select-focus">
													<label class="control-label"></label>
													
													<input class="time_select in_time" disabled id="in_time#{{$value['date']}}" name="in_time#{{$value['date']}}"   type="text" placeholder=""/>
													
												</div>
											</td>
											@endforeach
										</tr>
										
										<tr>
												<td>TimeOut:</td>
												@foreach($data['date'] as $key=>$value)	
													<td>
														<div class="form-focus select-focus">
															<label class="control-label"></label>
															<input class="time_select out_time" disabled id="out_time#{{$value['date']}}" name="out_time#{{$value['date']}}"   type="text" placeholder=""/>
															
														</div>
													</td>
												@endforeach									
										</tr>
										
										<tr>
											<td>TotalHrs:</td>
												@foreach($data['date'] as $key=>$value)
													<td>
														<div class="form-focus select-focus">
															<label class="control-label"></label>
															<input class="time_select" disabled id="total_time#{{$value['date']}}" name="total_time#{{$value['date']}}" readonly  type="text" placeholder=""/>
															
														</div>
													</td>
												@endforeach	
										</tr>
										
										<tr>
											<td>Comment:</td>
												@foreach($data['date'] as $key=>$value)									
													<td>
														<div class="form-focus select-focus">
															<label class="control-label"></label>
															<input class="time_select" disabled id="comments#{{$value['date']}}" name="comments#{{$value['date']}}"   type="text" placeholder=""/>
															
														</div>
													</td>
												@endforeach	
										</tr>
										
										<tr>
											<td>
											</td>
											@foreach($data['date'] as $key=>$value)
												<td>
													<div class="">
														<?php if(strtotime($value['date'])>strtotime(date('d-m-Y'))){
            
										                $disabled="disabled";
										            }else{
										                $disabled = '';
										            } ?>
													<button class="btn btn2 btn-primary submit" disabled id="submit#{{$value['date']}}" {{$disabled}}  name="submit#{{$value['date']}}">Save</button>
													
													</div>
												</td>
											@endforeach
											<input type="hidden" name="employee_id" id="employee_id">
											<input type="hidden" name="employee_name" id="employee_name">
											<input type="hidden" name="last_date" id="last_date" value="{{@$data['last_date']}}">
											<input type="hidden" name="prev_week_sunday" id="prev_week_sunday" value="{{@$data['prev_week_sunday']}}">
											<input type="hidden" name="prev_week_monday" id="prev_week_monday" value="{{@$data['prev_week_monday']}}">
										</tr>
										
										
									</tbody>
								</table>
							</div>
							<div id="error_div"></div>
                        </div>
                    </div>
					
			</div>
				
            </div>

         </div>
     </div>
 </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>	



@endsection
@section('local_script')
<script src="{{secure_asset('js/timedropper.js')}}"></script>
<script type="text/javascript" src="{{secure_asset('js/add_attendance2.js')}}"></script>
<!-- <script src="{{secure_asset('js/jquery.datetimepicker.full.min.js')}}"></script> -->
		
		<script type="text/javascript">
			$('#myModal').on('click', function () {
				 location.reload();
				})
			$(function(){
			$(".loader").hide();
				$(document).on("focus", "input.in_time" , function() {
					$(this).datetimepicker({
						format: 'LT',
						// maxDate: moment()
					});
					
				});
				$(document).on("focus", "input.out_time" , function() {
					$(this).datetimepicker({
						format: 'LT',
						// maxDate: moment()
					});
					
				});
				$("input[class^='in_time']").datetimepicker({
					format: 'LT',
					maxDate: moment()
				});
				$(".in_time").datetimepicker({
					format: 'LT',
					// maxDate: moment()
				});
				$(".out_time").datetimepicker({
					format: 'LT',
					// maxDate: moment()
				});
			});
			
			$(document).on('focusout', 'input.in_time', function(event) {
				var id = $(this).attr('id');
				var arr = id.split("#");
				var out_time = "out_time#"+arr[1];
				var end = $("input[name='"+out_time+"']").val()
				// console.log();
				if(end!=''){
					end = arr[1]+" "+end;
					start = arr[1]+" "+$(this).val();
					$.ajax({
		    			headers: {
	                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                  },
		    			url: '{{route("getTime")}}',
		    			type: 'POST',
		    			data: {start:start,end:end},
		    			success:function(data){
		    				// alert(arr[1]);
		    				var total = "total_time#"+arr[1];
		    				// $("input[name='"++"']")
		    				$("input[name='"+total+"']").val(data);
		    			}
	    			});
				}

			});
			$(document).on('focusout', 'input.out_time', function(event) {
				var id = $(this).attr('id');
				var arr = id.split("#");
				var in_time = "in_time#"+arr[1];
				var start = $("input[name='"+in_time+"']").val()
				start = arr[1]+" "+start;
				var end =  arr[1]+" "+$(this).val();
				if(start!=''){
					$.ajax({
		    			headers: {
	                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                  },
		    			url: '{{route("getTime")}}',
		    			type: 'POST',
		    			data: {start:start,end:end},
		    			success:function(data){
		    				// alert(arr[1]);
		    				var total = "total_time#"+arr[1];
		    				// $("input[name='"++"']")
		    				$("input[name='"+total+"']").val(data);
		    			}
	    			}).fail(function(data){

	    			});
				}

			});

			$(".in_time").on('focusout',function(event) {
				var id = $(this).attr('id');
				var arr = id.split("#");
				var out_time = "out_time#"+arr[1];
				var end = $("input[name='"+out_time+"']").val()
				// console.log();
				if(end!=''){
					end = arr[1]+" "+end;
					start = arr[1]+" "+$(this).val();
					$.ajax({
		    			headers: {
	                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                  },
		    			url: '{{route("getTime")}}',
		    			type: 'POST',
		    			data: {start:start,end:end},
		    			success:function(data){
		    				// alert(arr[1]);
		    				var total = "total_time#"+arr[1];
		    				// $("input[name='"++"']")
		    				$("input[name='"+total+"']").val(data);
		    			}
	    			});
				}
			});

			$(".out_time").on('focusout',function(event) {
				var id = $(this).attr('id');
				var arr = id.split("#");
				var in_time = "in_time#"+arr[1];
				var start = $("input[name='"+in_time+"']").val()
				start = arr[1]+" "+start;
				var end =  arr[1]+" "+$(this).val();
				if(start!=''){
					$.ajax({
		    			headers: {
	                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                  },
		    			url: '{{route("getTime")}}',
		    			type: 'POST',
		    			data: {start:start,end:end},
		    			success:function(data){
		    				// alert(arr[1]);
		    				var total = "total_time#"+arr[1];
		    				// $("input[name='"++"']")
		    				$("input[name='"+total+"']").val(data);
		    			}
	    			}).fail(function(data){

	    			});
				}

			});

		
			
			function open_attendance_modal(text,employee_id,node,last_date,prev_week_sunday,prev_week_monday){
				
				$("#name_employee_id >h4").text(text);
				$("#name").val(text);
				$("#name_employee_id >h6").text("Employee ID:"+employee_id);
				$("#node").val(node);
				$("#employee_id").val(employee_id);
				$("#employee_name").val(text);
				$.ajax({
		    		headers: {
		                		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		             		},
	            async: false,
    			url: '{{route("firstDiv")}}',
    			type: 'POST',
    			dataType:'html',
    			data: {text:text,employee_id:employee_id,last_date:last_date,prev_week_sunday:prev_week_sunday,prev_week_monday:prev_week_monday},
    			beforeSend:function(){
    				$(".loader").show();	
    			},
    			success:function(data){
    				$(".loader").hide();
    				$("#main_div").html('').html(data);
    			}
			}).fail(function(data){
			// var response = JSON.parse(data.responseText);
			// $.each(response.errors, function(index, val) {
			// 	 // $("input[name='"+index+"']").next('div .alert-danger').empty().append('<div class=alert-danger><p>'+val+'</p></div>');
			// 	 $("input[name='"+index+"#"+arr[1]+"']").next('div .alert-danger').remove();
			// 	 $("input[name='"+index+"#"+arr[1]+"']").after('<div class=alert-danger><p>'+val+'</p></div>');
			// 	 // $("textarea[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
			// });
		});
			}
	    
	    $(document).on("click", "button.submit" , function() {

            var id = $(this).attr('id');
            var arr = id.split('#');
            var status = $("select[name='status_presence#"+arr[1]+"']").val();
            var in_time = $("input[name='in_time#"+arr[1]+"']").val();
            var out_time = $("input[name='out_time#"+arr[1]+"']").val();
            var total_time = $("input[name='total_time#"+arr[1]+"']").val();
            var comments = $("input[name='comments#"+arr[1]+"']").val();
            var employee_id = $("#employee_id").val();
            var date = arr[1];
            if(status==''){
	    		alert("Please select status");
	    		return false;
	    	}
	    	$.ajax({
		    			headers: {
	                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                  },
		    			url: '{{route("saveAttendance")}}',
		    			type: 'POST',
		    			data: {in_time:in_time,out_time:out_time,total_time:total_time,comments:comments,employee_id:employee_id,status:status,date:date},
		    			success:function(data){
		    				if(data =='1'){
		    					alert("Attendance added successfully");
		    				}
		    			}
	    			}).fail(function(data){
	    				var response = JSON.parse(data.responseText);
		    			$.each(response.errors, function(index, val) {
		    				 // $("input[name='"+index+"']").next('div .alert-danger').empty().append('<div class=alert-danger><p>'+val+'</p></div>');
		    				 $("input[name='"+index+"#"+arr[1]+"']").next('div .alert-danger').remove();
		    				 $("input[name='"+index+"#"+arr[1]+"']").after('<div class=alert-danger><p>'+val+'</p></div>');
		    				 // $("textarea[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
		    			});
	    			});
            // console.log(status+" "+in_time+" "+out_time+" "+total_time+" "+comments+" "+employee_id+" "+date);
        });


	  //   $("button[class^='submit']").on('click',function(){
	 	// 	alert("Here");
	 	// });		
	    // $(".submit").on('click',function(){
	    // 	var attr = $(this).attr('id');
	    // 	var arr = attr.split('#');
	    // 	var status = $("select[name='status_presence#"+arr[1]+"']").val();
	    // 	$("input[name='status_presence#"+arr[1]+"']").val();
	    // 	var in_time = $("input[name='in_time#"+arr[1]+"']").val();
	    // 	var out_time = $("input[name='out_time#"+arr[1]+"']").val();
	    // 	var total_time = $("input[name='total_time#"+arr[1]+"']").val();
	    // 	var comments = $("input[name='comments#"+arr[1]+"']").val();
	    // 	var employee_id = $("#employee_id").val();
	    // 	var date = arr[1];

	    // 	// alert(status);
	    // 	// var splitt= status.split('--');
	    // 	if(status==''){
	    // 		alert("Please select status");
	    // 		return false;
	    // 	}
	    	
	    // 	// var status = splitt.split(',');

	    // 	// alert(status);
	    // 	$.ajax({
		   //  			headers: {
	    //                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    //               },
		   //  			url: '{{route("saveAttendance")}}',
		   //  			type: 'POST',
		   //  			data: {in_time:in_time,out_time:out_time,total_time:total_time,comments:comments,employee_id:employee_id,status:status,date:date},
		   //  			success:function(data){
		   //  				if(data =='1'){
		   //  					alert("Arrendance added successfully");
		   //  				}
		   //  			}
	    // 			}).fail(function(data){
	    // 				var response = JSON.parse(data.responseText);
		   //  			$.each(response.errors, function(index, val) {
		   //  				 // $("input[name='"+index+"']").next('div .alert-danger').empty().append('<div class=alert-danger><p>'+val+'</p></div>');
		   //  				 $("input[name='"+index+"#"+arr[1]+"']").next('div .alert-danger').remove();
		   //  				 $("input[name='"+index+"#"+arr[1]+"']").after('<div class=alert-danger><p>'+val+'</p></div>');
		   //  				 // $("textarea[name="+index+"]").after('<div class=alert-danger><p>'+val+'</p></div>');
		   //  			});
	    // 			});
	    	
	    // });
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
	    			if(data ==1){
	    				alert("Attendance added successfully");
	    			}
	    			// console.log(data);
	    			console.log("success");
	    		})
	    		.fail(function(data) {
	    			var response = JSON.parse(data.responseText);
	    			$.each(response.errors, function(index, val) {
	    				 $("input[name="+index+"]").next('div .alert-danger').empty().after('<div class=alert-danger><p>'+val+'</p></div>');
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

	    function tConvert (time) {
  // Check correct time format and split into components
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

  if (time.length > 1) { // If time format correct
    time = time.slice (1);  // Remove full string match value
    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}

 

	 	function calculate_difference(start_time,end_time){
	 		
	 		
	 		var diff =  Math.abs(new Date(end_time) - new Date(start_time));
			var seconds = Math.floor(diff/1000); //ignore any left over units smaller than a second
			var minutes = Math.floor(seconds/60); 
			seconds = seconds % 60;
			var hours = Math.floor(minutes/60);
			minutes = minutes % 60;

			alert("Diff = " + hours + ":" + minutes + ":" + seconds);
	 	}

	 	

		</script>

		
<script type="text/javascript" src="{{secure_asset('js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection
