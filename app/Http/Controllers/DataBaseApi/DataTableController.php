<?php

namespace App\Http\Controllers\DataBaseApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Product;

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
		return Datatables::of($products)
		->addColumn('action', function ($product) {
			return'
			<button type="button" class="btn btn-xs btn-info" data-toggle="modal" href="#showProduct"><i class="fa fa-eye" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$product['id'].')" href="#edit-modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$product['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})
		->editColumn('image', function ($product) {
			return'<img src="'.$product['image'].'" class="image-product" />';

		})
		->addColumn('providor', function ($product) {
			return'
			<button type="button" class="btn btn-xs btn-info" data-toggle="modal" href="#showProduct"><i class="fa fa-eye" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$product['id'].')" href="#edit-modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$product['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})
		->setRowId('product-{{$id}}')
		->rawColumns(['action','image'])
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
