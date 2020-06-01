<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();


class SliderController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
    	$data = array();
    	$data['publication_status'] = $request->publication_status;
    	$image = $request->file('slider_image');
    	if($image)
    	{
    		$image_name = Str::random(20);
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'slider/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['slider_image'] = $image_url;

    			DB::table('tbl_slider')->insert($data);
    			Session::put('message','Slider Added Successfully');
    			return Redirect::to('/add_slider');

    		}
    	}
    	$data['slider_image'] = '';
    		DB::table('tbl_slider')->insert($data);
    		Session::put('message','Slider Added Successfully Without Image');
    		return Redirect::to('/add_slider'); 
    }

    public function all_slider()
    {
        $this->AdminAuthCheck();
    	$all_slider_info = DB::table('tbl_slider')->get();
    	$manage_slider = view('admin.all_slider')
    						->with('all_slider_info',$all_slider_info);

    	return view('admin_layout')
    			->with('admin.all_slider',$manage_slider);
    }

    public function unactive_slider($slider_id)
    {
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status' => 0]);
            Session::put('message','Slider Unactivated!');
        return Redirect::to('/all_slider');
    }

    public function active_slider($slider_id)
    {
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status' => 1]);
            Session::put('message','Slider Activated!');
        return Redirect::to('/all_slider');
    }

    public function delete_slider($slider_id)
    {
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->delete();
        Session::put('message',"Slider Deleted Successfully!");
        return Redirect::to('/all_slider');
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
