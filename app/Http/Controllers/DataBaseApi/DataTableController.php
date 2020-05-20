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
use Redirect;
class DataTableController extends Controller
{

			// $arrRole=['admin','manage','providor','user','blocker'];

	public function __construct() {
		$this->middleware('manage');

	}
	public function users(){
		$data = User::select('users.*');
		if (Auth::user()->role=="manage") {
			$data=$data->where("apartment_id",Auth::user()->apartment_id)->where('role','<>','admin')->where('role','<>','providor')->where('role','<>','manage')->get();
		}
		if (Auth::user()->role=="providor"||Auth::user()->role=="user") {
			Auth::logout();
			return response()->json(['errors' => ['permission' => ['do not have permission.']]], 500);

		}
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
			$arrRole=['admin','manage','providor','user','blocker'];
			if (Auth::user()->role=="manage") {
				$arrRole=['user','blocker'];
			}
			$html='<select class="form-control" id="role_'.$dt['id'].'" onchange="changeStatus('.$dt['id'].')">';
			foreach ($arrRole as $role) {
				if ($dt['role']==$role) {
					$html.= '<option value="'.$role.'" selected>'.$role.'</option>';
				}else {

					$html.= '<option value="'.$role.'">'.$role.'</option>';
				}
			}

			$html.='</select>';
			return $html;

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action','status','role'])
		->make(true);
	}
	

	public function product(){
		$products = Product::select('products.*');
		if (Auth::user()->role=="manage") {
			Auth::logout();
			return response()->json(['errors' => ['permission' => ['do not have permission.']]], 500);
		}
		if (Auth::user()->role=="providor") {
			$products=$products->where("user_id",Auth::id());
		}
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
		if (Auth::user()->role!="admin") {
			Auth::logout();
			return response()->json(['errors' => ['permission' => ['do not have permission.']]], 500);

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
			if ($data==null) {
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

	
	// check is role for data return
	
}

//  '<div class="custom-control custom-switch">
//   <label style="margin-right: 40px;">Off</label>
//   <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
//   <label class="custom-control-label" for="customSwitch1">On</label>
// </div>';
