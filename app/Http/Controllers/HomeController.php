<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

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
        return view('welcome',);
    }
        public function contact(){
        return view('contact',);
    }
    public function category($slug){
        $category=Category::where('slug',$slug)->first();
        // return $category;
          $products = Product::where('status',1)->where('category_id',$category->id)->orderByDesc('rate')->get();
        return view('welcome',['products'=>$products]);
    }
}
