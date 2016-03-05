<?php
include_once("classDbConnection.php");

class classMeeting
{
	
	// function to add meeting to DB
	public function addMeeting($meetingDescription,$meetingDate,$meetingTime,$meetingAgenda){
		
		// build sql statements
		$statement = "insert into meeting (meetingDescription, meetingDate, meetingTime, meetingAgenda) ";
		$statement .= "values (";
		$statement .= "'".$meetingDescription."', '".$meetingDate."', '".$meetingTime."', '".$meetingAgenda."'";
		$statement .= ")";
				
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	
	} // end of list agents function	
	
	
	public function getMeetingList(){

		$sql_statement  = "SELECT meetingDescription ";
		$sql_statement .= "FROM meeting ";
		$sql_statement .= " ORDER BY meetingDate ";
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);


		if (!$result) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay = "Sorry a database error occurred while getting members. Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result);
	
			if ($numresults == 0){
			
				$outputDisplay = "No meetings available. Please add Meetings";
				
			} else {
	
				// $outputDisplay = "<p>Please select Alliance/non-Alliance Member<p>";
				$outputDisplay = "<select id = 'meetingDescription' name='meetingDescription' size = '1' >";
	
	
				for ($i = 0; $i < $numresults; $i++)
				{
					$row = mysqli_fetch_array($result);

					$meetingDescription  = $row['meetingDescription'];

					//$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";
					$outputDisplay .= "<option value = '".$meetingDescription."'>".$meetingDescription."</option>";
				
				} // end for loop
				
			} // end of If for number of rows

		}	// end of if (!result)
		
	
		$outputDisplay .= "</select>";
		return $outputDisplay; // output list of agents for selection in dropdown
	
}	// end of getCheckBox Function
	
	
	
	public function getMeetingID($meetingDescription){
		
		// build sql
		$sql_statement  = "SELECT meetingID ";
		$sql_statement .= "FROM meeting ";
		$sql_statement .= "where meetingDescription =";
		$sql_statement .= "'".$meetingDescription."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		$row = mysqli_fetch_array($result);

		$meetingID  = $row['meetingID'];
		
		return $meetingID;
			
	}// end of getActionID function
	
	
	
	
	
	
}