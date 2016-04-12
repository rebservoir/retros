<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Bill Box</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fonts/stylesheet.css"/>
		{!!Html::favicon('img/fav.png')!!}
	</head>

	<body>

	@include('alerts.errors')
	@include('alerts.request')

	<!-- -->
	<div  class="">
		<div id="blue">
		</div>

		<div id="login_box">
			<p><img src="img/logo_tu.jpg" alt="logotipo"></p>

				<form method="POST" action="/auth/login">
				    {!! csrf_field() !!}

				    <div class="form-group">
				        <label>Email</label><br>
				        <input type="email" class="form-control" placeholder="Ingresa tu Email" name="email" value="{{ old('email') }}">
				    </div>

				    <div class="form-group">
				        <label>Contraseña</label><br>
				        <input type="password" class="form-control" placeholder="Ingresa tu Contraseña" name="password" id="password">
				    </div>

				    <div>
				        <button type="submit" class="btn btn-primary">Entrar</button>
				    </div>
				</form>

			<br>

			<a href="/forgot">¿Olvidaste tu contraseña?</a>

		</div>
	</div> <!-- END container-->


		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>

</html>