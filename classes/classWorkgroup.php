<?php

include_once("classDbConnection.php");

class classWorkgroup
{
	// get a list of workgroups from database
	public function listWorkgroups(){
		
		$sql_statement  = "SELECT WGname ";
		$sql_statement .= "FROM workGroup ";
		$sql_statement .= "ORDER BY WGname ";
		
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
	public function selectListWorkgroups(){
		
		$result = $this->listWorkgroups();
		$outputDisplay = "";

		if (!$result) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay = "Sorry a database error occurred while getting a list of workgroups. Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result);
	
			if ($numresults == 0){
			
				$outputDisplay = "No Work Groups available. Please add workgroups if required";
				
			} else {
	
			
				$outputDisplay .= "<select id = 'workgroupName' name='workgroupName' size = '1' >";
				$outputDisplay .= "<option value = 'Not Applicable'>Not Applicable</option>";
	
				for ($i = 0; $i < $numresults; $i++)
				{
					$row = mysqli_fetch_array($result);

					$WGname  = $row['WGname'];

					//$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";
					$outputDisplay .= "<option value = ".$WGname.">".$WGname."</option>";
				
				} // end for loop
				
			} // end of If for number of rows

		}	// end of if (!result)
		
	
		$outputDisplay .= "</select>";
		return $outputDisplay; // output list of agents for selection in dropdown
	}	
	
	
	
	
	public function checkNotUniqueName($wgName){
		
		$sql_statement  = "SELECT workGroupID ";
		$sql_statement .= "FROM workGroup ";
		$sql_statement .= "WHERE WGname = "."'".$wgName."'";
		
		// set up Database connection
		$db = new Db();

		if(!$db){
		
		echo "could not get a DB connection";		
			
		}
		
		// submit query
		$result = $db -> select($sql_statement);
		
		if (mysqli_num_rows($result)==0){
		
			return false;
		
		} else {
			
			return true;
		}
	
	} // end of list agents function
	
	
	public function updateWorkgroup($agent){
		
		// update * in agent where agent=$agent
		
		
		
	}



	public function deleteWorkgroup($agent){
	
	// delete * from reports where agent = $agent
	// delete * from reports where agent = $agent
	
	}
	
	
	public function addWorkgroup($newWorkgroup,$WGcontact,$WGcontactEmail,$WGlocation,$WGcontactMobile){
		
		
		// build sql statements
		$statement = "insert into workGroup (WGcontact, WGcontactEmail, WGlocation ,WGcontactMobile, WGname) ";
		$statement .= "values (";
		$statement .= "'".$WGcontact."', '".$WGcontactEmail."', '".$WGlocation."', '".$WGcontactMobile."', '".$newWorkgroup."'";
		$statement .= ")";
		
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	}// end of addAgent function

	public function getWorkgroupID($workGroupName){
		
		// build sql
		$sql_statement  = "SELECT workGroupID ";
		$sql_statement .= "FROM workGroup ";
		$sql_statement .= "where WGname =";
		$sql_statement .= "'".$workGroupName."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		$row = mysqli_fetch_array($result);

		$workGroupID  = $row['workGroupID'];
		
		return $workGroupID;
			
	}// end of addAgent function

	

	public function addWorkgroupMember($workGroupName, $allianceName){
		
		$result = $this->getWorkGroupID($workGroupName);
		
		if(!$result){
			
			print "error in getting workgroup ID";
			
		}else{
				
			$row = mysqli_fetch_array($result);
			$workGroupID = $row['workGroupID'];
		}
		
		
			
			$allianceID = classAlliance::getAllianceID($allianceName); //call static method to get alliance ID
			
			print "<br> alliance member ID is ".$allianceID."<br>";
			
			echo "<br>workgroup is ".$workGroupID." and member is ".$allianceID."<br>";
			
		$memberType =0; // remove this later

		// build sql statements
		$statement = "insert into workgroupMember (WGMworkGroupID, WGMmemberID, memberType) ";
		$statement .= "values (";
		$statement .= "'".$workGroupID."', '".$allianceID."', '".$memberType."'";
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

		mysqli_close($con); */
		
		// set up Database connection
		$db = new Db();
		
		if(!$db){
			
			echo "<br>database connect error while inserting workgroup<br>";
		}

		// submit query
		$result = $db -> query($statement); 
		
		if (!$result){
			
			echo "<br>database result error while inserting workgroup member<br>";
			
		}
		
		return $result; 
			
	}// end of addAgent function


function getWorkGroupMembers($workgroupName) {

	$workgroupID = $this->getWorkgroupID($workgroupName);
	
	
	// build sql
		$sql_statement  = "SELECT WGMmemberID,memberType ";
		$sql_statement .= "FROM workgroupMember ";
		$sql_statement .= "where WGMworkGroupID =";
		$sql_statement .= "'".$workgroupID."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);

		return $result;

} // end of getWorkgroup members	
	
	
	
} // end of class agents


?>