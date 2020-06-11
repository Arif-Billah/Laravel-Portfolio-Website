<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;
use App\ServiceModel;
use App\CourseModel;

class HomeController extends Controller{
	
	function HomeIndex(){
        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);
		$serviceData=json_decode(ServiceModel::all());
		
		$CourseData=json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
		
		
		return view('Home',[
		'serviceData'=>$serviceData,
		'CourseData'=>$CourseData
		
		]);
    
}
}