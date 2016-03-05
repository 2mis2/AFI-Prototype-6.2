<?php 
class FullReportGeneratorClass
{
	
			// private $fullReportSQL = "select reportDate,partnerName,reportOwner,partnerEmail,report from partners,reports where reports.partnerID = partners.partnerID";
			// private $simpleReportSQL = "select reportDate,partnerName,report from partners,reports where reports.partnerID = partners.partnerID";
			private $agent_statement = "";
			private $date_statement = "";
		
			function __construct() {  // create connection in constructor
		
		
			}	// end of constructor	
					
	
			function getReports($reportType, $agent, $date){
	
						
				$sql_statement = "select reportID,reportDate,partnerName,reportOwner,partnerEmail,report from partners,reports where reports.partnerID = partners.partnerID";
				
				
				if ($agent != 'All'){
						$sql_statement .= $this->addAgent($agent);
								// create SQL for partner selection
					}

								// add SQl to select based on date 
				if ($date != "All"){
						$sql_statement .= $this->addDate($date);
					}

				// set up db connection and submit query
				// set up Database connection
				$db = new Db();

				// submit query
				$result = $db -> select($sql_statement);

				$outputDisplay = ""; // reset outputDisplay. this will hold complete table
			
				
				// generate tables
				if (!$result) {  // output db error
					$outputDisplay .= "An error occurred reading that report. You did nothing wrong. Please send the following to your administrator or IT support ";
					$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
					$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
					$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
					$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</p>";
				
					return $outputDisplay;

					} else { // output selected rows
					
			
					// report headers and table from here
					$outputDisplay  = "<h3>FULL REPORT</h3>";

					$outputDisplay .= '<table id="tb1" class="display" border=1>';
					$outputDisplay .= '<thead><tr><th class = "reportID">ReportID</th><th class="date">Date</th><th class="partner">Partner</th><th class="owner">Owner</th><th class="email">Email</th><th class="report">Report</th></tr></thead>' ;
					$outputDisplay .= '<tbody>';
					
					$numresults = mysqli_num_rows($result);

					// read sql rows and generate table rows
					for ($i = 0; $i < $numresults; $i++)
					{

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
				
				
				$outputDisplay .= "</tbody><tfoot></tfoot>";
				$outputDisplay .= "</table>";
				
	
		
				return $outputDisplay; 
			}

		private function addAgent($agent){
			
			global $agent_statement;
			
			$agent_statement = "";
			$agent_statement .= " AND ";
			$agent_statement .= "PartnerName =";	
			$agent_statement .= "'".$agent."'";
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