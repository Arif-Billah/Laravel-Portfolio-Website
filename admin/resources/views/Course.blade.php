@extends('Layout.app')
@section('content');
<button id="AddNewDataCoursesId" class="btn btn-sm btn-danger my-3">Add New</button>
<div class="container d-none" id="mainDivCourse">
<div class="row">
<div class="col-md-12 p-3">
<table  class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
     
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
  	
	
  </tbody>
</table>

</div>
</div>
</div>

<div class="container" id='loaderDivCourse'>
<div class="row">
<div class="col-md-12 p-5">
<img class='loading-icon m-5' src="{{asset('images/loader.svg')}}"/>

</div>
</div>
</div>

<div class="container d-none" id="worngDivCourse">
<div class="row">
<div class="col-md-12 p-5 text-center">
<h4>something went wrong</h4>

</div>
</div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text"  class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text"  class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text"  class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text"  class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="CourseDeleteId" class="mt-4 ">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="CourseDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      
      <h5 id="courseEditId" class="mt-4 ">  </h5>

       <div id="courseEditForm" class="container d-none">

        <div id="editForm" class="row">
          <div class="col-md-6">
          <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
          <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
          <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
          </div>
          <div class="col-md-6">
          <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
          <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
          <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
          </div>
        </div>
       </div>

          <img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h5 id="courseEditWrong" class="">Something Went Wrong !</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')
	<script type='text/javaScript'>
	getCourseData()

	</script>
	
@endsection	