$(document).on('change','select.status_presence',function(){
	var value = $(this).val();
	var name = $(this).attr('name');
	var arr = name.split("#");
	var date2 = arr[1];
	var newdate = date2.split("-").reverse().join("-");
	var d1 = new Date(); ////// Current Date
	var d2 = new Date(newdate);
	if(d1>d2){  ///when selected date is lesser than current date 
		if(value.toLowerCase() =='present'){
				
			$("input[name='in_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='out_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='total_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='comments#"+arr[1]+"']").attr('disabled',false).val("");
			$("button[name='submit#"+arr[1]+"']").attr('disabled', false);
		}else if(((value.toLowerCase() =='absent')||((value.toLowerCase() =='sick')) || ((value.toLowerCase() =='vacation'))) ){
			$("input[name='comments#"+arr[1]+"']").attr('disabled',false).val("");	
			$("input[name='in_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("input[name='out_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("input[name='total_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("button[name='submit#"+arr[1]+"']").attr('disabled',false);
		}else if(value.toLowerCase() =='weekend'){
			$("input[name='in_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='out_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='total_time#"+arr[1]+"']").attr('disabled',false).val("");
			$("input[name='comments#"+arr[1]+"']").attr('disabled',false).val("");
			$("button[name='submit#"+arr[1]+"']").attr('disabled', false);
		}
		else{
			$("input[name='in_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("input[name='out_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("input[name='total_time#"+arr[1]+"']").attr('disabled',true).val("");
			$("input[name='comments#"+arr[1]+"']").attr('disabled',true).val("");
			$("button[name='submit#"+arr[1]+"']").attr('disabled', true);
		}
	}else { /// else 
	console.log("Hereee");
	}
	// console.log(value);



});


$("#next_week").on('click',function(e){
	$(".loader").show();
var week = 'next_week';
var employee_id = $("input[id^='employee_id']").val();
var employee_name = $("input[id^='employee_name']").val();
var last_date = $("input[id^='last_date']").val();
var prev_week_sunday = $("input[id^='prev_week_sunday']").val();
var prev_week_monday = $("input[id^='prev_week_monday']").val();
// alert(employee_id+" "+employee_name);
show_prev_next_weeks(week,employee_id,employee_name,last_date,prev_week_sunday,prev_week_monday);
e.preventDefault();
});

$("#previous_week").on('click',function(e){
	$(".loader").show();
var week = 'prev_week';
var employee_id = $("input[id^='employee_id']").val();
var employee_name = $("input[id^='employee_name']").val();
var last_date = $("input[id^='last_date']").val();
var prev_week_sunday = $("input[id^='prev_week_sunday']").val();
var prev_week_monday = $("input[id^='prev_week_monday']").val();
show_prev_next_weeks(week,employee_id,employee_name,last_date,prev_week_sunday,prev_week_monday);
e.preventDefault();
});


function show_prev_next_weeks(week,employee_id,employee_name,last_date,prev_week_sunday,prev_week_monday){
	
$.ajax({
	    headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	             },
	            async: false,
    			url: 'prevNextWeek2',
    			type: 'POST',
    			dataType:'html',
    			data: {week:week,employee_id:employee_id,employee_name:employee_name,last_date:last_date,prev_week_sunday:prev_week_sunday,prev_week_monday:prev_week_monday},
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