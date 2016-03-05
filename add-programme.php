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
		Create a new Programme
		</h3>
</div>
  <div class="panel-body">
    Please fill out the form below and click the 'Create Programme' button
  </div>
</div>
<!-- end of from header -->


<!-- <p>

WHO Theme(no spaces, unique name):<br />
<textarea name="WHOtheme" rows="1" cols="20">
</textarea>

</p>-->


<div class="form-group">
<label for="sel1">WHO Theme Description: *</label>
<input type="text" name="WHOtheme" id="WHOtheme" tabindex="1" class="form-control" placeholder="WHO Theme Description" required>
</div>

<!-- <p>

WHO Theme Number:<br />
<p>
<select id = "themeNumber" name="themeNumber" size = "1" >
	<option value = "1">1</option>
	<option value = "2">2</option>
	<option value = "3">3</option>
	<option value = "4">4</option>
	<option value = "5">5</option>
	<option value = "6">6</option>
	<option value = "7">7</option>
	<option value = "8">8</option>
	<option value = "9">9</option>
	<option value = "10">10</option>
	
</select>
</p>

</p>
-->

<div class="form-group">
<label for="sel1">WHO Theme Number: *</label>
<select id = "themeNumber" name="themeNumber" tabindex="2" class="form-control">
	<option value = "1">1</option>
	<option value = "2">2</option>
	<option value = "3">3</option>
	<option value = "4">4</option>
	<option value = "5">5</option>
	<option value = "6">6</option>
	<option value = "7">7</option>
	<option value = "8">8</option>
	<option value = "9">9</option>
	<option value = "10">10</option>
	
</select>
</div>


<!-- <p>

Strategy:<br />
<textarea name="strategy" rows="1" cols="20">
</textarea>

</p>-->

<div class="form-group">
<label for="sel1">Alliance Strategy: *</label>
<input type="text" name="strategy" id="strategy" tabindex="4" class="form-control" placeholder="Alliance Strategy" required>
</div>


<!-- <p>

Strategy Number:<br />
<select id = "strategyNumber" name="strategyNumber" size = "1" >
	<option value = "1">1</option>
	<option value = "2">2</option>
	<option value = "3">3</option>
	<option value = "4">4</option>
	<option value = "5">5</option>
	<option value = "6">6</option>
	<option value = "7">7</option>
	<option value = "8">8</option>
	<option value = "9">9</option>
	<option value = "10">10</option>
	
</select>

</p>-->

<div class="form-group">
<label for="sel1">Alliance Strategy Number: *</label>
<select id = "strategyNumber" name="strategyNumber" tabindex="4" class="form-control">
	<option value = "1">1</option>
	<option value = "2">2</option>
	<option value = "3">3</option>
	<option value = "4">4</option>
	<option value = "5">5</option>
	<option value = "6">6</option>
	<option value = "7">7</option>
	<option value = "8">8</option>
	<option value = "9">9</option>
	<option value = "10">10</option>
	
</select>
</div>



<!-- <p>
<input type="submit" name= "addProgramme" value="Save Programme">
</p> -->

<div class="form-group">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<input type="submit" name="addProgramme" tabindex="5" class="form-control btn btn-primary" value="Create Programme">
											</div>
										</div>
									</div>
<label for="sel1">* Must be filled in</label>

</form>

<?php if (isset($_POST['addProgramme'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

  
  
