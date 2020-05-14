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
	public function update(Request $request, $id) {
		$data=$request->only(['name', 'parent_id']);
		// return $data;
		$data['slug']=Str::slug($request->name, '-').time();
		$respon=Rating::find($id)->update($data);
		return $respon;
	}


}
