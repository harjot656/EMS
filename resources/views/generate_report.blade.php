@extends('layouts.master')
 @section('content')
 <style type="text/css">
 	.daterangepicker{
 		width: 23%!important;
 	}

 	.select2-container {
    
    width: 100% !important;
}

.table > tbody > tr > td {
    width: 130px;
}

.user-info {
    padding: 20px 10px;
}

 </style>

 	

            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-8">
							<h4 class="page-title">Generate Report</h4>
						</div>
						
					</div>
					<form method="POST" id="generate_report" action="{{route('get_report')}}">
						
					@csrf
					<div class="row filter-row">
                           <div class="col-sm-3 col-md-2 col-xs-6">  
								 <input type="radio" id="all_emp" name="report_by" value="all_employees"> <label for="all_emp">All Employees</label>
								
                           </div>
                           <div class="col-sm-3 col-md-2 col-xs-6">
 								<input type="radio" id="select_emp" name="report_by"><label for="select_emp">Select Employee</label>
								<div class="form-group form-focus select-focus" >		
									<select class="floating" id="employee" name="report_byy"> 
										<option value=""> -- Select -- </option>
										@foreach($data['value'] as $key=>$value)
										<option value="{{$value['employee_id']}}">{{$value['first_name']}} {{$value['last_name']}}</option>
										@endforeach
										
									</select>
								</div>
                           </div>
                    </div>  
						<div class="row filter-row">       
						   <div class="col-sm-6 col-md-8 col-lg-4 col-xs-12" style=" padding:0; "> 
						   <div class="col-sm-6 col-md-6 col-xs-6"> 
								<input type="radio" id="specify-d" data-for="specify-date" name="report-by"> <label for="specify-d">Specify Date</label>
								<div class="form-group form-focus">
									<label class="control-label">From</label>
									<input class="form-control floating datetimepickerr" name="from_date" id="from_date"  type="text">
								</div>
							</div>
						   <div class="col-sm-6 col-md-6 col-xs-6">  
						   <h5> &nbsp;</h5>
								<div class="form-group form-focus">
									<label class="control-label">To</label>
									<input class="form-control floating datetimepickerr" name="to_date" id="to_date" type="text">
								</div>
							</div>
							</div>
							
						   <div class="col-sm-3 col-md-2 col-xs-6"> 
								<input type="radio" id="specify-w" data-for="specify-week" name="report-by"> <label for="specify-w">Weekly</label>
								<div class="form-group form-focus">
									<label class="control-label">Select Week</label>
									<input class="form-control floating" name="week" id="specify-week" type="text">
								</div>
							</div>
							
							<div class="col-sm-3 col-md-2 col-xs-6"> 
								 <input type="radio" id="specify-m" data-for="specify-month" name="report-by"> <label for="specify-m">Monthly</label>
								<div class="form-group form-focus select-focus">
									<label class="control-label">Select Month</label>
									<select id="specify-month" name="month_by"   class="floating">
										@foreach($data['date'] as $key=>$value)
										<?php if(date('F')==$value) $selected="selected";else $selected = ''; ?>
										<option {{$selected}}  value="{{$value}}" >{{$value}}</option>
										@endforeach
									</select>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-2 col-xs-6"> 
							 <input type="radio" id="specify-y" data-for="specify-year" name="report-by"> <label for="specify-y">Yearly</label>
								<div class="form-group form-focus select-focus">
									<label class="control-label">Select Year</label>
									<select id="specify-year" name="year" class="floating"> 
										@foreach(range( $data['latest_year'], $data['earliest_year'] ) as $key)
										<?php if($key ===$data['latest_year']) $selected="selected";else $selected = ''; ?>
										<option {{$selected}} value="{{$key}}">{{$key}}</option>
										@endforeach
									</select>
								</div>
							</div>
						
						
                              
                    </div>
					<div class="row">
						<div class="m-t-20 text-center">
							<button id="gen_rpt" class="btn btn-primary">Genrate Report</button>
						</div>
					</div>
				</form>			
			    </div>
			    <div id="mainDiv"></div>
			</div>
			
			<div class="sidebar-overlay" data-reff="#sidebar"></div>
 @endsection
@section('local_script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
	$("#employee,#specify-month,#specify-year").select2();
	// $(".floating").select2();
	$(document).ready(function() {
		$(".datetimepickerr").datetimepicker({
		 format: 'DD-MM-YYYY',
		 useCurrent: false,
		 maxDate: new Date()
		});

		$("input[type='text']").attr('disabled',true);
		$("select[id='specify-month']").attr('disabled',true);
		$("select[id='specify-year']").attr('disabled',true);
	});
	$("input[type='radio']").on('click',function(){
		var id = $(this).attr('id');
		console.log($(this).attr('id'));
		if(id!='select_emp'||id!='all_emp'){
			var arr = id.split('-');
			if(arr[1] == 'd'){
				$("#to_date").attr('disabled',false);$("#from_date").attr('disabled',false);
				$("#specify-week").attr('disabled',true);$("#specify-month").attr('disabled',true);$("#specify-year").attr('disabled',true);
			}else if (arr[1]=='m') {
				$("#specify-month").attr('disabled',false);
				$("#specify-week").attr('disabled',true);$("#specify-year").attr('disabled',true);$("#to_date").attr('disabled',true);$("#from_date").attr('disabled',true);
			}else if (arr[1]=='w') {
				$("#specify-week").attr('disabled',false);
				$("#specify-year").attr('disabled',true);$("#specify-month").attr('disabled',true);$("#to_date").attr('disabled',true);$("#from_date").attr('disabled',true);
			}else if(arr[1]== 'y') {
				$("#specify-year").attr('disabled',false);
				$("#specify-week").attr('disabled',true);$("#specify-month").attr('disabled',true);$("#to_date").attr('disabled',true);$("#from_date").attr('disabled',true);
			}
		}
	});

	$("#generate_report").validate({
		ignore: null,
		rules:{
			report_by:{
				required:true
			},
			from_date:{
				required:true
			},
			to_date:{
				required:true	
			},
			week:{
				required:true
			}
		}
	});

	$("#gen_rpt").on('click',function(e){
		console.log($("#generate_report").valid());
		if($("#generate_report").valid()){
			e.preventDefault();
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('input[name="_token"]').val()
			    },
				url: '{{route("get_report")}}',
				type: 'POST',
				dataType:'html',
				data: {param1: $("#generate_report").serialize()},
			})
			.done(function(data) {
				$("#mainDiv").html('').html(data);
				// console.log(data);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}

		
		
	});
	$("#specify-week").daterangepicker({
		locale: {
      format: 'DD-MM-YYYY',
    },
    maxDate:new Date()
	});

	
	
</script>
@endsection