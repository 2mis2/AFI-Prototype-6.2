<?php

set_include_path ("./classes" );
spl_autoload_register ();

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<p>

First Name:<br />
<textarea name="contactFName" rows="1" cols="15">
</textarea>

</p>

<p>

Last Name:<br />
<textarea name="contactLName" rows="1" cols="20">
</textarea>

</p>


<p>

Email:<br />
<textarea name="contactEmail" rows="1" cols="32">
</textarea>

</p>

<p>

Mobile:<br />
<textarea name="contactMobile" rows="1" cols="16">
</textarea>

</p>


<p>
Alliance Contact Type:<br />
<select id = "memberType" name="memberType" size = "1" >
	<option value = "admin">Administrator </option>
	<option value = "user">Alliance Contact </option>
	
</select>
</p>

<p>

Alliance:<br />
<?php 
$alliance = new classAlliance();
$memberList = $alliance->getMemberList();
print $memberList;
?>
</p>


<p>
<input type="submit" name= "addAllianceContact" value="Save">
</p>


</form>

<?php if (isset($_POST['addAllianceContact'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>

  
  
