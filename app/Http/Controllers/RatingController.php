<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;

class RatingController extends Controller
{
   
	public function index(){
		return view('ai.rating');
	}


	public function show($id){
		$data=Rating::find($id);
        // $categories=Category::orderBy('id','DESC')->get();
		return response()->json($data);
	}
	public function destroy($data){
        // Product::find($id);

		$data=Rating::find($id)->delete();
		return response()->json($data);
	}

	public function store(Request $request) {
		$data=$request->all();

		$respon=Rating::create($data);

		return $respon;

	}


}
