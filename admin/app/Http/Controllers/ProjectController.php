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
}
