<?php

include_once("classDbConnection.php");

class classAction
{
	// get a list of workgroups from database
	public function listAllActions(){
		
		$sql_statement  = "SELECT actionDescription ";
		$sql_statement .= "FROM action ";
		$sql_statement .= "ORDER BY actionID ";
		
		// set up Database connection
		$db = new Db();

		if(!$db){
		
		echo "could not get a DB connection";		
			
		}
		
		// submit query
		$result = $db -> select($sql_statement);

		return $result;
	
	} // end of list agents function


	// get a formatted list of workgroups for selection lists on forms
	public function selectListActions(){
		
		$result = $this->listAllActions();
		$outputDisplay = "";

		if (!$result) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay = "Sorry a database error occurred while getting a list of workgroups. Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result);
	
			if ($numresults == 0){
			
				$outputDisplay = "No Actions available. Please add Actions";
				
			} else {
	
			
				$outputDisplay .= "<select id = 'workgroupName' name='workgroupName' size = '1' >";
				$outputDisplay .= "<option value = 'Not Applicable'>Not Applicable</option>";
	
				for ($i = 0; $i < $numresults; $i++)
				{
					$row = mysqli_fetch_array($result);

					$action  = $row['actionDescription'];

					//$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";
					$outputDisplay .= "<option value = ".$action.">".$action."</option>";
				
				} // end for loop
				
			} // end of If for number of rows

		}	// end of if (!result)
		
	
		$outputDisplay .= "</select>";
		return $outputDisplay; // output list of agents for selection in dropdown
	
	} // end of selectListAllactions	
	
	
	
	
	
	
	
	public function updateAction($agent){
		
	
		
		
		
	}



	public function deleteAction($agent){
	
	
	
	}
	
	
	public function addAction($actionDescription,$programmeID,$allianceID,$workgroupID){
		
		
		// build sql statements
		$statement = "insert into action (programmeID, workgroupID, allianceID ,actionDescription) ";
		$statement .= "values (";
		$statement .= "'".$programmeID."', '".$workgroupID."', '".$allianceID."', '".$actionDescription."'";
		$statement .= ")";
		
		/* $con=mysqli_connect("localhost","root","","gafa");
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "<br>Failed to connect to MySQL: " . mysqli_connect_error()."<br>";
		}

		// Perform a query, check for error
		if (!mysqli_query($con,$statement))
		{
		echo("<br>Error description: " . mysqli_error($con)."<br>");
		}

		mysqli_close($con);
		
		return false; */
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	}// end of addAction function
	
	
	// function to adds an action if there is no associated WG
	public function addActionNoWG($actionDescription,$programmeID,$allianceID){
		
		
		// build sql statements
		$statement = "insert into action (programmeID, allianceID ,actionDescription) ";
		$statement .= "values (";
		$statement .= "'".$programmeID."', '".$allianceID."', '".$actionDescription."'";
		$statement .= ")";
		
		/* $con=mysqli_connect("localhost","root","","gafa");
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "<br>Failed to connect to MySQL: " . mysqli_connect_error()."<br>";
		}

		// Perform a query, check for error
		if (!mysqli_query($con,$statement))
		{
		echo("<br>Error description: " . mysqli_error($con)."<br>");
		}

		mysqli_close($con);
		
		return false;
		 */
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	}// end of addActionNoWG function
	

	public function getActionID($actionDescription){
		
		// build sql
		$sql_statement  = "SELECT actionID ";
		$sql_statement .= "FROM action ";
		$sql_statement .= "where actionDescription =";
		$sql_statement .= "'".$actionDescription."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		$row = mysqli_fetch_array($result);

		$actionID  = $row['actionID'];
		
		return $actionID;
			
	}// end of getActionID function

	

	
		
	
	
	
} // end of class action


?>