<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;

class CheckoutController extends Controller
{
    public function login_check()
    {
    	return view('pages.login');
    }

    public function customer_reg(Request $request)
    {
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_mobile'] = $request->customer_mobile;

    	$customer_id = DB::table('tbl_customer')
    					->insertGetId($data);
    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/checkout');
    }

    public function checkout()
    {
    	return view('pages.checkout');
    }

    public function save_shipping_details(Request $request)
    {
    	$data = array();
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_first_name'] = $request->shipping_first_name;
    	$data['shipping_last_name'] = $request->shipping_last_name;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_mobile_no'] = $request->shipping_mobile_no;
    	$data['shipping_city'] = $request->shipping_city;

    	$shipping_id = DB::table('tbl_shipping')
    					->insertGetId($data);
    	Session::put('shipping_id',$shipping_id);
    	return Redirect::to('/payment');
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function order_place(Request $request)
    {
        $payment_gateway = $request->payment_method;

        $pdata = array();
        $pdata['payment_method'] = $payment_gateway;
        $pdata['payment_status'] = 'pending';
        $payment_id = DB::table('tbl_payment')
                        ->insertGetId($pdata);

        $odata = array();
        $odata['customer_id'] = Session::get('customer_id');
        $odata['shipping_id'] = Session::get('shipping_id');
        $odata['payment_id'] = $payment_id;
        $odata['order_total'] = Cart::getTotal()+120;
        $odata['order_status'] = 'pending';
        $order_id = DB::table('tbl_order')
                    ->insertGetId($odata);


        $contents = Cart::getContent();
        $oddata = array();

        foreach ($contents as $v_content ) {
            $oddata['order_id'] = $order_id;
            $oddata['product_id'] = $v_content->id;
            $oddata['product_name'] = $v_content->name;
            $oddata['product_price'] = $v_content->price;
            $oddata['product_quantity'] = $v_content->quantity;

            DB::table('tbl_order_details')
            ->insert($oddata);
        }
        if($payment_gateway == 'handcash' || $payment_gateway == 'card' || $payment_gateway == 'bkash')
        {
            Cart::clear();
            Session::put('shipping_id',NULL);
            return view('pages.order_done');
        }
    }
}
