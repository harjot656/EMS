$("#add_employee_list").validate({
ignore: [],
rules:{
	first_name:{
		required:true,
		lettersonly:true
	},
	last_name:{
		required:true,
		lettersonly:true
	},
	// username:{
	// 	required:true
	// },
	email:{
		required:true,
		email:true
	},
	password:{
		required:true,
		minlength:6
	},
	// confirm_password :{
 //        minlength : 5,
 //        equalTo : '[name="password"]'
 //    },
    employee_id:{
    	required:true
    },
    joining_date:{
    	required:true,
    	// date:true
    },
    phone:{
    	required:true,
    	maxlength:10,
    	minlength:10,
    	digits:true
    }

}
});


$(document).on('click','#create_employee',function(){
// alert($("#add_employee_list").valid());

});

// $("#create_employee").on('click',function(e){
// 	alert("")
// console.log($("#add_employee_list").valid());
// // e.preventDefault();

// });

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 


$("#edit_employeee").validate({
	rules:{
		first_name:{
			required:true,
			lettersonly:true
		},
		last_name:{
			required:true,
			lettersonly:true	
		},
		email:{
			required:true,
			email:true
		},
		employee_id:{
    	required:true
    	},
    	joining_date:{
	    	required:true,
	    	// date:true
    	},
    	phone:{
	    	required:true,
	    	maxlength:10,
	    	minlength:10,
	    	digits:true
    	}
	}
});

$("#editt_employee").on('click',function(event) {
	var valid = $("#edit_employeee").valid();
	if(!valid)event.preventDefault();
});