<?php 

include("templates/header.html");
include("includes/mainNav.php");
set_include_path ("./classes" );
spl_autoload_register ();

?>

 
 
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

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


<p>

Workgroup Name(no spaces, unique name):<br />
<textarea name="newWG" rows="1" cols="8">
</textarea>

</p>

<p>

Contact Name:<br />
<textarea name="WGcontact" rows="1" cols="20">
</textarea>

</p>

<p>

Email:<br />
<textarea name="WGcontactEmail" rows="1" cols="10">
</textarea>

</p>

<p>

Mobile:<br />
<textarea name="WGcontactMobile" rows="1" cols="20">
</textarea>

</p>

<p>

Location:<br />
<textarea name="WGlocation" rows="1" cols="10">
</textarea>

</p>

<p>

Please Select all Work Group Members:<br />

 
<?php

// create new class to read list of agents from DB
	$alliance = new classAlliance();
	$checkBoxList = $alliance->getCheckBoxlist();
	
	print $checkBoxList; // output list of agents for selection in dropdown
	

?>
</p>


<p>
<input type="submit" name= "addWorkgroup" value="Save Workgroup">
</p>


</form>

<?php if (isset($_POST['addWorkgroup'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

  
  
