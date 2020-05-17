<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Product;
use App\Category;
use App\User;
use App\Rating;
use App\Constant;

class DataBaseApiChart extends Controller
{
	public function average(){
		$arrs=['demeanor','responsiveness','competence','tangible','completeness','relevancy','accuracy','currency','training_provider','user_understanding','participation','easier_to_the_job','increase_productivity'];
		$respon=[];
		for ($i = 0; $i < count($arrs); $i++) {
			array_push($respon, Rating::avg($arrs[$i])*2);
		}
		return $respon;
	}
	public function average2(){
		$arrs=['demeanor','responsiveness','competence','tangible','completeness','relevancy','accuracy','currency','training_provider','user_understanding','participation','easier_to_the_job','increase_productivity'];
		$rate=[];
		$con=[];
		for ($i = 0; $i < count($arrs); $i++) {
			$rate[$arrs[$i]]= Rating::avg($arrs[$i])/4;
		}
		for ($i = 0; $i < count($arrs); $i++) {
			$con[$arrs[$i]]= 100-Constant::avg($arrs[$i]);
		}
		$sevqual=['demeanor','responsiveness','competence','tangible'];
		$infoqual=['completeness','relevancy','accuracy','currency'];
		$userarr=['training_provider','user_understanding','participation'];
		$benefit=['easier_to_the_job','increase_productivity'];

		$sumSevqual=0;
		$sumSevqualCont=0;
		$sumUser=0;
		$sumUserCont=0;
		$sumInfoqual=0;
		$sumInfoqualCont=0;
		$sumBenefit=0;
		$sumBenefitCont=0;
		for ($i = 0; $i < count($sevqual); $i++) {
			$sumSevqual=+$rate[$sevqual[$i]];
			$sumSevqualCont=+$con[$sevqual[$i]];
		}
		for ($i = 0; $i < count($userarr); $i++) {
			$sumUser=+$rate[$userarr[$i]];
			$sumUserCont=+$con[$userarr[$i]];
		}
		for ($i = 0; $i < count($infoqual); $i++) {
			$sumInfoqual=+$rate[$infoqual[$i]];
			$sumInfoqualCont=+$con[$infoqual[$i]];
		}
		for ($i = 0; $i < count($benefit); $i++) {
			$sumBenefit=+$rate[$benefit[$i]];
			$sumBenefitCont=+$con[$benefit[$i]];
		}
		$sev=($sumSevqual*$sumSevqual)/(($sumSevqual*$sumSevqual)+($sumSevqualCont/1300));
		$inf=($sumInfoqual*$sumInfoqual)/(($sumInfoqual*$sumInfoqual)+($sumInfoqualCont/1300));
		$user=($sumUser*$sumUser)/(($sumUser*$sumUser)+($sumSevqualCont/1300));
		$ben=($sumBenefit*$sumBenefit)/(($sumBenefit*$sumBenefit)+($sumBenefitCont/1300));
		$respon['reliability']=[$sev*10,$inf*10,$user*10,$ben*10];
		// $respon['reliability']=[$sev*10,$inf*10,$user*10,$ben*10];

		for ($i = 0; $i < count($sevqual); $i++) {
			$sumSevqual=+($rate[$sevqual[$i]]*$rate[$sevqual[$i]]);
			$sumSevqualCont=+($con[$sevqual[$i]]*$con[$sevqual[$i]]);
		}
		for ($i = 0; $i < count($userarr); $i++) {
			$sumUser=+($rate[$userarr[$i]]*$rate[$userarr[$i]]);
			$sumUserCont=+($con[$userarr[$i]]*$con[$userarr[$i]]);
		}
		for ($i = 0; $i < count($infoqual); $i++) {
			$sumInfoqual=+($rate[$infoqual[$i]]*$rate[$infoqual[$i]]);
			$sumInfoqualCont=+($con[$infoqual[$i]]*$con[$infoqual[$i]]);
		}
		for ($i = 0; $i < count($benefit); $i++) {
			$sumBenefit=+($rate[$benefit[$i]]*$rate[$benefit[$i]]);
			$sumBenefitCont=+($con[$benefit[$i]]*$con[$benefit[$i]]);
		}
		$sev=$sumSevqual/($sumSevqual+($sumSevqualCont/1300));
		$inf=$sumInfoqual/($sumInfoqual+($sumInfoqualCont/1300));
		$user=$sumUser/($sumUser+($sumSevqualCont/1300));
		$ben=$sumBenefit/($sumBenefit+($sumBenefitCont/1300));
		$respon['extracted']=[$sev*10,$inf*10,$user*10,$ben*10];
		return $respon;
	}

}
