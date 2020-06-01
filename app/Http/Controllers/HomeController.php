<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;



class HomeController extends Controller
{
    public function index()
    {
    	$all_published_product = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                            ->where('tbl_products.publication_status',1)
                            ->limit(12)
                            ->get();
    	$manage_published_product = view('pages.home_content')
    						->with('all_published_product',$all_published_product);

    	return view('layout')
    			->with('pages.home_content',$manage_published_product);
    	//return view('pages.home_content');
    }

    public function show_product_by_category($category_id)
    {
        $product_by_category = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->select('tbl_products.*','tbl_category.category_name')
                            ->where('tbl_category.category_id',$category_id)
                            ->where('tbl_products.publication_status',1)
                            ->limit(12)
                            ->get();
        $manage_product_by_category = view('pages.product_by_category')
                            ->with('product_by_category',$product_by_category);

        return view('layout')
                ->with('pages.product_by_category',$manage_product_by_category);

    }

     public function show_product_by_brand($brand_id)
    {
        $product_by_brand = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                            ->where('tbl_brand.brand_id',$brand_id)
                            ->where('tbl_products.publication_status',1)
                            ->limit(12)
                            ->get();
        $manage_product_by_brand = view('pages.product_by_brand')
                            ->with('product_by_brand',$product_by_brand);

        return view('layout')
                ->with('pages.product_by_brand',$manage_product_by_brand);

    }

    public function view_product($product_id)
    {
        $view_product = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                            ->where('tbl_products.product_id',$product_id)
                            ->where('tbl_products.publication_status',1)
                            ->first();
        $manage_view_product = view('pages.product_details')
                            ->with('view_product',$view_product);

        return view('layout')
                ->with('pages.product_details',$manage_view_product);

    }

    public function customer_logout()
    {
        Session::flush();
        Cart::clear();
        return Redirect::to('/');

    }

    public function customer_login(Request $request)
    {
        $email = $request->email;
        $pass = md5($request->pass);

        $result = DB::table('tbl_customer')
                    ->where('customer_email',$email)
                    ->where('customer_password',$pass)
                    ->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/');
        }else{
            return Redirect::to('/login_check');
        }
    }
}
