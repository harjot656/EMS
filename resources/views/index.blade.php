 @extends('layouts.master')
 @section('content')

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
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
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
											<input class="form-control" type="text" name="first_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" type="text" name="last_name">
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
											<input type="text" class="form-control" name="employee_id">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
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
											<select class="select" name="designation">
												<option>Web Developer</option>
												<option>Web Designer</option>
												<option>SEO Analyst</option>
											</select>
										</div>
									</div>
								</div>
								
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
							<form class="m-b-30">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" value="John" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" value="Doe" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input class="form-control" value="johndoe" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" value="johndoe@example.com" type="email">
										</div>
									</div>
									<div class="col-sm-6">
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
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" value="FT-0001" readonly="" class="form-control floating">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input class="form-control" value="9843014641" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select class="select">
												<option value="">Global Technologies</option>
												<option value="1">Delta Infotech</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation</label>
											<select class="select">
												<option>Web Developer</option>
												<option>Web Designer</option>
												<option>SEO Analyst</option>
											</select>
										</div>
									</div>
								</div>
								<div class="table-responsive m-t-15">
									<table class="table table-striped custom-table">
										<thead>
											<tr>
												<th>Module Permission</th>
												<th class="text-center">Read</th>
												<th class="text-center">Write</th>
												<th class="text-center">Create</th>
												<th class="text-center">Delete</th>
												<th class="text-center">Import</th>
												<th class="text-center">Export</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Holidays</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Leave Request</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Projects</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Tasks</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Chats</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary">Save Changes</button>
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

		@endsection
		