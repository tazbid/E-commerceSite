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
                     $contents=Cart::getContent();

				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contents as $v_contents) {
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
								<p>{{$v_contents->quantity}}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$total}} BDT</p>
							</td>
						</tr>
                       <?php }?>
						
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
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Payment method</li>
			</ol>
		</div>
		<div class="paymentCont col-sm-8">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
							<p class="text-center">Created with bootsrap button and using radio button</p>
					</div>
					
						<!-- <div class="paymentWrap">
							<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
								<form action="{{url('/order_place')}}" method="post">
						{{ csrf_field() }}
					            <label class="btn paymentMethod active">
					            	<div class="method visa"></div>
					                <input type="radio" name="payment_gateway" value="handcash" checked> 
					            </label>
					            <label class="btn paymentMethod">
					            	<div class="method master-card"></div>
					                <input type="radio" name="payment_gateway" value="paypal"> 
					            </label>
					            <label class="btn paymentMethod">
				            		<div class="method amex"></div>
					                <input type="radio" name="payment_gateway" value="bkash">
					            </label>
					       		<label class="btn paymentMethod">
				             		<div class="method vishwa"></div>
					                <input type="radio" name="payment_gateway" value="payza"> 
					            </label>
					            <label>
									<input type="submit" value="Done" class="btn btn-success pull-left btn-fyi">
								</label>
							</form>
					         
					        </div>        
						</div> -->
						<form action="{{url('/order_place')}}" method="post">
							{{ csrf_field() }}
							<input type="radio" name="payment_method" value="handcash">Hand Cash<br>
							<input type="radio" name="payment_method" value="card">Debit Card<br>
							<input type="radio" name="payment_method" value="bkash">Bkash<br>
							<input type="submit" name="" value="Done">		
						</form>
					
					
			</div>
	</div>
</section><!--/#do_action-->

@endsection