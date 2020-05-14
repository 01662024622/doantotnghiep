<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Rating;

class ConstController extends Controller
{
    public function index(){
		return view('ai.consts');
	}


	public function show($id){
		$data=Constant::find($id);
        // $categories=Category::orderBy('id','DESC')->get();
		return response()->json($data);
	}
	public function destroy($data){
        // Product::find($id);

		$data=Constant::find($id)->delete();
		return response()->json($data);
	}

	public function store(Request $request) {
		$data=$request->all();

		$respon=Constant::find(1)->update($data);

		return $respon;

	}
	public function update(Request $request, $id) {
		$data=$request->only(['name', 'parent_id']);
		// return $data;
		$data['slug']=Str::slug($request->name, '-').time();
		$respon=Constant::find($id)->update($data);
		return $respon;
	}
}
