<?php 
//set_include_path ("/" );
//spl_autoload_register();

include("classDbConnection.php");

// set up Database connection
$db = new Db();

// submit query
$result = $db -> select("SELECT * FROM `engineer`");

// print_r($result);

// find the number of rows
$numresults = mysqli_num_rows($result);


// format table
$outputDisplay  = "<h3>FULL REPORT</h3>";

$outputDisplay .= '<table id="tb1" class="display" border=1>';
$outputDisplay .= '<thead></tr></thead>' ;
$outputDisplay .= '<tbody>';

// insert values into table
for ($i = 0; $i < $numresults; $i++)
{
						
		

		$row = mysqli_fetch_array($result);

		$engineerNumber = $row['engineerNumber'];
		$engineerFName  = $row['engineerFName'];
		$engineerLName = $row['engineerLName'];
		$engineerMobile = $row['engineerMobile'];
		
		$outputDisplay .= "<tr>";
		$outputDisplay .= "<td class =\"jobNumber\" id=\"reportID\">".$engineerNumber."</td>";
		$outputDisplay .= "<td class =\"startDate\">".$engineerFName."</td>";
		$outputDisplay .= "<td class =\"contact\">".$engineerLName."</td>";
		$outputDisplay .= "<td class = \"description\">".$engineerMobile."</td>";
		$outputDisplay .= "</tr>";			
						
} 


$outputDisplay .= "</tbody><tfoot></tfoot>";
$outputDisplay .= "</table>";


print $outputDisplay;

?>