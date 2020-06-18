<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;

class ProjectController extends Controller{
    function ProjectIndex(){
		return view('Project');
	}
	function getProjectData(){
		 $result=json_encode(ProjectModel::orderBy('id','desc')->get());
	  return $result;
	}
	
	function ProjectDetails(Request $req){
	  $id=$req->input('id');
	  $result=json_encode(ProjectModel::where('id','=',$id)->get());
	  return $result; 
  }
  
  function ProjectDelete(Request $req){
	  $id=$req->input('id');
	$result=ProjectModel::where('id','=',$id)->delete();
	if($result==true){
		return 1;
	}else{
		return 0;
	}
  }
  
  function ProjectUpdate(Request $request){
	$id=$request->input('id');
	$name=$request->input('name');
	$des=$request->input('des');
	$Link=$request->input('Link');
	$img=$request->input('img');

	 $result=ProjectModel::where('id','=',$id)->update([
		'project_name'=>$name,
		'project_des'=>$des,
		'project_link'=>$Link,
		'project_img'=>$img
	
	]);
	if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}

function addNewProject(Request $request){
	$name=$request->input('name');
	
	$des=$request->input('des');
	$Link=$request->input('Link');
	$img=$request->input('img');
	$result=ProjectModel::insert([
	
		'project_name'=>$name,
		'project_des'=>$des,
		'project_link'=>$Link,
		'project_img'=>$img
	
	]);
	if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}
}
