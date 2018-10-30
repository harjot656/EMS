 @extends('layouts.master')
 @section('content')
<style type="text/css">
	#designation{
    width: 100%;
    padding: 10px 5px;
}
</style>
   <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Employee</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="#" class="btn btn-primary pull-right rounded" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
							
						</div>
					</div>
					@if(Session::has('success'))
					<div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> {{Session::get('success') }}
					</div>
					@endif
					@if(Session::has('error'))
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> {{Session::get('error') }}
					</div>
					@endif
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th style="width:30%;">Name</th>
											<th>Employee ID</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Join Date</th>
											<!-- <th>Role</th> -->
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($data))
										@foreach($data as $key=>$value)

										<tr>
											<td>
												<a href="profile.php" class="avatar">J</a>
												<h2><a href="#">{{$value['first_name'].' '.$value['last_name']}} <span>{{$value['designation']}}</span></a></h2>
											</td>
											<td>{{$value['employee_id']}}</td>
											<td>{{$value['email']}}</td>
											<td>{{$value['phone']}}</td>
											<td>{{$value['joining_date']}}</td>
											<td class="text-right">
												<div class="dropdown">
													
													<a href="#" class="action-icon" data-toggle="modal" title="Edit" data-target="#edit_employee" onclick="edit_employeee('{{$value['employee_id']}}','{{$value['designation']}}','{{$value['first_name']}}','{{$value['last_name']}}','{{$value['email']}}',{{$value['phone']}},'{{$value['joining_date']}}','{{$key}}');"><i class="fa fa-pencil m-r-5"></i> </a>
													<a href="Javascript:void(0);" class="action-icon" data-toggle="modal" title="Delete"  onclick="if(confirm('Are you sure you want to remove this user?')){event.stopPropagation(); event.preventDefault(); remove_user('{{$key}}');}else{event.stopPropagation(); event.preventDefault();}"><i class="fa fa-trash-o m-r-5"></i> </a>
													
												</div>
											</td>
										</tr>
										@endforeach
										@else
										<p>No Record Exists</p>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.php">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.php">See all messages</a>
						</div>
					</div>
				</div>
            </div>
			<div id="add_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Employee</h4>
						</div>
						<div class="modal-body">
							<form class="m-b-30" name="" id="add_employee_list" method="POST" action="{{route('saveEmployee')}}">
								@csrf
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control add-name" type="text" name="first_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control add-name" type="text" name="last_name">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="username">
										</div>
									</div> -->
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="email" name="email">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="password" name="password">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="password" name="confirm_password">
										</div>
									</div> -->
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="employee_id" id="add_employee_id" readonly>
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class=""><input class="form-control datetimepicker" type="text" name="joining_date"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input class="form-control" type="text" name="phone">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select class="select" name="company">
												<option value="">Global Technologies</option>
												<option value="1">Delta Infotech</option>
											</select>
										</div>
									</div> -->
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation</label>
											<select class="" name="designation" id="designation">
												<option value="Manager">Manager</option>
												<option value="Associate">Associate</option>
											</select>
										</div>
									</div>

									<div class="col-sm-6" id="password_div">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="password" name="password" id="password">
										</div>
									</div>
								</div>
								<input type="hidden" id="last_numeric_employee_id" name="last_numeric_employee_id" value="{{@$last_numeric_employee_id}}">
								<input type="hidden" id="last_employee_id" name="last_employee_id" value="{{@$last_employee_id}}">
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" id="create_employee">Create Employee</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="edit_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Employee</h4>
						</div>
						<div class="modal-body">
							<form class="m-b-30" id="edit_employeee" method="POST" action="{{route('editEmployee')}}" >
								@csrf
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="first_name" name="first_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" type="text" id="last_name" name="last_name">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input class="form-control" value="johndoe" type="text">
										</div>
									</div> -->
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="email" id="email" name="email">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" value="johndoe" type="password">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" value="johndoe" type="password">
										</div>
									</div> -->
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="employee_id" readonly name="employee_id">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class=""><input class="form-control datetimepicker" id="joining_date" type="text" name="joining_date"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input class="form-control" type="text" id="phone" name="phone">
										</div>
									</div>
									<!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select class="select">
												<option value="">Global Technologies</option>
												<option value="1">Delta Infotech</option>
											</select>
										</div>
									</div> -->
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation</label>
											<select class="" id="designation" name="designation">
												<option value="Manager">Manager</option>
												<option value="Associate">Associate</option>
											</select>
										</div>
									</div>
									<input type="hidden" id="last_numeric_employee_id" name="last_numeric_employee_id" value="{{@$last_numeric_employee_id}}">
								</div>
								<input type="hidden" name="node" id="node_val">
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" id="editt_employee">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="delete_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form>
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
		<input type="hidden" id="last_numeric_employee_id" name="last_numeric_employee_id" value="{{@$last_numeric_employee_id}}">
		<input type="hidden" id="last_employee_id" name="last_employee_id" value="{{@$last_employee_id}}">
		@endsection
@section('local_script')
	<script type="text/javascript">
		$("select[name='designation']").on('change',function(){
			var val = $(this).val();
			if(val=='Manager'){
				$("#password_div").show();
				$("#password").attr('disabled',false).val("").addClass("form-control").show();
			}else{
				$("#password").attr('disabled',true).val("").removeClass("form-control").hide();
				$("#password_div").hide();
			}
		});

		$("input:text.add-name").on('change',function(){
			var attr = $(this).attr('name');
			if(attr =='first_name'){
				var last_name = $('input:text[name="last_name"]').val();
				var first_name = $(this).val();
			}else{
				var first_name = $('input:text[name="first_name"]').val();
				var last_name = $(this).val();
			}
			if(first_name!='' && last_name !=''){
				var substr = first_name.substring(0, 1);
				var substr2 = last_name.substring(0, 1);
				var employee_id = substr+substr2+$("#last_numeric_employee_id").val();
				$("#add_employee_list input[name='employee_id']").val(employee_id);

			}

		});

		function edit_employeee(employee_id,desig,f_name,l_name,email,phone,joining_date,node){
			$("#first_name").val(f_name);
			$("#last_name").val(l_name);
			$("#email").val(email);
			$("#phone").val(phone);
			$("#employee_id").val(employee_id);
			// $("#designationn").val(desig);
			$('select[name^="designation"] option[value="'+desig+'"]').attr("selected","selected");
			$("#joining_date").val(joining_date);
			$("#node_val").val(node);
		}
		function remove_user(node){
			$.ajax({
				 headers: {
			        'X-CSRF-TOKEN': $('input[name="_token"]').val()
			    },
				url: '{{route("removeEmployee")}}',
				type: 'POST',
				data: {param1: node},
			})
			.done(function(data) {
				if(data =='1'){
					alert("Employee removed successfully");
					location.reload();
				}
				// console.log("success");
			});
			
			// console.log(node);
		}
		</script>
		<!-- <script type="text/javascript" src="{{asset('js/index.js')}}"></script> -->
@endsection