<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    function __construct() {
		$this->middleware('admin');
	}
	public function index(){
		return view('apartments.index');
	}


	public function show($id){
		$data=Apartment::find($id);
        // $categories=Category::orderBy('id','DESC')->get();
		return response()->json($data);
	}
	public function destroy($data){
        // Product::find($id);

		$data=Apartment::find($id)->delete();
		return response()->json($data);
	}

	public function store(Request $request) {
		$data=$request->all();

		if ($request->has('id')) {
			$respon=Apartment::find($request->id)->update($data);

			return $respon;
		}
		$respon=Apartment::create($data);

		return $respon;

	}
	public function post($slug){

		$products= Apartment::where('slug',$slug)->first();

	}
}
