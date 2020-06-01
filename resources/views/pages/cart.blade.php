@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php 
				$contents = Cart::getContent();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($contents as $v_contents){ 
							$total = ($v_contents->price) * ($v_contents->quantity);
							?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_contents->attributes->image)}}" height="80px" width="80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_contents->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{$v_contents->price}} BDT</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{URL::to('/update_plus/'.$v_contents->id )}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_contents->quantity}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{URL::to('/update_minus/'.$v_contents->id )}}"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$total}} BDT</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete_from_cart/'.$v_contents->id )}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::getSubTotal()}} BDT</span></li>
							<li>Shipping Cost <span>120 BDT</span></li>
							<li>Total <span>{{Cart::getTotal()+120}} BDT</span></li>
						</ul>

							<?php 
							$customer_id = Session::get('customer_id');
							$shipping_id = Session::get('shipping_id');
							 ?>
                			<?php if($customer_id != NULL && $shipping_id != NULL) { ?>
								<a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Check Out</a>
							<?php } if($customer_id != NULL && $shipping_id == NULL) { ?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
							<?php } if($customer_id == NULL && $shipping_id == NULL) { ?>
								<a class="btn btn-default check_out" href="{{URL::to('/login_check')}}">Check Out</a>
							<?php } ?>


					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection