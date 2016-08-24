var app = angular.module("myApp");

app.controller("indexCtrl", ["$scope", "dataService", function($scope,dataService) {

	$scope.currentProject = -1;
	$scope.groups = [];
	
	//Get all the groups and their ratings (If any)...
	dataService.getAllGroups()
		.success(function(data){
			console.log("Success");
			console.log(data);
			$scope.groups = data;
			
		}).error(function(response, error ){
			console.log("Error:");
			console.log(response);	
			console.log(error);	
			
		});
	
	
	
	
	$scope.registerInput =function(groupId, data){
		console.log(groupId + " " + data + " initiated...");
		$("#pb_" + groupId).show();
		
		dataService.recordInput(groupId,data)
			.success(function(result){
				$("#pb_" + groupId).hide();
				console.log("Success");
				console.log(result);
				
				if(result.returnCode == 0) {
					console.log(result.returnMessage);
					$.map($scope.groups, function (group){
						if(group.projectId == groupId)
						{
							group.rating = data;
							console.log(group.rating);
						}
					});
				}
				else {
					console.log(result.returnMessage);
$("#pb_" + groupId).hide();
				}
				
			}).error(function(response, error ){
				console.log("Server Error. Failed to record your input. Please try again.")	
			});
			
	};



	//Check for current group after specific interval...
	window.setInterval(function(){
	dataService.getCurrentProject()
		.success(function(data){
			if(data.length > 0) {
				$scope.currentProject = data[0].projectId;
}
else {
$scope.currentProject = -1;
}
			console.log("Current Project: " + $scope.currentProject)
		}).error(function(response, error ){
			console.log("Error:");
			console.log(response);	
			console.log(error);	
		});
	}, 5000);

}]);
		