
 <?php

set_include_path ("./classes" );
spl_autoload_register ();

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<p>

Alliance/Non Alliance:<br />

<!-- Build select options from database -->

<?php 
$alliance = new classAlliance();
$memberList = $alliance->getMemberList();
print $memberList;
?>


</p>

<p>

WorkGroup:<br />

<!-- Build select options from database -->

<?php 
$workgroups = new classWorkgroup();
$WGList = $workgroups->selectListWorkgroups();
print $WGList;
?>

</p>


<p>
Action:<br />
<?php 
$actions = new classAction();
$actionList = $actions->selectListActions();
print $actionList;
?>
</p>

<p>
Meeting:<br />
<?php 
$meeting = new classMeeting();
$meetingList = $meeting->getMeetingList();
print $meetingList;
?>
</p>


<p>
Report Header:<br />
<textarea name="reportHeader" rows="1" cols="50">
</textarea>
</p>


<p>
Report:<br />
<textarea name="reportText" rows="5" cols="50">
</textarea>
</p>

<p>
Barriers:<br />
<textarea name="reportBarriers" rows="5" cols="50">
</textarea>
</p>



<p>
<input type="submit" name ="submitReport" value="Submit Report">
</p>


</form>

<?php if (isset($_POST['submitReport'])){
	// if (isset($_POST['formType']))
	
	
		include ("/report-controller.php");

	// }
}	
?>
 

