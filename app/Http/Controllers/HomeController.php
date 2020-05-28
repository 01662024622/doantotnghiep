<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\StaffProduct;
use App\StaffOrder;
use App\Order;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('ai.chart');
    }
    public function home(){
      $products = Product::where('status',1)->orderByDesc('rate')->get();
      return view('welcome',['products'=>$products]);
    }
    public function infor(){
        return view('infor');
    }
    public function contact(){
    return view('contact');
    }
    public function category($slug){
        $category=Category::where('slug',$slug)->first();
        $products = Product::where('status',1)->where('category_id',$category->id)->orderByDesc('rate')->get();
        return view('welcome',['products'=>$products]);
    }
    public function product($slug){
        $product=Product::where('slug',$slug)->first();
        $staffs= StaffProduct::where('product_id',$product->id)->join('staffs', 'staffs.id', '=', 'staff_product.staff_id')->get();

        return view('product',['product'=>$product,'staffs'=>$staffs]);
    }
    public function oderProduct(Request $request, $id){
        $data = $request->only(['staffs']);
        $order['product_id']=$id;
        $order['user_id']=Auth::id();
        $order['note']=$request->note;
        $orders=Order::create($order);
        foreach ($data['staffs'] as $value) {
            $detail['order_id']=$orders->id;
            $detail['staff_id']=$value;
            StaffOrder::create($detail);
        }
        

        return 'true';
    }

}