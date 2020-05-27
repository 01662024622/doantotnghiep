<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Staff;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
class StaffController extends Controller
{
	function __construct() {
		$this->middleware('providor');
	}

	public function index(){
		return view('staff.index');
	}


	public function show($id){
		$product=Staff::find($id);
        // $categories=Category::orderBy('id','DESC')->get();
		return response()->json($product);
	}
	public function destroy($id){
        // Product::find($id);

		$data=Staff::find($id)->delete();
		return response()->json($data);
	}

	public function store(Request $request) {
		$data=$request->only(['name','phone','email','address']);
		$data['user_id']=Auth::id();

		if ($request->has('image')) {
			$imageName = time().'.'.$request->image->extension();  

			$request->image->move(public_path('staffs'), $imageName);
			$data['image']='/staffs/'.$imageName;
		}

		if ($request->has('id')) {
			$product=Staff::find($request->id)->update($data);

			return $product;
		}
		$product=Staff::create($data);

		return $product;

	}
	
	
}
