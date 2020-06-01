<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class CategoryController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_category');
    }

    public function all_category()
    {
        $this->AdminAuthCheck();
    	$all_category_info = DB::table('tbl_category')->get();
    	$manage_category = view('admin.all_category')
    						->with('all_category_info',$all_category_info);

    	return view('admin_layout')
    			->with('admin.all_category',$manage_category);

    	//return view('admin.all_category');
    }

    public function save_category(Request $request)
    {
        $this->AdminAuthCheck();
    	$data = array();
    	$data['category_id'] = $request->category_id;
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;
    	$data['publication_status'] = $request->publication_status;

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','New Category Added Succesfully!');
    	return Redirect::to('add_category');
    }

    public function unactive_category($category_id)
    {
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status' => 0]);
    		Session::put('message','Category Unactivated!');
    	return Redirect::to('/all_category');
    }

    public function active_category($category_id)
    {
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status' => 1]);
    		Session::put('message','Category Activated!');
    	return Redirect::to('/all_category');
    }

    public function edit_category($category_id)
    {
        $this->AdminAuthCheck();
        $category_info = DB::table('tbl_category')
                        ->where('category_id',$category_id)
                        ->first();
        $category_info=view('admin.edit_category')
                        ->with('category_info',$category_info);
         return view('admin_layout')
            ->with('admin.edit_category',$category_info);
    }

    public function update_category(Request $request,$category_id)
    {
        $this->AdminAuthCheck();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update($data);
        Session::put('message','Category Updated Successfully!');
        return Redirect::to('/all_category');
    }

    public function delete_category($category_id)
    {
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->delete();
        Session::put('message',"Category Deleted Successfully!");
        return Redirect::to('/all_category');
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
