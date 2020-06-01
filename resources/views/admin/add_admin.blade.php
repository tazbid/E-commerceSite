@extends('admin_layout')

@section('admin_content')


			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Admin</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add New Admin</h2>
					</div>
					<div class="box-content">
						<p class="alert-success">
							<?php
								$message = Session::get('message');
								if($message){
									echo $message;
									Session::put('message',null);
								}
							?>							
						</p>
						<form class="form-horizontal" action="{{url('/save_admin')}}" method="post">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="date01">Admin Email</label>
							  <div class="controls">
								<input type="Email" class="input-xlarge" name="admin_email" required />
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Admin Password</label>
							  <div class="controls">
								<input type="Password" class="input-xlarge" name="admin_password" required />
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Admin Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="admin_name" required />
							  </div>
							</div> 

							<div class="control-group">
							  <label class="control-label" for="date01">Admin Phone</label>
							  <div class="controls">
								<input type="Text" class="input-xlarge" name="admin_phone" required />
							  </div>
							</div> 

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Publication Status</label>
							  <div class="controls">
								<input type="checkbox" name="publication_status" value="1">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Admin</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->


@endsection