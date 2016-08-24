<?php
require_once("connect.php");
require_once("rating_result.php");

if(isset($_GET['user_id']))
{
	$userId = $_GET['user_id'];
}
else
	if(isset($_COOKIE["technophilia2016"]))
	{
		$userId = $_COOKIE["technophilia2016"];
	}
else
	exit("UserId for the user not found.");


$query = "SELECT Status from project where project_id = ".mysql_real_escape_string($_GET['project_id']);
$StatusOfConcernedProject = mysql_query($query) or die("could not display " .mysql_error());

//get the status of the first row in result set
$status=mysql_result($StatusOfConcernedProject,0,"Status"); 

//create php object for returning
$returnObject = new RatingResult();


if($status==0)
{
	//the project is inactive
	$returnObject->returnCode = 1;
	//this message will change
	$returnObject->returnMessage="You cannot submit rating for the desired project.";
	
	
}
else
{
	//enter or update rating
	$query = "insert into rating (user_id,project_id,rating) values ('".mysql_real_escape_string($userId)."',".
	mysql_real_escape_string($_GET['project_id']).",".mysql_real_escape_string($_GET['project_rating']).") on duplicate key update rating=".
	mysql_real_escape_string($_GET['project_rating']);
	
	$result =  mysql_query($query) or die("could not display " .mysql_error());
	
	$returnObject->returnCode = 0;
	$returnObject->returnMessage="Your rating has been successfully recorded.";
	
}	

echo json_encode($returnObject);
?>