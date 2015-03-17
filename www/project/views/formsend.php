<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="http://<?=base_url();?>images/favicon.ico" />
	<title>Email Sender from Tanateros (c)</title>
<!--
	<link rel="stylesheet" href="/css/jquery-ui.css">
	<link rel="stylesheet" href="/css/jquery-ui.structure.min.css">
-->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	<script src="http://code.angularjs.org/1.1.5/angular.min.js"></script>
	<script src="/js/script.js"></script>
	<script src="/js/ckeditor/ckeditor.js"></script>
<!--
	<script src="/js/jquery-1.11.0.min.js"></script>
	<script src="/js/jquery-ui.js"></script>
-->
  </head>
  <body>
    <div class="container">
		<div ng-app="test-app">
		  <form action="" ng-controller="ctrlForm" name="form" ng-submit="submit()">
			<div class="form-group">
				<label><a href="/grabber">Собрать почтовую базу</a></label>
			</div>
			<div class="form-group">
				<label>Тема письма:</label>
				<input type="text" class="form-control" placeholder="Тема письма" ng-model="title"  />
			</div>
			<div class="form-group">
				<label>Имя отправителя:</label>
				<input type="text" class="form-control" placeholder="Имя отправителя" ng-model="name"  />
			</div>
			<div class="form-group">
				<label>E-MAIL отправителя:</label>
				<input type="email" class="form-control" placeholder="E-MAIL отправителя" ng-model="email"  />
			</div>
			<div class="form-group">
				<label>Тект письма:</label>
				<textarea id="editor1" ng-model="text" class="form-control" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label>Список почтовых адресов (в столбик):</label>
				<textarea ng-model="listmail" class="form-control" rows="3">{{listmail}}</textarea>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" id="send-button" class="btn btn-default">Отправить</button>
					<input class="btn btn-default" type="button" id="stop" value="Стоп" />
				</div>
			</div>
			<script type="text/javascript">CKEDITOR.replace( 'editor1');</script>
			<div class="form-group">
				<label class="col-sm-12 control-label">Количество отправок (по 1 шт. в 5 сек.): <input type="text" class="btn btn-default" disabled id="iterator" value="0" /></label>
				<div class="col-sm-8">
				  <p class="form-control-static"></p>
				</div>
			</div>
		  </form>
		<input type="hidden" id="hidden-flag" value="0" />
		</div>
		<script>
			var i = 0, flag=false;
			document.getElementById('send-button').onclick = function() {
				flag=true;
				document.getElementById("stop").style.display = 'block';
				document.getElementById("send-button").style.display = 'none';
			}
			document.getElementById('stop').onclick = function() {
				flag=false;
				document.getElementById('send-button').innerHTML = "Продолжить";
				document.getElementById("stop").style.display = 'none';
				document.getElementById("send-button").style.display = 'block';
			}
			function iteration() {
				i+=1;
				document.getElementById('iterator').value=i;
				document.getElementById('send-button').click();
			}
			var timer = setInterval(function(){ 
					if(flag==true && document.getElementById('hidden-flag').value!='0')
						iteration();
				}, 5000);
		</script>
    </div> 	
<!--
	<script src="/js/bootstrap.min.js"></script>
-->
  </body>
</html>