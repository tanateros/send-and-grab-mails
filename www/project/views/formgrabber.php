<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/favicon.ico" />
	<title>Email Grabber from Tanateros (c)</title>
	
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	<script src="http://code.angularjs.org/1.1.5/angular.min.js"></script>
	<script src="../js/script-grabber.js"></script>
<!--
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/jquery-ui.js"></script>
-->
  </head>
  <body>
    <div class="container">
		<div ng-app="test-app">
		  <form action="" ng-controller="ctrlForm" name="form">
			<div class="form-group">
				<label><a href="http://alta-moda.in.ua/alta-mailer/index.php">Разослать письма</a></label>
			</div>
			<div class="form-group">
				<label>Введите сайт, который нужно пропарсить на e-mail'ы: </label>
				<input ng-model="url" class="form-control" type="text" value="<?=$this->input->get('url');?>" placeholder="http://********" required="required" name="url" style="width: 200px" />
			</div>
			<div class="form-group">
				<label>Список внутренних ссылок: </label>
				<textarea id="listincludeurl" class="form-control" rows="1" value=""></textarea>
			</div>
			<div class="form-group alert alert-success" role="alert" id="stop-search" style="display: none;">
				<label class="alert-link">Поиск завершен</label>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" ng-click="submit()" id="send-button" class="btn btn-default">Отправить</button>
					<button style="display: none;" id="stop-button" class="btn btn-default">Стоп</button>
				</div>
			</div> 
			<div class="form-group">
				<label>Список полученных email'ов: </label>
				<textarea id="listmailparser" ng-model="listmailparser" class="form-control" rows="5"></textarea>
			</div>
		  </form>
		  <script>
			function on() {
				document.getElementById('stop-search').style.display = "none";
				timer = setTimeout(function(){
					document.getElementById('send-button').click();
				}, 3000);
			};
			function off() {
			    clearTimeout(timer);
			}
			  document.getElementById('send-button').onclick = function(){
				document.getElementById('stop-button').style.display = "block";
				document.getElementById('send-button').style.display = "none";
				on();
			  };
			  document.getElementById('stop-button').onclick = function(){
				document.getElementById('send-button').style.display = "block";
				document.getElementById('stop-button').style.display = "none";
				off();
			  };
		  </script>
		</div>
    </div>
<!--
	<script src="js/bootstrap.min.js"></script>
-->
  </body>
</html>