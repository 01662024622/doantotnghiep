<?php

namespace App\Http\Controllers\DataBaseApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Product;
use App\Category;
use App\User;

class DataTableController extends Controller
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

	public function product(){
		$products = $this->getByRole(Product::select('products.*'));
		// $products->user;
		return Datatables::of($products)
		->addColumn('action', function ($product) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$product['id'].')" href="#edit-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$product['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})

		->editColumn('image', function ($product) {
			return'<img src="'.$product['image'].'" class="image-product" />';

		})

		->editColumn('status', function ($product) {
			if ($product['status']==0) {
				return '<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="customSwitch1">
				<label class="custom-control-label" for="customSwitch1"></label>
				</div>';
			}
			return '<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
			<label class="custom-control-label" for="customSwitch1"></label>
			</div>';

		})
		->addColumn('providor', function ($product) {
			$user = User::find($product['user_id']);
			return $user->name . '-'. $user->phone;

		})
		->setRowId('product-{{$id}}')
		->rawColumns(['action','image','status'])
		->make(true);
	}



	public function category(){
		$data = Category::select('categories.*');
		// $products->user;
		return Datatables::of($data)
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$dt['id'].')" href="#edit-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$dt['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})
		->addColumn('parent_id', function ($dt) {
			$data = Category::find($dt['parent_id']);
			if ($data==null) {
				return 'Main';
			}
			return $data->name;

		})
		->editColumn('status', function ($dt) {
			if ($dt['status']==0) {
				return '<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="customSwitch1">
				<label class="custom-control-label" for="customSwitch1"></label>
				</div>';
			}
			return '<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
			<label class="custom-control-label" for="customSwitch1"></label>
			</div>';

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action','image','status'])
		->make(true);
	}

	// check is role for data return
	protected function getByRole($data){
		if ($this->user_id!=null) {
			return $data->where('user_id', $user_id);
		}
		return $data;
	}
}

//  '<div class="custom-control custom-switch">
//   <label style="margin-right: 40px;">Off</label>
//   <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
//   <label class="custom-control-label" for="customSwitch1">On</label>
// </div>';
