
<?php

set_include_path ("./classes" );
spl_autoload_register ();





if(!empty($_POST['viewReports'])) {
	
	// get the data from the HTTP post
	$reportType = $_POST['formType'];
	$agent = $_POST['partner'];
	$date = $_POST['date'];

	// create new report object and view report
	$report = new classReports();
	
	// this function will return a fully formatted table so results can be printed directly
	$outputResults = $report->viewReports($reportType,$agent,$date);
	
	print $outputResults;

	

}
	?>
  
   
<hr size="4" style="background-color: #F5DEB3; color: #F5DEB3;">


     <div id="printTable">
<?php

if (!empty($_POST['viewReports'])){
	
	// display the table
//	$outputDisplay .= "<br /><br /><b>Number of Rows in Results: $myrowcount </b><br /><br />";
	print $outputDisplay;
}
	
?>
	 
	</div>

<!-- *********************************** -->
<!-- * Submit Report section from here ** -->
<!-- *********************************** -->

<?php



if(!empty($_POST['submitReport'])) {


	// fetch data from form
	$reportMeetingName = $_POST['meeting'];
	$reportActionName = $_POST['action'];
	$reportMemberName = $_POST['member'];
	$reportWorkgroupName = $_POST['WGname'];
	$reportHeader = $_POST['reportHeader'];
	$reportText = $_POST['reportText'];
	$reportBarrier = $_POST['reportBarrier'];
	
	// get alliance contact details here using session ID, for report
	$contactFName = "Joe";
	$contactLName = "Bloggs";
	$contactEmail = "Joe@bloggs.com";
	$contactMobile = "085123456";
	
	
	
	
	
	
	// get allianceID
	$member = new classAlliance();
	$memberID = $alliance->getAllianceID($reportMemberName); 
	
	// get actionID
	$action = new classAction();
	$actionID = $action->getActionID($reportActionName); 
	
	// get meetingID
	$action = new classMeeting();
	$actionID = $action->getMeetingID($reportMeetingName); 
	
	
	
	
	
	// get workGroup ID if set
	// if there isn't a WG associated with the action then call addActionNoWG
	if ($_POST['workgroupName'] == "Not Applicable"){
		
		$report = new classReport();
		$result = $report->addReportNoWG($meetingID,$actionID,$memberID,$reportHeader,$reportText,$reportBarrier,$contactFName,$contactLName,$contactMobile,$contactEmail);
	
	
	} else { // if there is a WG associated with the WG
		
		$workgroup = new classWorkgroup;
		$workgroupID = $workgroup->getWorkgroupID($reportWorkgroupName);
		
		
		
		$report = new classReport();
		$result = $report->addReport($meetingID,$actionID,$memberID,$workgroupID,$reportHeader,$reportText,$reportBarrier,$contactFName,$contactLName,$contactMobile,$contactEmail);
	
	
	}
	
	
	
	// add report
	$report = new classReport();
	$result = $report->addReport($meetingID,$actionID,$memberID,$workgroupID,$reportHeader,$reportText,$reportBarrier);
	

	if (!$result) {
		
		$outputDisplay = "Sorry there was an error submitting the report(agentID error). Please copy the information below to your administrator ";
		$outputDisplay .= "You didnt do anything wrong. This is a program or DB error";
		$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
		$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
		$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
		$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
	
		print $outputDisplay;

	} else {

		$row = mysqli_fetch_array($result);
	
		$agentID = $row['partnerID'];
	
	} // end if for checking results

	$reportOwner = $agentName;
	
	// create new report object to insert new report
	$report = new classReports();
	$result = $report->addReport($agentID,$reportText,$reportOwner);


	if (!$result) {
		$outputDisplay = "Sorry there was an error submitting the report. Please copy the information below to your administrator ";
		$outputDisplay .= "You didnt do anything wrong. This is a database insert error";
		$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
		$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
		$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
		$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
	
		print $outputDisplay;

	} else {

		Print " Successful Report Submission";
	
	} // end of check for report submission

} // end of if for Report writing section 

?>


<!-- *********************************-->
<!-- * Add Alliance or non alliance section  *-->
<!-- *********************************-->

<?php


