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
							
<form method="post" role="form" style= "display: block;" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<!-- form header -->
<div class="panel panel-primary">
  <div class="panel-heading">
 
	<h3><img src="images/AFI_logo.jpg" class="img-rounded" alt="AFI Logo" height="100" width="150">
		Create a new Alliance Member
		</h3> (or non Alliance Member)
</div>
  <div class="panel-body">
    Please fill out the form below and click the 'Create Member' button
  </div>
</div>
<!-- end of from header -->

<!-- <p>

Member Name:<br />
<textarea name="newPartner" rows="1" cols="8">
</textarea>

</p>-->

<div class="form-group">
<label for="sel1">New Member Name: *</label>
<input type="text" name="newPartner" id="newPartner" tabindex="1" class="form-control" placeholder="Member Name" required>
</div>


<!-- <p>

Address:<br />
<textarea name="partnerAddress1" rows="1" cols="15">
</textarea>

</p> -->
<div class="form-group">
<label for="sel1">Office/Block Number: *</label>
<input type="text" name="partnerAddress1" id="partnerAddress1" tabindex="2" class="form-control" placeholder="Address 1" required>
</div>


<!--  <p>

Address 2:<br />
<textarea name="partnerAddress2" rows="1" cols="15">
</textarea>

</p> -->

<div class="form-group">
<label for="sel1">Street Name: *</label>
<input type="text" name="partnerAddress2" id="partnerAddress2" tabindex="3" class="form-control" placeholder="Address 2" required>
</div>


<!-- <p>

City:<br />
<textarea name="partnerCity" rows="1" cols="10">
</textarea>

</p>-->


<div class="form-group">
<label for="sel1">City: *</label>
<input type="text" name="partnerCity" id="partnerCity" tabindex="4" class="form-control" placeholder="City" required>
</div>


<!-- <p>

County:<br />
<textarea name="partnerCounty" rows="1" cols="10">
</textarea>

</p>-->


<div class="form-group">
<label for="sel1">County: *</label>
<input type="text" name="partnerCounty" id="partnerPhone" tabindex="5" class="form-control" placeholder="County" required>
</div>


<!-- <p>

Phone:<br />
<textarea name="partnerPhone" rows="1" cols="10">
</textarea>

</p>-->


<div class="form-group">
<label for="sel1">Phone Number: *</label>
<input type="text" name="partnerPhone" id="partnerPhone" tabindex="6" class="form-control" placeholder="Phone Number" required>
</div>


<!-- <p>
Member Type:<br />
<select id = "memberType" name="memberType" size = "1" >
	<option value = "full">Alliance Member </option>
	<option value = "non">non Alliance Member </option>
	
</select>
</p>-->

<div class="form-group">

<label for="sel1">Select a Member Type (i.e. Alliance member or non-Alliance member):*</label>

<select id = "memberType" name="memberType" tabindex="7" class="form-control">
	<option value = "full">Alliance Member </option>
	<option value = "non">non Alliance Member </option>
	
</select>

<!-- <input type="text" name="partnerPhone" id="partnerPhone" tabindex="6" class="form-control" placeholder="Phone Number" required>-->
</div>


<!-- <p>
<input type="submit" name= "addPartner" value="Save">

</p>
-->

<div class="form-group">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<input type="submit" name="addPartner" tabindex="4" class="form-control btn btn-primary" value="Create Member">
											</div>
										</div>
									</div>
<label for="sel1">* Must be filled in</label>

</form>

<!-- Following divs are close bootstrap layout for forms -->
</div>
</div>
</div>
</div>
</div>
</div>		
<!-- copy down to here to use close forms divs -->


<?php if (isset($_POST['addPartner'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

 <?php 

include("templates/footer.html");

?> 
  
