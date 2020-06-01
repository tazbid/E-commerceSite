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
					<a href="#">Edit Admin</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Admin</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/update_admin',$admin_info->admin_id)}}" method="post">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="date01">Admin Email</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="admin_email" value="{{$admin_info->admin_email}}" />
							  </div>
							</div>

							

							<div class="control-group">
							  <label class="control-label" for="date01">Admin Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="admin_name" value="{{$admin_info->admin_name}}" />
							  </div>
							</div> 

							<div class="control-group">
							  <label class="control-label" for="date01">Admin Phone</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="admin_phone" value="{{$admin_info->admin_phone}}" />
							  </div>
							</div>    
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->


@endsection