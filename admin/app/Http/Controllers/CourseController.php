<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;
class CourseController extends Controller{
	
	function CoursesIndex(){
		return view('Course');
		
		
	}
	 function getCourseData(){
		 $result=json_decode(CourseModel::select('course_name','course_fee','total_class','total_enroll','id')->orderBy('id','desc')->get());
	     return $result;
	 }
	 
	function CourseupdatateData(Request $request){
	$id=$request->input('id');
	$name=$request->input('name');
	$des=$request->input('des');
	$fee=$request->input('fee');
	$Link=$request->input('Link');
	$img=$request->input('img');
	$enroll=$request->input('enroll');
	$Class=$request->input('Class');
	 $result=CourseModel::where('id','=',$id)->update([
		'course_name'=>$name,
		'course_des'=>$des,
		'course_fee'=>$fee,
		'total_enroll'=>$enroll,
		'total_class'=>$Class,
		'course_link'=>$Link,
		'course_img'=>$img
	
	]);
	if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}
function CourseDeleted(Request $req){
	$id=$req->input('id');
	$result=CourseModel::where('id','=',$id)->delete();
	if($result==true){
		return 1;
	}else{
		return 0;
	}
}
function CourseDetail(Request $req){
	$id=$req->input('id');
	$result=CourseModel::where('id','=',$id)->get();
	return $result;
}
	function addNewCourses(Request $request){
	$name=$request->input('name');
	$des=$request->input('des');
	$fee=$request->input('fee');
	$Link=$request->input('Link');
	$img=$request->input('img');
	$enroll=$request->input('enroll');
	$Class=$request->input('Class');
	$result=CourseModel::insert([
		'course_name'=>$name,
		'course_des'=>$des,
		'course_fee'=>$fee,
		'total_enroll'=>$enroll,
		'total_class'=>$Class,
		'course_link'=>$Link,
		'course_img'=>$img
	
	]);
	if($result==true){
		   return 1;
	   }else{
		   return 0;
	   }  
}


    
}
