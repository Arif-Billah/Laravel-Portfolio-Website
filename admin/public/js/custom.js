  function getCourseData(){
	axios.get('/getCourseData')
	.then(function(response){
		if(response.status==200){
			$('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
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
					$('#courseEditLoader').addClass('d-none');
					
					
				});
				

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
$(AddNewDataCoursesId).click(function(){
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
			//$('#courseEditLoader').addClass('d-none');
			 //$('#editForm').removeClass('d-none');
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
		
	})
}




