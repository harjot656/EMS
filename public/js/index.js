$("#edit_employee").validate({
	rules:{
		first_name:{
			required:true
			
		},
		last_name:{
			required:true
		},
		email:{
			required:true,
			email:true
		},
		employee_id:{
			required:true
		},
		joining_date:{
			required:true
		},
		phone:{
			required:true
		},
		designation:{
			required:true
		}
	}
});

$("#editt_employee").click(function(event) {
	var valid = $("#edit_employee").valid();
	event.preventDefault();
});