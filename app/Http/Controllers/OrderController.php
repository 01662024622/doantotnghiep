<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    function __construct() {
		$this->middleware('providor');
	}
	public function index(){
		return view('orders.index');
	}


	public function show($id){
		$data=Order::find($id);
		return response()->json($data);
	}
	public function destroy($data){
        // Product::find($id);

		$data=Order::find($id)->delete();
		return response()->json($data);
	}

	public function store(Request $request) {
		$data=$request->all();

		if ($request->has('id')) {
			$respon=Order::find($request->id)->update($data);

			return $respon;
		}
		$respon=Order::create($data);

		return $respon;

	}


}
