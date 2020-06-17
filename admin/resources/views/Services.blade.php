@extends('Layout.app')
@section('content')
<button id="AddNewDataId" class="btn btn-sm btn-danger my-3">Add New</button>

<div class="container d-none" id='mainDiv'>
<div class="row">
<div class="col-md-12 p-5">
<table id="servicetableid" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='service_table'>
  
	
  </tbody>
</table>

</div>
</div>
</div>

<div class="container" id='loaderDiv'>
<div class="row">
<div class="col-md-12 p-5">
<img class='loading-icon m-5' src="{{asset('images/loader.svg')}}"/>

</div>
</div>
</div>

<div class="container d-none" id="worngDiv">
<div class="row">
<div class="col-md-12 p-5 text-center">
<h4>something went wrong</h4>

</div>
</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center">
       <h4 class='mt-4'>Do you want to Delete?</h4>
       <h4 class='mt-4 d-none' id="serviceDeleteID"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='serviceDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       
      <div class="modal-body text-center p-5">
       <h4 class='mt-4 d-none' id="serviceEdidID"></h4>
	   <h5>Update Services</h5>
	   <img class='loading-icon m-5' id="serviceEditLoader" src="{{asset('images/loader.svg')}}"/>
	    <h4 id="serviceEditWrong" class='d-none'>something went wrong</h4>
		<div id="serviceEditForm" class='w-100 d-none'>
	   <input type="text" id="serviceNameID" class="form-control mb-4" placeholder="Service Name">
       <input type="text" id="serviceDesID" class="form-control mb-4" placeholder="Service Description">
       <input type="text" id="serviceImgID" class="form-control mb-4" placeholder="Service Image">
	   </div>
	  
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='serviceAddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       
      <div class="modal-body text-center p-5">
       <h6 class='mb-4' id="">Add New Service</h6>
	    
		<div id="serviceAddForm" class='w-100'>
	   <input type="text" id="serviceNameId" class="form-control mb-4" placeholder="Service Name">
       <input type="text" id="serviceDesId" class="form-control mb-4" placeholder="Service Description">
       <input type="text" id="serviceImgId" class="form-control mb-4" placeholder="Service Image">
	   </div>
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='serviceNewAddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
		


@endsection
@section('script')
	<script type='text/javaScript'>
		$('#servicetableid').DataTable();
		$('.dataTables_length').addClass('bs-select');
		setServiceData()
		//for services table
function setServiceData() {
    axios.get('/getServiceData')
        .then(function(response) {
            if (response.status == 200) 
			{
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
				$('#servicetableid').DataTable().destroy();
                $('#service_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item){
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='servicAddBtn' data-id="+ jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id +"><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table');
                });
                
				//Services table Delete Icon click
				$('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteID').html(id);
					
                    $("#deleteModal").modal('show');
                });
				//Services table edit Icon click
				$('.servicAddBtn').click(function(){
					var id=$(this).data('id');
					$('#serviceEdidID').html(id);
					var id = $('#serviceEdidID').html();
				//alert(id);
				    ServiceUpdateDetails(id);
					$("#addModal").modal('show');
				});
				$('#servicetableid').DataTable();
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
function ServiceUpdateDetails(DetailsId){
	//alert(updateId)
	
	axios.post('/ServiceDetails',{ 
		id:DetailsId 
		})
	 .then(function(response){
		 if (response.status== 200) {
			 $('#serviceEditLoader').addClass('d-none');
			 $('#serviceEditForm').removeClass('d-none');
			  var jsonData=response.data;
			   //alert (jsonData);
			  $('#serviceNameID').val(jsonData[0].service_name);
			 $('#serviceDesID').val(jsonData[0].service_des);
			 $('#serviceImgID').val(jsonData[0].service_img);
			 
		 }else{
			 $('#serviceEditLoader').addClass('d-none'); 
			 $('#serviceEditWrong').removeClass('d-none'); 
		 }
			 
	 })
	.catch(function(error){
	$('#serviceEditLoader').addClass('d-none'); 
			 $('#serviceEditWrong').removeClass('d-none'); 
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
	</script>
@endsection