@extends('admin_layout')

@section('admin_content')


	<div class="row-fluid sortable">
		<div class="box span6">
			<div class="box-header">
				<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
			</div>

			<div class="box-content">
				<table class="table">
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Mobile no</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							@foreach($order_by_id as $v_order)
							@endforeach
							<td>{{$v_order->customer_name}}</td>
							<td>{{$v_order->customer_mobile}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="box span6">
			<div class="box-header">
				<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping details</h2>
			</div>
			<div class="box-content">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							@foreach($order_by_id as $v_order)
							@endforeach
							<td>{{$v_order->shipping_first_name}}</td>
							<td>{{$v_order->shipping_address}}</td>
							<td>{{$v_order->shipping_mobile_no}}</td>
							<td>{{$v_order->shipping_email}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
			</div>
			<div class="box-content">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Product Quantity</th>
							<th>Product Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order_by_id as $v_order) 
						<tr>
							<td>{{$v_order->order_id}}</td>
							<td>{{$v_order->product_name}}</td>
							<td>{{$v_order->product_price}}</td>
							<td>{{$v_order->product_quantity}}</td>
							<td>{{$v_order->product_price * $v_order->product_quantity}}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">Total with shipping charge+vat</td>
							<td><strong>= {{$v_order->order_total}} BDT</strong></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>


@endsection