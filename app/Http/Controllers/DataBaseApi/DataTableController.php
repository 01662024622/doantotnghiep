<?php

namespace App\Http\Controllers\DataBaseApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Product;
use App\Category;
use App\User;
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
	public function rating(){
		$arrs=['demeanor','responsiveness','competence','tangible','completeness','relevancy','accuracy','currency','training_provider','user_understanding','participation','easier_to_the_job','increase_productivity'];
		$data = Rating::select('rate.*');
		// $products->user;
		$db=Datatables::of($data)
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-danger" onclick="alDelete('.$dt['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
			';

		});
		// foreach ($arrs as $value) {
		$db=$db->editColumn('demeanor', function ($dt) {
			switch ($dt['demeanor']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('responsiveness', function ($dt) {
			switch ($dt['responsiveness']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('competence', function ($dt) {
			switch ($dt['competence']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('tangible', function ($dt) {
			switch ($dt['tangible']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('completeness', function ($dt) {
			switch ($dt['completeness']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})

		->editColumn('relevancy', function ($dt) {
			switch ($dt['relevancy']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('accuracy', function ($dt) {
			switch ($dt['accuracy']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('currency', function ($dt) {
			switch ($dt['currency']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('training_provider', function ($dt) {
			switch ($dt['training_provider']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('user_understanding', function ($dt) {
			switch ($dt['user_understanding']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('participation', function ($dt) {
			switch ($dt['participation']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('easier_to_the_job', function ($dt) {
			switch ($dt['easier_to_the_job']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		})
		->editColumn('increase_productivity', function ($dt) {
			switch ($dt['increase_productivity']) {
				case 1: return 'Extremely Dissatisfied';
				break;
				case 2: return 'Unsatisfied';
				break;
				case 3: return 'Medium';
				break;
				case 4: return 'Satisfied';
				break;
				default:
				return 'Very Satisfied';
			}

		});

		// }

		return $db->setRowId('data-{{$id}}')
		->rawColumns(['action'])
		->make(true);
	}


	public function consts(){
		$data = Constant::select('consts.*');
		// $products->user;
		return Datatables::of($data)
		->addColumn('action', function ($dt) {
			return'
			<button type="button" class="btn btn-xs btn-warning"data-toggle="modal" onclick="getInfo('.$dt['id'].')" href="#edit-modal"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';

		})
		->setRowId('data-{{$id}}')
		->rawColumns(['action'])
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
