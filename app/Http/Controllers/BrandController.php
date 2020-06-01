<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_brand');
    }

    public function save_brand(Request $request)
    {
        $this->AdminAuthCheck();
    	$data = array();
    	$data['brand_id'] = $request->brand_id;
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_description'] = $request->brand_description;
    	$data['publication_status'] = $request->publication_status;

    	DB::table('tbl_brand')->insert($data);
    	Session::put('message','New Brand Added Succesfully!');
    	return Redirect::to('add_brand');
    }

     public function all_brand()
    {
        $this->AdminAuthCheck();
        $all_brand_info = DB::table('tbl_brand')->get();
        $manage_brand = view('admin.all_brands')
                            ->with('all_brand_info',$all_brand_info);

        return view('admin_layout')
                ->with('admin.all_brands',$manage_brand);

        //return view('admin.all_category');
    }

    public function unactive_brand($brand_id)
    {
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update(['publication_status' => 0]);
            Session::put('message','Brand Unactivated!');
        return Redirect::to('/all_brands');
    }

    public function active_brand($brand_id)
    {
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update(['publication_status' => 1]);
            Session::put('message','Brand Activated!');
        return Redirect::to('/all_brands');
    }

    public function edit_brand($brand_id)
    {
        $this->AdminAuthCheck();
        $brand_info = DB::table('tbl_brand')
                        ->where('brand_id',$brand_id)
                        ->first();
        $brand_info=view('admin.edit_brand')
                        ->with('brand_info',$brand_info);
         return view('admin_layout')
            ->with('admin.edit_brand',$brand_info);
    }

    public function update_brand(Request $request,$brand_id)
    {
        $this->AdminAuthCheck();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update($data);
        Session::put('message','Brand Updated Successfully!');
        return Redirect::to('/all_brands');
    }

    public function delete_brand($brand_id)
    {
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->delete();
        Session::put('message',"Brand Deleted Successfully!");
        return Redirect::to('/all_brands');
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
