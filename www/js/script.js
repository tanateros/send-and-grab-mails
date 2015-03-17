'use strict';

var app = angular.module('test-app', []);

app.controller('ctrlForm',function($scope, $http, $templateCache) {
	var method = 'POST';
	var url = 'send/ajax';
	$scope.codeStatus = "";
	
    $scope.submit = function() {
		// alert($scope.text);
		var FormData = {
		  'title' : $scope.title,
		  'name' : $scope.name,
		  'email' : $scope.email,
		  'text' : CKEDITOR.instances['editor1'].getData(),
		  'listmail' : $scope.listmail,
		};
		$http({
		  method: method,
		  url: url,
		  data: FormData,
		  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		  cache: $templateCache
		}).
		success(function(response) {
			//console.log(response);
			// alert(response); // вернет остаток емейлов+мусор с бесплатного хостинга вконце
			//$scope.codeStatus = response.data;
			var lm = response.replace(/<\/?[^>]+>/g,'').replace(/\s*\r+/, '').replace(/\n+$/m, '');
			$scope.listmail = lm;
			
			if(lm!=''){
				document.getElementById('hidden-flag').value='1';
			}
			else{
				document.getElementById('hidden-flag').value='0';
				document.getElementById("stop").style.display = 'none';
				document.getElementById("send-button").style.display = 'block';
			}
		});
    }
});