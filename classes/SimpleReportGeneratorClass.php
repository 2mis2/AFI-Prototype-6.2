<?php

class SimpleReportGeneratorClass
{
			
			
			// private $simpleReportSQL = "select reportDate,partnerName,report from partners,reports where reports.partnerID = partners.partnerID";
			
			private $agent_statement = "";
			private $date_statement = "";
		
			function __construct() {  // create connection in constructor
		
		
			}	// end of constructor	
					
	
			function getReports($reportType, $partner, $date){
	
				
					// Build query based on parameters;
					// basic SQL statement to get simple report
					$sql_statement = "select reportID,reportDate,partnerName,report from partners,reports where reports.partnerID = partners.partnerID";
					
					// $sql_statement = $Globals[$simpleReportSQL];
					// Add SQL to search based on partner name
					if ($partner != 'All'){
						$sql_statement .= $this->addAgent($partner);
								// create SQL for partner selection
					}

								// add SQl to select based on date 
					if ($date != "All"){
						$sql_statement .= $this->addDate($date);
					}

					// new db connection
					$db = new Db();

					// submit query
					$result = $db -> select($sql_statement);

					$outputDisplay = ""; // reset outputDisplay. this will hold complete table
			
		
					if (!$result) { // error result
							
					$outputDisplay .= "An error occurred reading that report. You did nothing wrong. Please send the following to your administrator or IT support ";
					$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
					$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
					$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
					$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
				
					return $outputDisplay;

					} else {
								
								
								$outputDisplay  = "<h3>SIMPLE REPORT</h3>";
								$outputDisplay .= '<table border=1 class="tb1" id="tb1">';
								$outputDisplay .= '<thead><tr><th class="reportID">Report ID</th><th class="date">Date</th><th class="partner">Partner</th><th class="report">Report</th></tr></thead>';
								$outputDisplay .= '<tbody>';
								
								
								$numresults = mysqli_num_rows($result);

								for ($i = 0; $i < $numresults; $i++)
								{

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
								
								$outputDisplay .= "</tbody><tfoot></tfoot>";
								$outputDisplay .= "</table>";


								return $outputDisplay; 
				
								// echo "simple";
				
							
							
								
			
			}
	
	
	
		}

		
		
	
		
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
		
		// caters for probLEM where company=ALL and a WHER is required instead of AND
		// .i.e. SELECT * from job where date = date
		// or SELECT * from job WHERE company = company AND date = date
		if ($company != 'All'){
				
			$date_statement .= " AND ";	
				
			}else {
			
			$date_statement .= " WHERE ";
			
			}
		
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