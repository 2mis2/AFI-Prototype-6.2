 
<?php


set_include_path ("./classes" );
spl_autoload_register ();

 
 ?>
 


<!-- form calls itself -->

<form id="report-request" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<p class="reportrequest">
Report Type:<br />
<select id = "formType" name="formType" size = "1" >
	<option value = "Simple"> Simple Report </option>
	<option value = "Full"> Full Report </option>
	
</select>
</p>

<p class="reportrequest">

Agent:<br />

<!-- Build select options from database -->

<?php

	// create new class to read list of agents from DB
	$Agents = new classAgents();
	$result = $Agents->listAgents();

	$outputDisplay = "";
	$myrowcount = 0;

	if (!$result) {
	$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
	$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
	$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
	
	} else {

	$outputDisplay  = "<select id=\"partner\" name=\"partner\" size=\"1\">";
	$outputDisplay .= "<option value= \"All\">All</option>";

	$numresults = mysqli_num_rows($result);
	for ($i = 0; $i < $numresults; $i++)
	{
		$row = mysqli_fetch_array($result);

		$name  = $row['memberName'];

		$outputDisplay .= "<option value='".$name."'>".$name."</option>";
	}

	$outputDisplay .= "</select>";
	print $outputDisplay; // output list of alliances for selection in dropdown
	
}
?>


</p>

<p class="reportrequest">
Date: Last<br />
<select id="date" name="date" size = "1" >
	<option value = "All"> All </option>
	<option value = "30"> 30 days </option>
	<option value = "90"> 90 days </option>
	<option value = "180"> 180 days </option>	
</select>

<p class="reportrequest">
<input type="submit" name="viewReports" value="View Reports">
<!-- <input type="submit" name="export" value="Export to Excel"> -->
</p>


</form>

<?php

if (isset($_POST['viewReports'])){
	if (isset($_POST['formType'])){
	
	
		include ("/report-controller.php");

	}
}

	
?>



<div id="reportResult">

</div>
        
 




  
 
