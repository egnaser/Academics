var app = angular.module('myApp');

app.service('dataService', function($http){

	this.greet = function() {
      return "Hello world from Service!";
    };
	
	this.getAllGroups = function() {
		return $http.get("Akshay/index.php");
	};
	
	this.recordInput = function(group, input){
		return $http.get("Akshay/rating.php?project_id=" + group + "&project_rating=" + input);
	}
   
    this.getCurrentProject = function(){
		return $http.get("Akshay/currentActiveProject.php");
	}
   
});