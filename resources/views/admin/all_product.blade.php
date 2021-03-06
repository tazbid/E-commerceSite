@extends('admin_layout')

@section('admin_content')

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<p class="alert-success">
				<?php
					$message = Session::get('message');
					if($message){
						echo $message;
						Session::put('message',null);
					}
				?>							
			</p>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Product ID</th>
								  <th>Product Name</th>
								  <th>Image</th>
								  <th>Category ID</th>
								  <th>Brand ID</th>
								  <th>Product Price</th>
								  <th>Product Size</th>
								  <th>Product Color</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>

						  @foreach($all_product_info as $v_product)
						  <tbody>
							<tr>
								<td>{{ $v_product->product_id }}</td>
								<td class="center">{{ $v_product->product_name }}</td>
								<td><img src="{{URL::to($v_product->product_image)}}" style="height: 80px;width: 80px;"></td>
								<td class="center">{{ $v_product->category_id }}</td>
								<td class="center">{{ $v_product->brand_id }}</td>
								<td class="center">{{ $v_product->product_price }}</td>
								<td class="center">{{ $v_product->product_size }}</td>
								<td class="center">{{ $v_product->product_color }}</td>

								<td class="center">
									@if($v_product->publication_status == 1)
									<span class="label label-success">Active</span>

									@else
									<span class="label label-warning">Inactive</span>

									@endif
								</td>

								<td class="center">
									@if($v_product->publication_status == 1)
										<a class="btn btn-danger" href="{{URL::to('/unactive_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
										</a>
									@else
										<a class="btn btn-success" href="{{URL::to('/active_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
										</a>
									@endif


									<a class="btn btn-info" href="{{URL::to('/edit_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete_product/'.$v_product->product_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						   </tbody>
						   @endforeach

						 </table>  
						 <div class="pagination pagination-centered">
						  <ul>
							<li><a href="#">Prev</a></li>
							<li class="active">
							  <a href="#">1</a>
							</li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
						</div>     
					</div>
				</div><!--/span-->
			</div><!--/row-->

@endsection