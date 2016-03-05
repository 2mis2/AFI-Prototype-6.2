<?php

class classReportGenerator
{
	
			// private $fullReportSQL = "select reportDate,partnerName,reportOwner,partnerEmail,report from partners,reports where reports.partnerID = partners.partnerID";
			// private $simpleReportSQL = "select reportDate,partnerName,report from partners,reports where reports.partnerID = partners.partnerID";
			private $agent_statement = "";
			private $date_statement = "";
		
			function __construct() {  // create connection in constructor
		
		
			}	// end of constructor	
					
	
			function getReports($reportType, $partner, $date){
	
				global $fullReportSQL; // use global variables
				global $simpleReportSQL;
				
				$myrowcount = 0;
	
			switch ($reportType) {
		
				case 'Full':
		
				$db = mysqli_connect('localhost','root','','Gafa');

				if (!$db){
	
					$outputDisplay = "Error Database could not connected";
					return $outputDisplay;
				
				}
				
		
				$sql_statement = "select reportID,reportDate,partnerName,reportOwner,partnerEmail,report from partners,reports where reports.partnerID = partners.partnerID";
				
				// echo $fullReportSQL;
				
				// $sql_statement = $fullReportSQL; // set SQL for search
				
				// echo "full report sql"  + $fullReportSQL;

				// if a particular partner is selected, create sql to search based on partner
				if ($partner != 'All'){
						$sql_statement .= $this->addAgent($partner);
								// create SQL for partner selection
					}

								// add SQl to select based on date 
				if ($date != "All"){
						$sql_statement .= $this->addDate($date);
					}

							// submit query

				$result = mysqli_query($db, $sql_statement); // submit query

				$outputDisplay = "";
				$myrowcount = 0;

				// generate tables

				if (!$result) {  // output db error
					$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
					$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
					$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
					$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
				
					return $outputDisplay;

					} else { // output selected rows

					$outputDisplay  = "<h3>FULL REPORT</h3>";

					$outputDisplay .= '<table id="tb1" border=1>';
					$outputDisplay .= '<tr><th class = "reportID">ReportID</th><th class="date">Date</th><th class="partner">Partner</th><th class="owner">Owner</th><th class="email">Email</th><th class="report">Report</th></tr>' ;

					$numresults = mysqli_num_rows($result);

					for ($i = 0; $i < $numresults; $i++)
					{
						

						$myrowcount++;

						$row = mysqli_fetch_array($result);

						$reportID = $row['reportID'];
						$reportDate  = $row['reportDate'];
						$partner = $row['partnerName'];
						$report = $row['report'];
						$reportOwner = $row['reportOwner'];
						$partnerEmail = $row['partnerEmail'];

						$outputDisplay .= "<td class =\"reportID\" id=\"reportID\">".$reportID."</td>";
						$outputDisplay .= "<td class =\"date\">".$reportDate."</td>";
						$outputDisplay .= "<td class = \"partner\">".$partner."</td>";
						$outputDisplay .= "<td class = \"owner\">".$reportOwner."</td>";
						$outputDisplay .= "<td class = \"email\">".$partnerEmail."</td>";
						$outputDisplay .= "<td class = \"report\">".$report."</td>";
		
		
						$outputDisplay .= "</tr>";

					} 

				}
				
				$outputDisplay .= "</table>";
		
				return $outputDisplay; 
		
		
				echo "hello i'm in full";
		
				break;
					// ********************************
					// Simple REport
					//*********************************

				case 'Simple':
				
					$db = mysqli_connect('localhost','root','','Gafa');

					if (!$db){
	
					$outputDisplay = "Error Database could not connected";
					return $outputDisplay;
				
					}
		
					// Build query based on parameters;
					// basic SQL statement to get simple report
					$sql_statement = "select reportID,reportDate,partnerName,report from partners,reports where reports.partnerID = partners.partnerID";
				
					// Add SQL to search based on partner name
					if ($partner != 'All'){
						$sql_statement .= $this->addAgent($partner);
								// create SQL for partner selection
					}

								// add SQl to select based on date 
					if ($date != "All"){
						$sql_statement .= $this->addDate($date);
					}

							// submit query
					$result = mysqli_query($db, $sql_statement);
		
		
					if (!$result) { // error result
							
						$outputDisplay .= connectionError();
						return $outputDisplay;

					} else {

								$outputDisplay  = "<h3>SIMPLE REPORT</h3>";
								$outputDisplay .= '<table border=1 id="tb1">';
								$outputDisplay .= '<tr><th class="reportID">Report ID</th><th class="date">Date</th><th class="partner">Partner</th><th class="report">Report</th></tr>'               	;

								$numresults = mysqli_num_rows($result);

								for ($i = 0; $i < $numresults; $i++)
								{
									$myrowcount++;

									$row = mysqli_fetch_array($result);
									
									$reportID = $row['reportID'];
									$reportDate  = $row['reportDate'];
									$partner = $row['partnerName'];
									$report = $row['report'];
									
									$outputDisplay .= "<td class=\"reportID\" id=\"reportID\">".$reportID."</td>";
									$outputDisplay .= "<td class=\"date\">".$reportDate."</td>";
									$outputDisplay .= "<td class=\"partner\" id=\"partnerName\">".$partner."</td>";
									$outputDisplay .= "<td class=\"report\">".$report."</td>";

									$outputDisplay .= "</tr>";

								}

								$outputDisplay .= "</table>";


								return $outputDisplay; 
				
								// echo "simple";
				
							}
							
							break; 
		
		
							default:
		
							$outputDisplay = "Report Type does not exist, please contact your administrator";
		
							break;		
			
			}
	
	
	
		}

	

	
	
	
		function updateReport(){
	
	
	
		} // end updateReport


		function deleteReport(){
	
	
		} // end deleteReport

	
		function getReportList(){
		
		
		
		} // end getReportList
	
		
		private function addAgent($partner){
			
			global $agent_statement;
			
			$agent_statement = "";
			$agent_statement .= " AND ";
			$agent_statement .= "PartnerName =";	
			$agent_statement .= "'".$partner."'";
			return $agent_statement;
			} // end of addAgent function	
		
	
		private function addDate($date){
		
		global $date_statement;
		
		$days = $date;
		$days .= " days";
		// print "days ";
		// print $days;

		$date = date_create(date("Y/m/d"));
		date_sub($date, date_interval_create_from_date_string("$days"));
		$newdate = date_format($date, 'Y-m-d');
	
		// print " date: ";
		// echo $newdate;
		
		$date_statement  = "";
		$date_statement .= " AND ";
		$date_statement .= "reportDate > ";	
		$date_statement .= "'".$newdate."'"; 
		 
		 return $date_statement;
		} // end of addDate function
	
		private function connectionError(){
			
			$errorDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			$errorDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			$errorDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$errorDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
							
			return $errorDisplay;
		} // end of connectionErrror Function
		
	} // end of class
?>	