if(!empty($_POST['addPartner'])) {


// fetch data from Form
$newAlliance = $_POST['newPartner'];
$allianceAddress1 = $_POST['partnerAddress1'];
$allianceAddress2 = $_POST['partnerAddress2'];
$allianceCity = $_POST['partnerCity'];
$allianceCounty = $_POST['partnerCounty'];
$alliancePhone = $_POST['partnerPhone'];
$memberType = $_POST['memberType'];


$Alliance = new classAlliance();
$result = $Alliance->addAlliance($newAlliance,$allianceAddress1,$allianceAddress2,$allianceCity,$allianceCounty,$alliancePhone,$memberType);

$outputDisplay = "";

if (!$result) {
	$outputDisplay = "Error adding Alliance Member";
	print $outputDisplay;

} else {

Print " New Partner Created: ";
Print $newAlliance;
	
}

} // end of add Alliance if statement
?>



<!-- *********************************-->
<!-- * Add Alliance Contact section goes here *-->
<!-- *********************************-->

<?php


if(!empty($_POST['addAllianceContact'])) {


	// fetch data from form
	$contactFName = $_POST['contactFName'];
	$contactLName = $_POST['contactLName'];
	$contactEmail = $_POST['contactEmail'];
	$contactMobile = $_POST['contactMobile'];
	$userType = $_POST['memberType'];
	$memberName = $_POST['memberName'];
	

	// get the alliance ID using the alliance name
	$alliance = new classAlliance();
	$memberNumber = $alliance->getAllianceID($memberName);

	$contact = new classContact();
	$result = $contact->addContact($contactFName,$contactLName,$contactEmail,$contactMobile,$userType,$memberNumber);

	$outputDisplay = "";

	if (!$result) {
		$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
		$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
		$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
		$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";	
		print $outputDisplay;

	} else {

	Print " New Contact Created for ".$memberName."<br>";
	Print $contactFName." ".$contactLName;
	
	} // end of result check

} // end of add Alliance Contact if statement
?>






<!-- *********************************-->
<!-- * Add Workgroup section goes here *-->
<!-- *********************************-->

<?php


if(!empty($_POST['addWorkgroup'])) {

	$outputDisplay = ""; // declare output to user variable

	// fetch data from form
	$newWorkgroup = $_POST['newWG'];
	$WGcontact = $_POST['WGcontact'];
	$WGcontactEmail = $_POST['WGcontactEmail'];
	$WGlocation = $_POST['WGlocation'];
	$WGcontactMobile = $_POST['WGcontactMobile'];

	print_r($_POST['allianceList']);

	$WG = new classWorkgroup(); // create new classworkGroup object
	
	$result = $WG->checkNotUniqueName($newWorkgroup);// check if workgroup name is unique
	
	if (!$result){ // new wg name is unique
	
		// add the work group
		$result = $WG->addWorkgroup($newWorkgroup,$WGcontact,$WGcontactEmail,$WGlocation,$WGcontactMobile);

	
		if (!$result){
		
			print " Error Inserting workgroup into DB";	
		}
	
	
		// code must go here to check for existance of allinaceList
	
		foreach($_POST['allianceList'] as $allianceChecked){
		
			$result = $WG->addWorkGroupMember($newWorkgroup,$allianceChecked);
		
			if (!$result){
					
			$outputDisplay .= "Error with Work Group ".$newWorkgroup." addition of ".$allianceChecked.".";
		} else {
			
				$outputDisplay = $allianceChecked." added.<br> ";
				print $outputDisplay;
		} // end of if

	} // end of for each

	
	/* // add non-Alliance members to workgroup

	$memberType = "2"; // set member type to non alliance
	
	foreach($_POST['nonAllianceList'] as $nonAllianceChecked){
	
		$result = $WG->addWorkGroupMember($newWorkgroup,$nonAllianceChecked,$memberType);
		
			if (!$result){

				$outputDisplay .= "Error with workgroup ".$newWorkgroup." addition of ".$nonAllianceChecked.".";
			} else {
			
				$outputDisplay = $nonAllianceChecked." added. <br>";
				print $outputDisplay;
			}

	} */

	$outputDisplay = "<br>Result for Work Group ".$newWorkgroup.".";
	
	print $outputDisplay;
	
	} else {  // else for unique wg name
	
	$outputDisplay = "<br>Work group name already used. You must choose a unique work group name ";
	print $outputDisplay;
	
	}
	
} // end of add Work Group if statement

