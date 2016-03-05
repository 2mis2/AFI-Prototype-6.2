<?php 

include("templates/header.html");
include("includes/mainNav.php");
set_include_path ("./classes" );
spl_autoload_register ();

?>

<!-- Following divs are bootstrap layout for forms -->
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-login">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
					
<!-- end of Form divs -->

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<!-- form header -->
<div class="panel panel-primary">
  <div class="panel-heading">
 
	<h3><img src="images/AFI_logo.jpg" class="img-rounded" alt="AFI Logo" height="100" width="150">
		Create next Meeting Details
		</h3> 
</div>
  <div class="panel-body">
    Please fill out the form below and click the 'Create Meeting' button
  </div>
</div>
<!-- end of from header -->

<!-- <p>

Description:<br />
<textarea name="meetingDescription" rows="1" cols="15">
</textarea>

</p>-->

<div class="form-group">
<label for="sel1">Meeting Description: *</label>
<input type="text" name="meetingDescription" id="meetingDescription" tabindex="1" class="form-control" placeholder="Meeting Description" required>
</div>



<!-- <p>

Date:<br />
<textarea name="meetingDate" rows="1" cols="5">
</textarea>

</p>-->

<div class="form-group">
<label for="sel1">Meeting Date: *</label>
<input type="text" name="meetingDate" id="meetingDate" tabindex="2" class="form-control" placeholder="meeting date" required>
</div>


<!-- <p>

Time:<br />
<textarea name="meetingTime" rows="1" cols="5">
</textarea>

</p>-->

<div class="form-group">
<label for="sel1">Meeting Time: *</label>
<input type="text" name="meetingTime" id="meetingTime" tabindex="3" class="form-control" placeholder="meeting time" required>
</div>


<p>

Agenda: *<br />
<textarea name="meetingAgenda" tabindex="4" class="form-control" placeholder="Agenda" required rows="5" cols="max">
</textarea>

</p>


<!-- <p>
<input type="submit" name= "addMeeting" value="Save">
</p>-->

<div class="form-group">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<input type="submit" name="addMeeting" tabindex="5" class="form-control btn btn-primary" value="Create Meeting">
											</div>
										</div>
									</div>
<label for="sel1">* Must be filled in</label>

</form>

<?php if (isset($_POST['addMeeting'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

  
  
