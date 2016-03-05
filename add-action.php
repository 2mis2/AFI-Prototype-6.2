<?php

set_include_path ("./classes" );
spl_autoload_register ();

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<p>

Action Description:<br />
<textarea name="actionDescription" rows="1" cols="30">
</textarea>

</p>


<p>

Action Owner/Alliance Member:<br />
<?php 
$alliance = new classAlliance();
$memberList = $alliance->getMemberList();
print $memberList;
?>
</p>

<p>

Workgroup (if applicable):<br />
<?php 
$workgroups = new classWorkgroup();
$WGList = $workgroups->selectListWorkgroups();
print $WGList;
?>
</p>


<p>

Local Strategy:<br />
<?php 
$programme = new classProgramme();
$strategyList = $programme->getProgrammeSelectList();
print $strategyList;
?>
</p>



<p>
<input type="submit" name= "addAction" value="Add Action">
</p>


</form>

<?php if (isset($_POST['addAction'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

  
  
