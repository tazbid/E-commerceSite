<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin_login');
    }

    public function show_dashboard()
    {
    	return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('tbl_admin')
    			->where('admin_email',$admin_email)
    			->where('admin_password',$admin_password)
    			->first();

    		if ($result) {
    			Session::put('admin_name',$result->admin_name);
    			Session::put('admin_id',$result->admin_id);
    			return Redirect::to('/dashboard');
    		}else{
    			Session::put('message','Invalid Email or Password!');
    			return Redirect::to('/login');
    		}
    }

    public function manage_order()
    {
        $this->AdminAuthCheck();
        $all_order_info = DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->select('tbl_order.*','tbl_customer.customer_name')
                        ->get();
        $manage_order = view('admin.manage_order')
                        ->with('all_order_info',$all_order_info);
        return view('admin_layout')
                ->with('admin.manage_order',$manage_order);
    }

    public function unactive_order($order_id)
    {
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 'pending']);
            Session::put('message','Order Status Changed!');
        return Redirect::to('/manage_order');
    }

    public function active_order($order_id)
    {
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 'delivered']);
            Session::put('message','Order Status Changed!');
        return Redirect::to('/manage_order');
    }

    public function delete_order($order_id)
    {
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->delete();
        Session::put('message',"Order Deleted Successfully!");
        return Redirect::to('/manage_order');
    }

    public function view_order($order_id)
    {
        $this->AdminAuthCheck();
        $order_by_id = DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
                        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                        ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
                        ->get();
        $view_order = view('admin.view_order')
                        ->with('order_by_id',$order_by_id);
        return view('admin_layout')
                ->with('admin.view_order',$view_order);
    }

    public function all_admin()
    {
        $this->AdminAuthCheck();
        $all_admin_info = DB::table('tbl_admin')->get();
        $manage_admin = view('admin.all_admin')
                            ->with('all_admin_info',$all_admin_info);

        return view('admin_layout')
                ->with('admin.all_admin',$manage_admin);

    }

    public function add_admin()
    {
        $this->AdminAuthCheck();
        return view('admin.add_admin');
    }


    public function save_admin(Request $request)
    {
        $this->AdminAuthCheck();
        $data = array();
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;

        $data['publication_status'] = $request->publication_status;

        DB::table('tbl_admin')->insert($data);
        Session::put('message','New Admin Added Succesfully!');
        return Redirect::to('add_admin');
    }

    public function unactive_admin($admin_id)
    {
        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->update(['publication_status' => 0]);
            Session::put('message','Admin Unactivated!');
        return Redirect::to('/all_admin');
    }


    public function active_admin($admin_id)
    {
        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->update(['publication_status' => 1]);
            Session::put('message','Admin Activated!');
        return Redirect::to('/all_admin');
    }

    public function edit_admin($admin_id)
    {
        $this->AdminAuthCheck();
        $admin_info = DB::table('tbl_admin')
                        ->where('admin_id',$admin_id)
                        ->first();
        $admin_info=view('admin.edit_admin')
                        ->with('admin_info',$admin_info);
         return view('admin_layout')
            ->with('admin.edit_admin',$admin_info);
    }


    public function update_admin(Request $request,$admin_id)
    {
        $this->AdminAuthCheck();
        $data = array();
        $data['admin_email'] = $request->admin_email;
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;

        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->update($data);
        Session::put('message','Admin Updated Successfully!');
        return Redirect::to('/all_admin');
    }

    public function delete_admin($admin_id)
    {
        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->delete();
        Session::put('message',"Admin Deleted Successfully!");
        return Redirect::to('/all_admin');
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
