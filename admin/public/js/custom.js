		//for project table
function SetProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) 
			{
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
				$('#Projecttableid').DataTable().destroy();
                $('#project_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item){
                    $('<tr>').html(
                        "<td>" + jsonData[i].project_name+ "</td>" +
                        "<td>" + jsonData[i].project_des + "</td>" +
                        "<td><a class='ProjectEdititBtn' data-id="+ jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ProjectDeleteBtn' data-id=" + jsonData[i].id +"><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#project_table');
                });
                
				//projects table Delete Icon click
				$('.ProjectDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectDeleteID').html(id);
					
                    $("#deleteProjectModal").modal('show');
                });
				//projects table edit Icon click
				$('.ProjectEdititBtn').click(function(){
					var id=$(this).data('id');
					$('#ProjectEdidID').html(id);
					var id = $('#ProjectEdidID').html();
				//alert(id);
				    ProjectUpdateDetails(id);
					$("#EditProjectModal").modal('show');
				});
				$('#Projecttableid').DataTable({"order":false});
		        $('.dataTables_length').addClass('bs-select');
            } else {
                //$('#loaderDiv').addClass('d-none');
                //$('#worngDiv').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#worngDiv').removeClass('d-none');
        });
}

//project AddNew Btn Click
$('#AddNewProjectId').click(function(){
	$('#addNewProjectModal').modal('show');
});

   //projects delete Model yes BTN
$('#ProjectDeleteConfirmBtn').click(function() {
                    var id = $('#ProjectDeleteID').html();
                    //alert(id);
                    ProjectDelete(id);
                });
	//project EditModal save btn
 $('#ProjectEditConfirmBtn').click(function() {
			 var id    = $('#ProjectEdidID').html();
	         var name  = $('#projectNameID').val();
			 var des   = $('#projectDesID').val();
			 var Link  = $('#projectLinkID').val();
			 var img   = $('#projectImgID').val();
				//alert(name);
				ProjectUpdate(id,name,des,Link,img);
			});
	//new project Add btn save  
$('#ProjectNewAddConfirmBtn').click(function(){
				var name = $('#projectNewNameID').val();
				//alert(name);
				var description = $('#projectNewDesID').val();
				var Link = $('#projectNewLinkID').val();
				var img = $('#projectNewImgID').val();
				//alert(description);
				//alert(img);
				
				addNewProject(name,description,Link,img);
});			
//project Delete
function ProjectDelete(deleteID) {
    //alert(deleteID);
	$('#ProjectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/ProjectDelete', {
            id: deleteID
        })
        .then(function(response) {
			$('#ProjectDeleteConfirmBtn').html('Yes');
            if (response.data == 1) {
                //alert('success'); 
                $('#deleteProjectModal').modal('hide');
                toastr.success('successfully Deleted')
                SetProjectData()
            } else {
				 toastr.error('Delete Fail')
                $('#deleteProjectModal').modal('hide');
                 SetProjectData();
            }


        })
        .catch(function(error){
			toastr.error('Delete Fail')
                $('#deleteProjectModal').modal('hide');
                 SetProjectData();
        });

}
//project Details
function ProjectUpdateDetails(DetailsId){
	//alert(updateId)
	
	axios.post('/ProjectDetails',{ 
		id:DetailsId 
		})
	 .then(function(response){
		 if (response.status== 200) {
			 $('#ProjectEditLoader').addClass('d-none');
			 $('#ProjectEditForm').removeClass('d-none');
			  var jsonData=response.data;
			   //alert (jsonData);
			  $('#projectNameID').val(jsonData[0].project_name);
			 $('#projectDesID').val(jsonData[0].project_des);
			 $('#projectLinkID').val(jsonData[0].project_link);
			 $('#projectImgID').val(jsonData[0].project_img);
		 }else{
			 $('#ProjectEditLoader').addClass('d-none'); 
			 $('#ProjectEditWrong').removeClass('d-none'); 
		 }
			 
	 })
	.catch(function(error){
	$('#ProjectEditLoader').addClass('d-none'); 
	$('#ProjectEditWrong').removeClass('d-none'); 
	});
}
//project Update
function ProjectUpdate(updateID,name,description,Link,img){
	$('#ProjectEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(name.length==0){
		toastr.error('Project Name is Empty')
	}
	else if(description.length==0){
		toastr.error('Project Description is Empty')
	}
	else if(description.Link==0){
		toastr.error('Project link is Empty')
	}
	else if(img.length==0){
		toastr.error('Project image is Empty')
	}
	else{
		axios.post('/ProjectUpdate',{
	    id: updateID,
		name: name,
		des: description,
		Link: Link,
		img: img, 
	})
	
	.then(function(response){
		$('#ProjectEditConfirmBtn').html('save');
		   if (response.data == 1){
			$("#EditProjectModal").modal('hide');
                toastr.success('successfully Updated')
               SetProjectData()
		 }else{
			 toastr.error('Update Fail')
                $('#EditProjectModal').modal('hide');
               SetProjectData()
				} 
	})
	.catch(function(error){
		 toastr.error('Update Fail')
                $('#EditProjectModal').modal('hide');
                SetProjectData()
	})
	}
	
	
}
function addNewProject(ProjectName,ProjectDes,ProjectLink,ProjectImg){
	$('#ProjectNewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(ProjectName.length==0){
		toastr.error('Project Name is Empty')
	}
	else if(ProjectDes.length==0){
		toastr.error('Project Description is Empty')
	}
	else if(ProjectLink.length==0){
		toastr.error('Project link is Empty')
	}
	else if(ProjectImg.length==0){
		toastr.error('Project image is Empty')
	}
	else{
	axios.post('/addNewProject',{
		name:ProjectName,
		des:ProjectDes,
		Link:ProjectLink,
		img:ProjectImg
	})
	.then(function(response){
		$('#ProjectNewAddConfirmBtn').html('save');
		alert(response.data);
		 if (response.data == 1){
			$("#addNewProjectModal").modal('hide');
                toastr.success('successfully Added')
                SetProjectData()
		 }else{
			 toastr.error('Fail to Add')
                $('#addNewProjectModal').modal('hide');
                SetProjectData()
		 }
	})
	.catch(function(error){
		toastr.error('Fail to Add')
                $('#addNewProjectModal').modal('hide');
                SetProjectData()
	})
	}	
	
}