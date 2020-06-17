<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceModel;

class ServiceController extends Controller{
  function ServiceIndex(){
	  return view('Services');
  } 
  function getServicesData(){
	  $result=json_encode(ServiceModel::orderBy('id','desc')->get());
	  return $result;
  }
  
  function ServiceDelete(Request $req){
	 
	  $id=$req->input('id');
	  //return(id);
	  $result=ServiceModel::where('id','=',$id)->delete();
	   if($result==true){
		   return 1;
	   }else{
		   return 0;
	   } 
  }
  function getServiceDetails(Request $req){
	  $id=$req->input('id');
	  $result=json_encode(ServiceModel::where('id','=',$id)->get());
	  return $result; 
  }
   function getServiceUpdate(Request $req){

	   $id=$req->input('id');
	  $name=$req->input('name');
	  $des=$req->input('des');
	  $img=$req->input('img');
	  $result=ServiceModel::where('id','=',$id)->update([
		'service_name'=>$name,
		'service_des'=>$des,
		'service_img'=>$img
	  ]);
	  if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}
function addNewServices(Request $request){
	$name=$request->input('name');
	$des=$request->input('des');
	$img=$request->input('img');
	$result=ServiceModel::insert([
		'service_name'=>$name,
		'service_des'=>$des,
		'service_img'=>$img
	
	]);
	if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}
}
