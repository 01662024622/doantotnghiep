<?php

namespace App\Http\Controllers\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\User;
use App\Product;
use App\Order;
use App\Apartment;

class StatusController extends Controller
{
	function __construct() {
		$this->middleware('admin');
	}
	public function categories($id){
		$categry= Category::find($id);
		if ($categry->status==0) {
			$categry=Category::find($id)->update(array('status' => 1));
			return $categry;
		}
		$categry=Category::find($id)->update(array('status' => 0));
		return  $categry;
	}
	public function products($id){
		$data= Product::find($id);
		if ($data->status==0) {
			$data=Product::find($id)->update(array('status' => 1));
			return $data;
		}
		$data=Product::find($id)->update(array('status' => 0));
		return  $data;
	}
	public function users(Request $request, $id){
		$data=User::find($id)->update(array('role' => $request->role));
		return $data;



	}
	public function apartments($id){
		$data= Apartment::find($id);
		if ($data->status==0) {
			$data=Apartment::find($id)->update(array('status' => 1));
			return $data;
		}
		$data=Apartment::find($id)->update(array('status' => 0));
		return  $data;


	}
	public function orders(Request $request, $id){
		$data=Order::find($id)->update(array('role' => $request->status));
		return $data;



	}
}
