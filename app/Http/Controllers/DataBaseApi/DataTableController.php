<?php

namespace App\Http\Controllers\DataBaseApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Product;
use App\Category;
use App\User;
use App\Apartment;
use App\Rating;
use App\Constant;

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
		->editColumn('category_id', function($data){
			$category = Category::find($data['category_id']);
			return $category->name;
		})
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$dt['id'].')" href="#add-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$dt['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})

		->editColumn('image', function ($dt) {
			return'<img src="'.$dt['image'].'" class="image-product" />';

		})

		->editColumn('status', function ($dt) {
			if ($dt['status']==0) {
				return '<div class="custom-control custom-switch">
				<input type="checkbox" onchange="changeStatus('.$dt["id"].')" class="custom-control-input" id="customSwitch'.$dt["id"].')"">
				<label class="custom-control-label" for="customSwitch'.$dt["id"].')""></label>
				</div>';
			}
			return '<div class="custom-control custom-switch">
			<input type="checkbox"  onchange="changeStatus('.$dt["id"].')" class="custom-control-input" id="customSwitchonchange'.$dt["id"].')"" checked>
			<label class="custom-control-label" for="customSwit'.$dt["id"].')""></label>
			</div>';

		})
		->addColumn('providor', function ($dt) {
			$user = User::find($dt['user_id']);
			return $user->name . '-'. $user->phone;

		})
		->setRowId('dt-{{$id}}')
		->rawColumns(['action','image','status'])
		->make(true);
	}



	public function category(){
		if ($user_id==null) {
			return "authen error";
		}
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
			if ($this->data!=null) {
				return 'Main';
			}
			return $data->name;

		})
		->editColumn('status', function ($dt) {
			if ($dt['status']==0) {
				return '<div class="custom-control custom-switch">
				<input type="checkbox" onchange="changeStatus('.$dt["id"].')"  class="custom-control-input" id="customSwitch'.$dt["id"].'">
				<label class="custom-control-label" for="customSwitch'.$dt["id"].'"></label>
				</div>';
			}
			return '<div class="custom-control custom-switch">
			<input type="checkbox"  onchange="changeStatus('.$dt["id"].')" class="custom-control-input" id="customSwitch'.$dt["id"].'" checked>
			<label class="custom-control-label" for="customSwitch'.$dt["id"].'"></label>
			</div>';

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action','image','status'])
		->make(true);
	}

	public function users(){
		$data = User::select('users.*');
		// $products->user;
		return Datatables::of($data)
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$dt['id'].')" href="#add-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$dt['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})
		->addColumn('address', function ($dt) {
			$data = Apartment::find($dt['apartment_id']);

			return $dt['room']."-".$data->name;

		})
		->editColumn('role', function ($dt) {
			$html='<select class="form-control" id="apartment_id_'.$dt['id'].'" name="apartment_id" onchange="changeStatus('.$dt['id'].')">
			<option value="admin"';
			if ($dt['role']=='admin') {
				$html.=' selected ';
			};
			$html.='>admin</option>
			<option value="manager"';
			if ($dt['role']=='manager') {
				$html.=' selected ';
			};
			$html.='>manager</option>
			<option value="user"';
			if ($dt['role']=='user') {
				$html.=' selected ';
			};
			$html.='>user</option>
			<option value="blocker"';
			if ($dt['role']=='blocker') {
				$html.=' selected ';
			};
			$html.='>blocker</option>
			option
			</select>';
			return $html;
			

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action','role'])
		->make(true);
	}
	
	// check is role for data return
	protected function getByRole($data){
		if ($this->user_id!=null) {
			return $data->where('user_id', $user_id);
		}
		return $data;
	}

		public function apartments(){
		if ($this->user_id!=null) {
			return "authen error";
		}
		$data = Apartment::select('apartments.*');
		// $products->user;
		return Datatables::of($data)
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$dt['id'].')" href="#add-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$dt['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		})
		->editColumn('status', function ($dt) {
			if ($dt['status']==0) {
				return '<div class="custom-control custom-switch">
				<input type="checkbox" onchange="changeStatus('.$dt["id"].')"  class="custom-control-input" id="customSwitch'.$dt["id"].'">
				<label class="custom-control-label" for="customSwitch'.$dt["id"].'"></label>
				</div>';
			}
			return '<div class="custom-control custom-switch">
			<input type="checkbox"  onchange="changeStatus('.$dt["id"].')" class="custom-control-input" id="customSwitch'.$dt["id"].'" checked>
			<label class="custom-control-label" for="customSwitch'.$dt["id"].'"></label>
			</div>';

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action','image','status'])
		->make(true);
}
}

//  '<div class="custom-control custom-switch">
//   <label style="margin-right: 40px;">Off</label>
//   <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
//   <label class="custom-control-label" for="customSwitch1">On</label>
// </div>';