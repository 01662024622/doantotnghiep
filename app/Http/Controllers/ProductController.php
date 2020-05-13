<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
class ProductController extends Controller
{
	protected $user_id=null;
	function __construct() {
		$this->middleware('auth');
		if (Auth::check()) {
			if (!Auth::user()->hasRole('admin')) {
				$this->user_id=Auth::id();
			}
		}

	}

	public function index(){
		$categories= Category::get();
		return view('products.index',['categories'=>$categories]);
	}


	public function show($id){
		$product=Product::find($id);
        // $categories=Category::orderBy('id','DESC')->get();
		$product['images']=Gallary_image::where('product_id',$id)->get();
		return response()->json($product);
	}
	public function destroy($id){
        // Product::find($id);

		$data=Product::find($id)->delete();
		return response()->json($data);
	}

	public function store(ProductRequest $request) {
		$data=$request->only(['name', 'description']);
		$data['user_id']=Auth::id();
		$data['slug']=Str::slug($data['name'], '-').time();

		$image=$request->only(['image']);

		$imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);
        $data['image']='/images/'.$imageName;
		$product=Product::create($data);

		return $product;

	}
	public function updateProduct(ProductUpdateRequest $request) {
		$data=$request->only(['quantity','name','description','content','sale_cost','origin_cost','category_id','user_id',]);
		if ($data['user_id']) {
			unset($data['user_id']);
		}
		$id=$request->only(['id']);
		$data['slug']=str_slug($data['name']).time();
		$boolean=Product::where('id',$id)->update($data);
		if ($boolean) {
			return Product::find($id)->first();
		}else{
			return response()->json(['error'=>'500']);
		}
		if (!isempty($request['images'])) {
            # code...
			foreach ($request['images'] as $key => $image) {
				$imageName= request()->getHttpHost().'/images/product/'.time().$key.'.'.$image->getClientOriginalExtension();

				$image->move(public_path('images/product'), $imageName);
				$gallary['link']=$imageName;
				$gallary['product_id']=$product['id'];
				$data=Gallary_image::create($gallary);
			}
		}
		$boolean=Post::find($id)->first()->update($data);
		if ($boolean) {
			return Post::find($id)->first();
		}else{
			return response()->json(['error'=>'500']);
		}
	}
	public function getReason($id){
		$post=Post::where('id',$id)->first();
		return $post;
	}
	public function manageUser($slug){

		$products= Product::where('slug',$slug)->first();

	}
}
