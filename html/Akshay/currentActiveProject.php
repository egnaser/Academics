<?php
require_once("connect.php");
$query = "SELECT project_id , project_name, Status from project where Status = 1";
$currentActiveProject = mysql_query($query) or die("could not display " .mysql_error());

class Project{
	public $projectId;
	public $projectName;
	public $projectStatus;
}

$activeProjectList = [];

while($resultArray = mysql_fetch_array($currentActiveProject,MYSQL_ASSOC))
{
	$project = new Project();
	$project->projectId = $resultArray['project_id'];
	$project->projectName = $resultArray['project_name'];
	$project->projectStatus = $resultArray['Status'];
	array_push($activeProjectList,$project);
}

echo json_encode($activeProjectList);
?>