?>



<!-- *********************************-->
<!-- * Add meeting                   *-->
<!-- *********************************-->

<?php


if(!empty($_POST['addMeeting'])) {


	// fetch data from Form
	$meetingDescription = $_POST['meetingDescription'];
	$meetingDate = $_POST['meetingDate'];
	$meetingTime = $_POST['meetingTime'];
	$meetingAgenda = $_POST['meetingAgenda'];


	$meeting = new classMeeting();
	$result = $meeting->addMeeting($meetingDescription,$meetingDate,$meetingTime,$meetingAgenda);

	$outputDisplay = "";

	if (!$result) {
		$outputDisplay = "Error adding Meeting";
		print $outputDisplay;

	} else {

	Print " New Meeting Created:<br> ";
	Print $meetingDescription;
		
	}

} // end of add Meeting if statement

?> 



<!-- *********************************-->
<!-- * Add programme section  goes here*-->
<!-- *********************************-->

<?php


if(!empty($_POST['addProgramme'])) {


	// fetch data from Form
	$WHOtheme = $_POST['WHOtheme'];
	$themeNumber = $_POST['themeNumber'];
	$strategy = $_POST['strategy'];
	$strategyNumber = $_POST['strategyNumber'];


	$meeting = new classProgramme();
	$result = $meeting->addProgramme($WHOtheme,$themeNumber,$strategy,$strategyNumber);

	$outputDisplay = "";

	if (!$result) {
		$outputDisplay = "Error adding Meeting";
		print $outputDisplay;

	} else {

	Print " New Programme Created:<br> ";
	
		
	}

} // end of add Meeting if statement

?> 

<!-- *********************************-->
<!-- * Add Action section             *-->
<!-- *********************************-->

<?php


if(!empty($_POST['addAction'])) {


	// fetch data from Form
	$actionDescription = $_POST['actionDescription'];
	$memberName = $_POST['memberName'];
	$workgroupName = $_POST['workgroupName'];
	$programmeName = $_POST['programmeStrategy'];
	
	print "<br>report controller 389. program strat from form = ".$programmeName."<br>";
	
	
	// get programme ID
	$programme = new classProgramme();
	$programmeID = $programme->getProgrammeID($programmeName);
	
	
	// get allianceID
	$alliance = new classAlliance();
	$allianceID = $alliance->getAllianceID($memberName);
	
	
	// get workGroup ID if set
	// if there isn't a WG associated with the action then call addActionNoWG
	if ($_POST['workgroupName'] == "Not Applicable"){
		
		$action = new classAction();
		$result = $action->addActionNoWG($actionDescription,$programmeID,$allianceID);

	
	} else { // if there is a WG associated with the WG
		
		$workgroup = new classWorkgroup;
		$workgroupID = $workgroup->getWorkgroupID($workgroupName);
		
		$action = new classAction();
		$result = $action->addAction($actionDescription,$programmeID,$allianceID,$workgroupID);

	}
	
	
	// print "workgroup ID after if (393) is ".$workgroupID;
	
		
	$outputDisplay = "";

	if (!$result) {
		$outputDisplay = "Error adding action";
		print $outputDisplay;

	} else {

	Print " New action Created:<br> ".$actionDescription;
	
		
	}

} // end of add Meeting if statement

?> 







<?php 	//  *************************************************************
	//  ***  Handle AJAX updateReport request               *********
	// *************************************************************



if(!empty($_POST['ajaxUpdateType'])) {

	$reportOwner = $_POST['partnerName'];
	$reportText = $_POST['reportText'];
	$reportID = $_POST['reportID'];
	
	$report = new classReports();
	$result = $report->updateReport($reportID,$reportText,$reportOwner);	

		
		if (!$result) {  // output db error
					$outputDisplay ="There was an error updated the report. You did nothing wrong. Please copy the following to your administrator. ";
					$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
					$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
					$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
					$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
				
					print $outputDisplay;

					} else { // output selected rows
					
					print "The report was updated successfully. Thank you";
					
					}

 
echo "Im uddating the report in PHP file, report: " . $reportID. "  ". $reportText;

//echo($reportText);
// echo($partnerName); 


	
	
	
} // end of if for ajax requests
?>

