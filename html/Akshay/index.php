<?php
require_once("connect.php");
	$userId='Hello1';
	if(isset($_COOKIE["technophilia2016"]))
{	
	$userId=$_COOKIE["technophilia2016"];	
}
else
{
	//set the lifetime to a suitable time.
	setcookie("technophilia2016", uniqid("Hello".mt_rand(1000,10000),true), time()+60*60*24*7, "/","", 0); 	
}
	$query = "SELECT project.project_id, project.project_name,r.rating FROM project left outer join (select * from rating where rating.user_id ='".
	$userId."') as r on r.project_id = project.project_id order by project.project_id ";
    $currentUserRatings = mysql_query($query) or die("could not display " .mysql_error());
	//$num = mysql_num_rows($currentUserRatings);
	
	class UserRatings
	{
		public $projectId=0;
		public $projectName='';
		public $rating=0;
	}

	$objectArray=[];
	while($resultArray = mysql_fetch_array($currentUserRatings,MYSQL_ASSOC))
	{
		//echo "Project id : ".$resultArray['project_id']." Project Name : ".$resultArray['project_name']." Rating : ".$resultArray['rating'];
		$userRating = new UserRatings();
		$userRating->projectId = $resultArray['project_id'];
		$userRating->projectName = $resultArray['project_name'];
		$userRating->rating=$resultArray['rating'];
		array_push($objectArray,$userRating);
	}

	echo json_encode($objectArray);	
?>	