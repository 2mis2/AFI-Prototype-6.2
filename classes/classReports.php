<?php

include_once("classDbConnection.php");
include_once("FullReportGeneratorClass.php");
include_once("SimpleReportGeneratorClass.php");

class classReports
{
	public function addReport($meetingID,$actionID,$memberID,$workgroupID,$reportHeader,$reportText,$reportBarrier,$contactFName,$contactLName,$contactMobile,$contactEmail);
	{
		
		// get the current date
		$reportDate = date("Y/m/d");
		
		$sql_statement = "insert into reports (reportMeetingID, reportActionID, reportMemberID, reportWorkgroupID, reportDate,reportHeader,reportText, reportBarrier, contactFName, contactLName, contactMobile, contactEmail) ";
		$sql_statement .= "values (";
		$sql_statement .= "'".$meetingID."','".$actionID. "','".$memberID."','".$workgroupID."','".$reportDate."'";
		$sql_statement .= "'".$reportHeader."','".$reportText."', '".$reportBarrier."'";
		$sql_statement .= "'".$contactFName."','".$contactLName."', '".$contactMobile."', '".$contactEmail."'";
		$sql_statement .= ")";
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($sql_statement);

		return $result;
	
	} // end of list agents function


	public function viewReports($reportType,$agent,$date){
		
		// update * in agent where agent=$agent
		
		$outputDisplay = "";
		// creat a report type class by using report type and class extension_loaded
		// e.g. a Full report with create FullReportGeneratorClass object
		// the call the getReports method to generate the reports
		$classType = $reportType . 'ReportGeneratorClass';

		$reportGenerator = new $classType(); // create new reportGenerator
		
		// call function in reportGenerator to generator specific report
		$outputDisplay = $reportGenerator->getReports($reportType, $agent, $date); 
		
		return $outputDisplay;
	} // end of viewReports function



	public function deleteReport($reportID){
	
	
	
	}
	
	public function updateReport($agentID,$reportText,$reportOwner){
		
		// generate sql
		$sql_statement  = "UPDATE reports ";
		$sql_statement .= "SET report = \"$reportText\" ";
		$sql_statement .= "where reportID = $agentID";
		
		// create new Db connection
		$db = new Db();

		// submit query
		$result = $db -> query($sql_statement);

		return $result;
		
	
		echo "Im uddating the report in PHP file, report: " . $reportID. "  ". $reportText;

		
		
	} // end of updateReports function
	
	
	
	
	
	
} // end of class reports


?>