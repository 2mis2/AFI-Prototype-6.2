

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

 
<p>
Report Type:<br />
<select name="formType" size = "1" >
	<option value = "Simple"> Simple Report </option>
	<option value = "Full"> Full Report </option>
	
</select>
</p>

<p>

Partner:<br />

<!-- Build select options from database -->

<?php

$db = mysqli_connect('localhost','root','','Gafa');

if (!$db){
	
	print "Database not connected";
	
	}

$sql_statement  = "SELECT partnerName ";
$sql_statement .= "FROM partners ";
$sql_statement .= "ORDER BY partnerName ";

$result = mysqli_query($db, $sql_statement);

$outputDisplay = "";
$myrowcount = 0;

if (!$result) {
	$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
	$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
	$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
} else {

	$outputDisplay  = "<select name=\"partner\" size=\"1\">";
	$outputDisplay .= "<option value= \"All\">All</option>";

	$numresults = mysqli_num_rows($result);

	for ($i = 0; $i < $numresults; $i++)
	{
		$row = mysqli_fetch_array($result);

		$name  = $row['partnerName'];

		$outputDisplay .= "<option value='".$name."'>".$name."</option>";
	}

	$outputDisplay .= "</select>";
	print $outputDisplay;
}
?>


</p>

<p>
Date: Last<br />
<select name="date" size = "1" >
	<option value = "All"> All </option>
	<option value = "30"> 30 days </option>
	<option value = "90"> 90 days </option>
	<option value = "180"> 180 days </option>	
</select>

</p>


<p>
<input type="submit" name="viewReports" value="View Reports">
<!-- <input type="submit" name="export" value="Export to Excel"> -->
</p>


</form>


