@extends('Layout.app')
@section('content');
<button id="AddNewDataCoursesId" class="btn btn-sm btn-danger my-3">Add New</button>
<div class="container d-none" id="mainDivCourse">
<div class="row">
<div class="col-md-12 p-3">
<table  class="table table-striped table-bordered" id="CourseTblId" cellspacing="0" width="100%">
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
        <h5 id="CourseDeleteId" class="mt-4 d-none">   </h5>
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
    <div class="modal-header ">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      
      <h5 id="courseEditId" class="mt-4 d-none ">  </h5>

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
	//for Course table
	  function getCourseData(){
	axios.get('/getCourseData')
	.then(function(response){
		if(response.status==200){
			$('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
			$('#CourseTblId').DataTable().destroy();
			 $('#course_table').empty();
			var jsonData=response.data;
			//alert(jsonData[0].total_class+jsonData[0].id)
		 	 $.each(jsonData, function(i, item){
			$('<tr>').html(
			"<td>"+jsonData[i].course_name+"</td>"+
			 "<td>" + jsonData[i].course_fee + "</td>" +
			 "<td>" + jsonData[i].total_class+ "</td>" +
			 "<td>" + jsonData[i].total_enroll+ "</td>" +
			 "<td><a class='courseEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>"+
	         "<td><a class='courseDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
				).appendTo('#course_table')
			}) 
			
			//course delete btn click
			$('.courseDeleteBtn').click(function(){
					var id =$(this).data('id');
					//alert(id);
					$('#CourseDeleteId').html(id);
					$('#deleteCourseModal').modal('show');
					
				});
				//course edit btn click
				$('.courseEditBtn').click(function(){
					var id =$(this).data('id');
					//alert(id);
					$('#courseEditId').html(id);
					var id =$('#courseEditId').html();
					CourseEditDetails(id)
					$('#updateCourseModal').modal('show');
					$('#courseEditForm').removeClass('d-none');
					//$('#courseEditLoader').addClass('d-none');
					
					
				});
				$('#CourseTblId').DataTable({'order':false});
		        $('.dataTables_length').addClass('bs-select');

		}else{
			 $('#loaderDivCourse').addClass('d-none');
			 $('#worngDivCourse').removeClass('d-none');
		}
		
	})
	
	.catch(function(error){
		 $('#loaderDivCourse').addClass('d-none');
			 $('#worngDivCourse').removeClass('d-none');
	})
	
	
}

 
//course delete confirmation btn click 
$('#CourseDeleteConfirmBtn').click(function(){
	var id=$('#CourseDeleteId').html();
	//alert(id);
	CourseDelete(id);
});

//Course AddNew Btn Click
$('#AddNewDataCoursesId').click(function(){
	$('#addCourseModal').modal('show');
});
	//course AddNew saveBtn click
$('#CourseAddConfirmBtn').click(function(){
				var name = $('#CourseNameId').val();
				var description = $('#CourseDesId').val();
				var fee = $('#CourseFeeId').val();
				var enroll = $('#CourseEnrollId').val();
				var Class = $('#CourseClassId').val();
				var Link = $('#CourseLinkId').val();
				var img = $('#CourseImgId').val();
				//alert(description);
				//alert(name+description+fee+enroll+Class+Link+img);
				
				addNewCourse(name,description,fee,enroll,Class,Link,img);
});
//course update confirm btn

$('#CourseUpdateConfirmBtn').click(function() {
				var CourseID = $('#courseEditId').html();
				var course_name = $('#CourseNameUpdateId').val();
				var Course_description = $('#CourseDesUpdateId').val();
				var Course_fee = $('#CourseFeeUpdateId').val();
				var Course_enroll = $('#CourseEnrollUpdateId').val();
				var Total_Class = $('#CourseClassUpdateId').val();
				var Course_link = $('#CourseLinkUpdateId').val();
				var Course_img = $('#CourseImgUpdateId').val();
				//alert(name);
				CourseUpdate(CourseID,course_name,Course_description,Course_fee,Course_enroll,Total_Class,Course_link,Course_img);
			});
	
function addNewCourse(courseName,courseDes,courseFee,totalEnroll,totalClass,courseLink,courseImg){
	//alert(courseName+courseDes+courseFee+totalEnroll+totalClass+courseLink+courseImg)
	$('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(courseName.length==0){
		toastr.error('Course Name is Empty')
	}
	else if(courseDes.length==0){
		toastr.error('Course Description is Empty')
	}
	else if(courseFee.length==0){
		toastr.error('Course Fee is Empty')
	}
	else if(courseLink.length==0){
		toastr.error('Course Link is Empty')
	}
	else if(courseImg.length==0){
		toastr.error('Course image is Empty')
	}
	else if(totalEnroll.length==0){
		toastr.error('Total Enroll is Empty')
	}
	else if(totalClass.length==0){
		toastr.error('Total Class is Empty')
	}
	else{
		axios.post('/addNewCourses',{
		name:courseName,
		des:courseDes,
		fee:courseFee,
		Link:courseLink,
		img:courseImg,
		enroll:totalEnroll,
		Class:totalClass
	})
	.then(function(response){
		$('#CourseAddConfirmBtn').html('save');
		 if (response.data == 1){
			$("#addCourseModal").modal('hide');
                toastr.success('successfully Added')
                 getCourseData();
		 }else{
			 $('#CourseAddConfirmBtn').html('save');
			 toastr.error('Fail to Add')
                $('#addCourseModal').modal('hide');
                 getCourseData();
		 }
	})
	.catch(function(error){
		$('#CourseAddConfirmBtn').html('save');
		toastr.error('Fail  Add')
        $('#addCourseModal').modal('hide');
        getCourseData();
	})
	
	
	}
}

function CourseDelete(id){
	//alert(id);
	$('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	axios.post('/courseDelete',{'id':id})
	.then(function(response){
		$('#CourseDeleteConfirmBtn').html("Yes");
		if(response.data==1){
			$("#deleteCourseModal").modal('hide');
                toastr.success('successfully Deleted')
                 getCourseData();
		}else{
			$("#deleteCourseModal").modal('hide');
                toastr.erorr('Fail! try again')
                 getCourseData();
		}
	})
	.catch(function(error){
		$("#deleteCourseModal").modal('hide');
                toastr.erorr('Fail! try again')
                 getCourseData();
	})
	
	
};
function CourseEditDetails(id){
	//alert(id);
	axios.post('/courseDetails',{
		'id':id
	})
	.then(function(response){
		if(response.status==200){
			$('#courseEditLoader').addClass('d-none');
			 $('#courseEditWrong').addClass('d-none');
			var jsonData=response.data
			var name=(jsonData[0].course_name)
			var des=(jsonData[0].course_des)
			var fee=(jsonData[0].course_fee)
			var enroll=(jsonData[0].total_enroll)
			var Class=(jsonData[0].total_class)
			var Link=(jsonData[0].course_link)
			var img=(jsonData[0].course_img)
			$('#CourseNameUpdateId').val(name)
			$('#CourseDesUpdateId').val(des)
			$('#CourseFeeUpdateId').val(fee)
			$('#CourseEnrollUpdateId').val(enroll)
			$('#CourseClassUpdateId').val(Class)
			$('#CourseLinkUpdateId').val(Link)
			$('#CourseImgUpdateId').val(img)
		}
	})
	
	.catch(function(errror){
		 toastr.error('Details Fail')
                $('#updateCourseModal').modal('hide');
                getCourseData();
	})
}

function CourseUpdate(CourseID,course_name,Course_description,Course_fee,Course_enroll,Total_Class,Course_link,Course_img){
	$('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(course_name.length==0){
		toastr.error('Course Name is Empty')
	}
	else if(Course_description.length==0){
		toastr.error('Service Description is Empty')
	}
	else if(Course_fee.length==0){
		toastr.error('Course fee is Empty')
	}
	else if(Course_enroll.length==0){
		toastr.error('Course enroll is Empty')
	}
	else if(Total_Class.length==0){
		toastr.error('Course class is Empty')
	}
	else if(Course_link.length==0){
		toastr.error('Course link is Empty')
	}
	else if(Course_img.length==0){
		toastr.error('Course image is Empty')
	}
	else{
		axios.post('/CourseupdatateData',{
	    id: CourseID,
		name: course_name,
		des: Course_description,
		fee: Course_fee, 
		enroll: Course_enroll, 
		Class: Total_Class, 
		Link: Course_link, 
		img: Course_img, 
	})
	
	.then(function(response){
		$('#CourseUpdateConfirmBtn').html('save');
		   if (response.data == 1){
			$("#updateCourseModal").modal('hide');
                toastr.success('successfully Updated')
                getCourseData();
		 }else{
			 toastr.error('Update Fail')
                $('#updateCourseModal').modal('hide');
               getCourseData();
				} 
	})
	.catch(function(error){
		 toastr.error('Update Fail')
                $('#updateCourseModal').modal('hide');
                getCourseData();
	})
	}
	
	
}





	</script>
	
@endsection	