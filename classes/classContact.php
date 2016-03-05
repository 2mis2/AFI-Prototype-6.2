<?php
include_once("classDbConnection.php");

class classContact
{
	public function listContact($allianceID){
		
		$sql_statement  = "SELECT contactFName, contactLName, contactEmail, contactMobile ";
		$sql_statement .= "FROM allianceContact ";
		$sql_statement .= "WHERE memberID = ";
		$sql_statement .= "'".$allianceID."'";
		$sql_statement .= "ORDER BY contactLName ";
		
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> select($sql_statement);

		return $result;
	
	} // end of list agents function


	public function updateContact($contactID){
		
		// update * in agent where agent=$agent
		
		
		
	}



	public function deleteContact($FName, $LName, $memberID){
	
	// delete * from reports where agent = $agent
	// delete * from reports where agent = $agent
	
	}
	
	
	public function addContact($contactFName,$contactLName,$contactEmail,$contactMobile,$userType,$allianceNumber){
		
		// build sql statements
		$statement = "insert into allianceContact (contactFName, contactLName, contactEmail, contactMobile ,userType , memberID ) ";
		$statement .= "values (";
		$statement .= "'".$contactFName."', '".$contactLName."', '".$contactEmail."', '".$contactMobile."', '".$userType."', '".$allianceNumber."'";
		$statement .= ")";
				
		// set up Database connection
		$db = new Db();

		// submit query
		$result = $db -> query($statement);

		return $result;
			
	}// end of addContact function

	
	public function getContactID($FName, $LName, $memberID){
		
		// build sql
		//$sql_statement  = "SELECT memberID ";
		//$sql_statement .= "FROM allianceMember ";
		//$sql_statement .= "where memberName =";
		//$sql_statement .= "'".$allianceName."'";

		// set up Database connection
		//$db = new Db();

		// submit query
		//$result = $db -> select($sql_statement);

		//return $result;
			
	}// end of addAgent function

	
	
	
	
	
} // end of class agents


?>