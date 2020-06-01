<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();


class ProductController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_product');
    }

    public function all_product()
    {
        $this->AdminAuthCheck();
    	$all_product_info = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                            ->get();
    	$manage_product = view('admin.all_product')
    						->with('all_product_info',$all_product_info);

    	return view('admin_layout')
    			->with('admin.all_product',$manage_product);
    }

    public function save_product(Request $request)
    {
        $this->AdminAuthCheck();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['category_id'] = $request->category_id;
    	$data['brand_id'] = $request->brand_id;
    	$data['product_short_description'] = $request->product_short_description;
    	$data['product_long_description'] = $request->product_long_description;
    	$data['product_price'] = $request->product_price;
    	$data['product_size'] = $request->product_size;
    	$data['product_color'] = $request->product_color;
    	$data['publication_status'] = $request->publication_status;

    	$image = $request->file('product_image');

    	if($image)
    	{
    		$image_name = Str::random(20);
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'image/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['product_image'] = $image_url;

    			DB::table('tbl_products')->insert($data);
    			Session::put('message','Product Added Successfully');
    			return Redirect::to('/add_product');

    		}
    	}
    	$data['product_image'] = '';
    		DB::table('tbl_products')->insert($data);
    		Session::put('message','Product Added Successfully Without Image');
    		return Redirect::to('/add_product'); 

    }

    public function unactive_product($product_id)
    {
    	DB::table('tbl_products')
    		->where('product_id',$product_id)
    		->update(['publication_status' => 0]);
    		Session::put('message','Product Unactivated!');
    	return Redirect::to('/all_product');
    }

    public function active_product($product_id)
    {
    	DB::table('tbl_products')
    		->where('product_id',$product_id)
    		->update(['publication_status' => 1]);
    		Session::put('message','Product Activated!');
    	return Redirect::to('/all_product');
    }

    public function edit_product($product_id)
    {
        $this->AdminAuthCheck();
        $product_info = DB::table('tbl_products')
                        ->where('product_id',$product_id)
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                        ->first();
        $product_info=view('admin.edit_product')
                        ->with('product_info',$product_info);
         return view('admin_layout')
            ->with('admin.edit_product',$product_info);
    }

    public function update_product(Request $request,$product_id)
    {
        $this->AdminAuthCheck();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('product_image');

        if($image)
        {
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['product_image'] = $image_url;

                DB::table('tbl_products')
                ->where('product_id',$product_id)
                ->update($data);
                Session::put('message','Product Updated Successfully');
                return Redirect::to('/all_product');

            }
        }
        $data['product_image'] = '';
            DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update($data);
            Session::put('message','Product Updated Successfully Without Image');
            return Redirect::to('/all_product'); 

    }

    public function delete_product($product_id)
    {
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();
        Session::put('message',"Product Deleted Successfully!");
        return Redirect::to('/all_product');
    }

    public function AdminAuthCheck()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        }else{
            return Redirect::to('/login')->send();
        }
    }
}
