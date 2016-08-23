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
	$userId."') as r on r.project_id = project.project_id ";
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
<html>
 <head>
  <title>Technophilia 2016</title>
 </head>
 <body>
 <div>
 <h1 style ="text-align:center;">Technophilia 2016 Contesting Projects</h1>
	<div style="width: 1100px; margin:0 auto;">
	<form method = "GET" action="rating.php">
		<div name="project_1" value="1">
			<input type="checkbox" name = "project_id" value="1"/>Joseph and Team
			
		</div>
		<br/>
		<div>
			<select name="project_rating" id="ratings">
			<option value="0">--Select a Topic--</option>
			<option value="5">This project should definitely be in Technophilia 2016</option>
			<option value="3">I dont mind to see this project in Technophilia 2016</option>
			<option value="1">Allow this project in Technophilia 2016 if there is any slot remainig</option>
			<option value="0">This project should definitely not be in Technophilia 2016</option>
			</select>
			<!--<div style="display:inline-block; width:500px;"><input type = "checkbox" name ="checkbox1" value="5"/>This project should definitely be in Technophilia 2016</div>
			<div style="display:inline-block; width:500px;"><input type = "checkbox" value="3"/>I dont mind to see this project in Technophilia 2016</div>
			<div style="display:inline-block; width:500px;"><input type = "checkbox" value="1"/>Allow this project in Technophilia 2016 if there is any slot remainig</div>
			<div style="display:inline-block; width:500px;"><input type = "checkbox" value="0"/>This project should definitely not be in Technophilia 2016</div>
			-->
			
		</div>
		<div>
		<input type="submit" value="submit">
		</div>
	
	</form>
	</div>
 </div>
 </body>
</html>		