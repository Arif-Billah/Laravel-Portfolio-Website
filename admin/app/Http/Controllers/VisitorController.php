<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;
class VisitorController extends Controller{
     function VisitorIndex(){
		 $visitData=json_decode(VisitorModel::all());
		 //print_r($visitData);
		return view('Visitor',['visitData'=>$visitData]);
		//return view('Visitor',['name'=>'arif']);
	}
}
