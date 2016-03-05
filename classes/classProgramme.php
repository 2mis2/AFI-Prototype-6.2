<?php

include_once("classDbConnection.php");

class classProgramme
{
	
	
	public function listProgrammes(){
		
		$sql_statement  = "SELECT programmeStrategyNumber, programmeStrategy ";
		$sql_statement .= "FROM programme ";
		$sql_statement .= " ORDER BY programmeStrategyNumber ";
		
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
	
	} // end of list programmes function

	public function getProgrammeSelectList(){


		$result = $this->listProgrammes(); // call function to get list of programmes

		$outputDisplay = "";
		$myrowcount = 0;

		if (!$result) {
			//$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
			//$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
			//$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
			$outputDisplay = "Sorry a database error reading alliance strategies . Please report this";
		} else {
	
			$numresults = mysqli_num_rows($result);
	
			if ($numresults == 0){
			
				$outputDisplay = "No Programmes Available";
			} else {
	
		
			$outputDisplay .= "<select id = 'programmeStrategy' name='programmeStrategy' size = '1' >";
	
		
			for ($i = 0; $i < $numresults; $i++){
				
				$row = mysqli_fetch_array($result);

				$programmeStrategy  = $row['programmeStrategy'];

					//$outputDisplay .= "<input type='checkbox' name='allianceList[]' value=" .$name."><label>".$name."</label><br/>";
				$outputDisplay .= "<option value = '".$programmeStrategy."'>".$programmeStrategy."</option>";
				print "<br>programme strat in classprogramme".$programmeStrategy;
				
			} // end for loop
			
			$outputDisplay .= "</select>";

		} // end of if for num results
			
	}	// end of if (!result)
		
		
				
		
		
		return $outputDisplay; // output list of agents for selection in dropdown
	
}	// end of getprogrammeSelect list Function
	
	
	
	

	public function updateProgramme($agent){
		
		// update * in agent where agent=$agent
		
		
		
	}


	public function deleteProgramme($allianceName){
	
	// delete * from reports where agent = $agent
	// delete * from reports where agent = $agent
	
	}
	
	
	public function addProgramme($WHOtheme,$themeNumber,$strategy,$strategyNumber){
		
		// build sql statements
		$statement = "insert into programme (whoThemeNumber, whoTheme, programmeStrategyNumber, programmeStrategy)";
		$statement .= "values (";
		$statement .= "'".$themeNumber."', '".$WHOtheme."', '".$strategyNumber."', '".$strategy."'";
		$statement .= ")";
				
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);
		
		
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
		

		return $result;
			
	}// end of addAgent function

	
	public static function getProgrammeID($programmeStrategy){
		
		// build sql
		$sql_statement  = "SELECT programmeID ";
		$sql_statement .= "FROM programme ";
		$sql_statement .= "where programmeStrategy =";
		$sql_statement .= "'".$programmeStrategy."'";

		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);
		
		$row = mysqli_fetch_array($result);

		$programmeID  = $row['programmeID'];
		
		print "<br>programme start = ". $programmeStrategy ."<br>";
		print "<br>programme ID = ". $programmeID ."<br>";
		

		return $programmeID;
			
	}// end of addAgent function

	
	
	
	
	
} // end of class agents


?>