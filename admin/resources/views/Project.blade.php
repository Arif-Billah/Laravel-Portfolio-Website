@extends('Layout.app')
@section('content')
<button id="AddNewProjectId" class="btn btn-sm btn-danger my-3">Add New</button>

<div class="container d-none" id='mainDiv'>
<div class="row">
<div class="col-md-12 p-5">
<table id="Projecttableid" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='project_table'>
  
	
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

<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body text-center">
       <h4 class='mt-4'>Do you want to Delete?</h4>
       <h4 class='mt-4 d-none' id="ProjectDeleteID"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='ProjectDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       
      <div class="modal-body text-center p-5">
       <h4 class='mt-4 d-none' id="ProjectEdidID"></h4>
	   <h5>Update Services</h5>
	   <img class='loading-icon m-5' id="ProjectEditLoader" src="{{asset('images/loader.svg')}}"/>
	    <h4 id="ProjectEditWrong" class='d-none'>something went wrong</h4>
		<div id="ProjectEditForm" class='w-100 d-none'>
	   <input type="text" id="projectNameID" class="form-control mb-4" placeholder="Project Name">
       <input type="text" id="projectDesID" class="form-control mb-4" placeholder="Project Description">
       <input type="text" id="projectLinkID" class="form-control mb-4" placeholder="Project Link">
       <input type="text" id="projectImgID" class="form-control mb-4" placeholder="Project Image">
	   </div>
	  
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='ProjectEditConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       
      <div class="modal-body text-center p-5">
       <h6 class='mb-4' id="">Add New Project</h6>
	    
		<div id="ProjectAddForm" class='w-100'>
		   <input type="text" id="projectNewNameID" class="form-control mb-4" placeholder="Project Name">
		   <input type="text" id="projectNewDesID" class="form-control mb-4" placeholder="Project Description">
		   <input type="text" id="projectNewLinkID" class="form-control mb-4" placeholder="Project Link">
		   <input type="text" id="projectNewImgID" class="form-control mb-4" placeholder="Project Image">
	   </div>
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id='ProjectNewAddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
		


@endsection
@section('script')
	<script type='text/javaScript'>
		
		SetProjectData()

	</script>
@endsection