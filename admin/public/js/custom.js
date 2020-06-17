		//for services table
function setProjectData() {
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
                        "<td><img class='table-img' src=" + jsonData[i].project_name+ "></td>" +
                        "<td>" + jsonData[i].project_des + "</td>" +
                        "<td><a class='ProjectAdditBtn' data-id="+ jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ProjectDeleteBtn' data-id=" + jsonData[i].id +"><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#project_table');
                });
                
				//Services table Delete Icon click
				$('.ProjectDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectDeleteID').html(id);
					
                    $("#deleteProjectModal").modal('show');
                });
				//Services table edit Icon click
				$('.ProjectAdditBtn').click(function(){
					var id=$(this).data('id');
					$('#ProjectEdidID').html(id);
					var id = $('#ProjectEdidID').html();
				//alert(id);
				    ProjectUpdateDetails(id);
					$("#EditProjectModal").modal('show');
				});
				$('#Projecttableid').DataTable();
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

//service AddNew Btn Click
$('#AddNewDataId').click(function(){
	$('#addNewModal').modal('show');
});

   //services delete Model yes BTN
$('#serviceDeleteConfirmBtn').click(function() {
                    var id = $('#serviceDeleteID').html();
                    //alert(id);
                    ServiceDelete(id);
                });
	//service addModal save btn
 $('#serviceAddConfirmBtn').click(function() {
				var id = $('#serviceEdidID').html();
				var name = $('#serviceNameID').val();
				var description = $('#serviceDesID').val();
				var img = $('#serviceImgID').val();
				//alert(name);
				ServiceUpdate(id,name,description,img);
			});
	//new service Add btn save
$('#serviceNewAddConfirmBtn').click(function(){
				var name = $('#serviceNameId').val();
				var description = $('#serviceDesId').val();
				var img = $('#serviceImgId').val();
				//alert(description);
				//alert(img);
				
				addNewService(name,description,img);
});			
//Service Delete
function ServiceDelete(deleteID) {
    //alert(deleteID);
	$('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {
			$('#serviceDeleteConfirmBtn').html('Yes');
            if (response.data == 1) {
                //alert('success'); 
                $('#deleteModal').modal('hide');
                toastr.success('successfully Deleted')
                setServiceData();
            } else {
				 toastr.error('Delete Fail')
                $('#deleteModal').modal('hide');
                setServiceData();
            }


        })
        .catch(function(error){
			toastr.error('Delete Fail')
			$('#deleteModal').modal('hide');
			setServiceData();
        });

}
//service Details
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
//service Update
function ServiceUpdate(updateID,name,description,img){
	$('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(name.length==0){
		toastr.error('Service Name is Empty')
	}
	else if(description.length==0){
		toastr.error('Service Description is Empty')
	}
	else if(img.length==0){
		toastr.error('Service image is Empty')
	}
	else{
		axios.post('/updatateData',{
	    id: updateID,
		name: name,
		des: description,
		img: img, 
	})
	
	.then(function(response){
		$('#serviceAddConfirmBtn').html('save');
		   if (response.data == 1){
			$("#addModal").modal('hide');
                toastr.success('successfully Updated')
                setServiceData();
		 }else{
			 toastr.error('Update Fail')
                $('#addModal').modal('hide');
                setServiceData();
				} 
	})
	.catch(function(error){
		 toastr.error('Update Fail')
                $('#addModal').modal('hide');
                setServiceData();
	})
	}
	
	
}
function addNewService(serviceName,serviceDes,serviceImg){
	$('#serviceNewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
	if(serviceName.length==0){
		toastr.error('Service Name is Empty')
	}
	else if(serviceDes.length==0){
		toastr.error('Service Description is Empty')
	}
	else if(serviceImg.length==0){
		toastr.error('Service image is Empty')
	}
	else{
	axios.post('/addNewServices',{
		name:serviceName,
		des:serviceDes,
		img:serviceImg,
	})
	.then(function(response){
		$('#serviceNewAddConfirmBtn').html('save');
		 if (response.data == 1){
			$("#addNewModal").modal('hide');
                toastr.success('successfully Added')
                setServiceData();
		 }else{
			 toastr.error('Fail to Add')
                $('#addNewModal').modal('hide');
                setServiceData();
		 }
	})
	.catch(function(error){
		toastr.error('Fail to Add')
                $('#addNewModal').modal('hide');
                setServiceData();
	})
	}	
	
}