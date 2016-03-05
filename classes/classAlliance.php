<?php

include_once("classDbConnection.php");

class classAlliance
{
	
	
	public function listAlliance($memberType){
		
		$sql_statement  = "SELECT memberName ";
		$sql_statement .= "FROM member ";
		$sql_statement .= " WHERE memberType = "."'".$memberType."'";
		$sql_statement .= " ORDER BY memberName ";
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		/* $con=mysqli_connect("localhost","root","","gafa");
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "<br>Failed to connect to MySQL: " . mysqli_connect_error()."<br>";
		}

		// Perform a query, check for error
		if (!mysqli_query($con,$sql_statement))
		{
		echo("<br>Error description: " . mysqli_error($con)."<br>");
		}

		mysqli_close($con); */
		
		
		return $result;
	
	} // end of list agents function

	public function getCheckBoxList(){

		$memberType = "ful";
		$result = $this->listAlliance($memberType); // call function to get list of members

		$memberType = "non";
		$result2 = $this->listAlliance($memberType); // call function to get list of non members
		
		$outputDisplay = "";
		$myrowcount = 0;

		if (!$result) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay = "Sorry a database error reading alliance members list occurred. Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result);
	
			if ($numresults == 0){
			
				$outputDisplay = "<p>Please add non-Alliance Members<p>";
				}
	
	
			for ($i = 0; $i < $numresults; $i++)
			{
				$row = mysqli_fetch_array($result);

				$name  = $row['memberName'];

				$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";

			} // end for loop

		}	// end of if (!result)
		
		
		if (!$result2) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay .= "Sorry a database error reading non alliance members list occurred. Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result2);
	
			if ($numresults == 0){
			
				$outputDisplay .= "";
				}
	
	
			for ($i = 0; $i < $numresults; $i++)
			{
				$row = mysqli_fetch_array($result2);

				$name  = $row['memberName'];

				$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";

			} // end for loop

		}	// end of if (!result)
				
		
		
		return $outputDisplay; // output list of agents for selection in dropdown
	
}	// end of getCheckBox Function
	
	
	
	public function getMemberList(){

		$sql_statement  = "SELECT memberName ";
		$sql_statement .= "FROM member ";
		$sql_statement .= " ORDER BY memberName ";
		
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
			
				$outputDisplay = "No Alliance/Non Alliance members available. Please add Members";
				
			} else {
	
				$outputDisplay = "<p>Please select Alliance/non-Alliance Member<p>";
				$outputDisplay .= "<select id = 'memberName' name='memberName' size = '1' >";
	
	
				for ($i = 0; $i < $numresults; $i++)
				{
					$row = mysqli_fetch_array($result);

					$memberName  = $row['memberName'];

					//$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";
					$outputDisplay .= "<option value = ".$memberName.">".$memberName."</option>";
				
				} // end for loop
				
			} // end of If for number of rows

		}	// end of if (!result)
		
	
		$outputDisplay .= "</select>";
		return $outputDisplay; // output list of agents for selection in dropdown
	
}	// end of getCheckBox Function
	
	
	
	

	public function updateAlliance($agent){
		
		// update * in agent where agent=$agent
		
		
		
	}



	public function deleteAlliance($allianceName){
	
	// delete * from reports where agent = $agent
	// delete * from reports where agent = $agent
	
	}
	
	
	public function addAlliance($newAlliance,$allianceAddress1,$allianceAddress2,$allianceCity,$allianceCounty,$alliancePhone,$memberType){
		
		// build sql statements
		$statement = "insert into member (memberName, memberAddress1, memberAddress2, memberCity ,memberCounty , memberPhone, memberType ) ";
		$statement .= "values (";
		$statement .= "'".$newAlliance."', '".$allianceAddress1."', '".$allianceAddress2."', '".$allianceCity."', '".$allianceCounty."', '".$alliancePhone."', '".$memberType."'";
		$statement .= ")";
				
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	}// end of addAgent function

	public static function getAllianceID($allianceName){
		
		// build sql
		$sql_statement  = "SELECT memberID ";
		$sql_statement .= "FROM member ";
		$sql_statement .= "where memberName =";
		$sql_statement .= "'".$allianceName."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		$row = mysqli_fetch_array($result);

		$allianceID  = $row['memberID'];
		

		return $allianceID;
			
	}// end of addAgent function

	
	
	
	
	
} // end of class agents


?>