'use strict';

var app = angular.module('test-app', []);

app.controller('ctrlForm',function($scope, $http, $templateCache) {
	var method = 'POST';
	var url = 'grabber/ajax';
	$scope.codeStatus = "";	
	
    $scope.submit = function() {
		var listincludeurl = document.getElementById('listincludeurl').value;
		var listmailparser = document.getElementById('listmailparser').value;
		
		var FormData = {
		  'url' : $scope.url,
		  'listincludeurl' : listincludeurl,
		  'listmailparser' : listmailparser,
		};
		$http({
		  method: method,
		  url: url,
		  data: FormData,
		  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		  cache: $templateCache
		}).
		success(function(response) {
//			console.log(response);
//			alert(listincludeurl);
//			alert(response); // вернет остаток емейлов+мусор с бесплатного хостинга вконце
			//$scope.codeStatus = response.data;
			var lm = response.replace(/<\/?[^>]+>/g,'').replace(/\s*\r+/, '').replace(/\n+$/m, '');
			
			if(document.getElementById('listincludeurl').value=='' && document.getElementById('listmailparser').value!=''){
				document.getElementById('stop-search').style.display = "block";
				document.getElementById('stop-button').click();
			}
			else if(document.getElementById('listincludeurl').value==''){
				document.getElementById('listincludeurl').value = lm;
			}
			else{
				$scope.listmailparser = lm;
				var new_urls = document.getElementById('listincludeurl').value.split('\n');
				var resultat = "";
				for (var i = 1, ln = new_urls.length; i < ln; ++i){
					resultat = resultat+new_urls[i]+'\n';
				}
				document.getElementById('listincludeurl').value = resultat.replace(/\s*\r+/, '').replace(/\n+$/m, '');
				//document.getElementById('send-button').click();
			}
		});
    }
});