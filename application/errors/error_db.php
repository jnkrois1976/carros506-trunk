<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carros506 - Veh&iacute;culos usados en Costa Rica</title>

	<link rel="shortcut icon" href="/favicon.ico" />
	<link media="screen" rel="stylesheet" href="/css/normalize.css" />
	<link media="screen" rel="stylesheet" href="/css/frame.css" />
	<link media="screen" rel="stylesheet" href="/css/format.css" />
	<link media="screen" rel="stylesheet" href="/css/common.css" />
	<link media="screen" rel="stylesheet" href="/css/forms.css" />
	<link media="screen" rel="stylesheet" href="/css/publicidad.css" />
	<link media="screen" rel="stylesheet" href="/css/flick/jquery-ui-1.8.14.custom.css" />
	<link media="screen" rel="stylesheet" href="/css/slider/default/default.css" />

	<link media="screen" rel="stylesheet" href="/css/slider/nivo-slider.css" />
	<script src="/js/modernizr.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="/js/jquery.js"></script>
	<script src="/js/jquery_ui.js"></script>
	<script src="/js/jquery.sticky.js"></script>
	<script>
		var nativeScreenHeight = window.innerHeight;
		$(window).load(function(){
			$(".mainNav").sticky({ topSpacing: 0, className: 'darkNav' });
		});
	</script>
</head>

<body>
    <header>
		<div class="innerHeader">
			<div class="loginBox">
				<h4>Ingresar</h4>
				<form method="post" action="/login/validate" id="loginForm" novalidate="novalidate">
					<fieldset>
						<label for="email">Email: </label>

						<input type="email" name="email" id="emailLogin" value="" placeholder="Correo electr&oacute;nico..." data-error="Por favor digite una direcci&oacute;n de correo v&aacute;lida" onclick="this.select();"/>
						<label for="password">Contrase&ntilde;a: </label>
						<input type="password" name="password" id="passwordLogin" value="" placeholder="********" data-error="Por favor digite su contrase&ntilde;a" onclick="this.select();"/>
						<input type="submit" value="Ingresar" name="login" id="login" /><span id="login_failed"></span>
					</fieldset>
				</form>
				<div>
					<a href="#">Olvido su contrase&ntilde;a?</a>

					<a href="#" id="closeLogin">Cerrar</a>
				</div>
			</div>
			<div class="registerBox">
				<h4>Registrarse</h4>
				<form method="post" action="/account/create" id="registerForm" novalidate="novalidate">
					<fieldset>
						<input type="text" name="name" id="nameRegister" value="" placeholder="Nombre completo..." autocomplete="off" data-errorChar="Por favor digite &uacute;nicamente caracteres del alfabeto!" data-errorEmpty="Por favor digite su nombre completo!" onclick="this.select();"/>

						<input type="email" name="email" id="emailRegister" value="" placeholder="Correo electr&oacute;nico..." autocomplete="off" data-errorChar="Por favor digite una direcci&oacute;n de correo v&aacute;lida" data-errorEmpty="Por favor digite su direcci&oacute;n de correo" onclick="this.select();"/>
						<input type="password" name="password" id="passwordRegister" value="" placeholder="Contrase&ntilde;a..." autocomplete="off" data-errorEmpty="Por favor digite su contrase&ntilde;a" onclick="this.select();"/>
						<input type="password" name="confirmPassword" id="confirmPassword" value="" placeholder="Confirmar contrase&ntilde;a..." autocomplete="off" data-errorEmpty="Por favor digite su contrase&ntilde;a" data-errorMatch="Las contrase&ntilde;as deben ser iguales" onclick="this.select();"/>
						<input type="submit" value="Registrarse" name="register" id="register"/>
					</fieldset>
				</form>
				<div>
					<a href="#">Al registrarse usted acepta los t&eacute;rminos y condiciones.</a>

					<a href="#" id="closeRegister">Cerrar</a>
				</div>
			</div>
			<div class="topLinks">
				<nav class="loginRegister">
					<ul id="memberLinks">
						<li><a href='/profile/log_out'id='logmeout'>Salir</a></li><li class='welcome'>Bienvenido(a) <strong>Juan Carlos</strong>!</li>					</ul>

				</nav>
			</div>
			<div class="logoBar">
				<div class="logoWrapper">
					<img src="/svg/logo.svg" alt="Carros506.com" />
				</div>
				<div class="postedAds"></div>
			</div>
		</div>
    </header>
    <nav class="mainNav">
        <ul class="mainNavLinks">
            <li>
                <a href="/site/index"><img src="/svg/home_icon.svg"/> Inicio</a><!-- remove inline style and reduce svg image -->

            </li>
            <li id="searchBy">
                <a href="#"><img src="/svg/search_icon_small.svg"/> Buscar por Categor&iacute;a &#9660;</a>
				<ul class="subItem" id="subItemMenu">
					<li class="subItemLink">
						<a href="#">Marca &#9656;</a>
						<ul class="subItemNested" id="nestedMake">

															<li class="nestedLink">
									<a href="/resultados/categorias/marca_Audi">Audi</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Dodge">Dodge</a>
								</li>
                            						</ul>
					</li>

					<li class="subItemLink">
						<a href="#">Carrocer&iacute;a &#9656;</a>
						<ul class="subItemNested" id="nestedCarroceria">
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_sedan">Sedan</a>
							</li>
							<li class="nestedLink">

								<a href="/resultados/categorias/carroceria_station">Station Wagon</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_suv">Sport Utility Vehicle (SUV)</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_hatchback">Hatchback</a>

							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_minivan">Minivan</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_coupe">Coupe</a>
							</li>
							<li class="nestedLink">

								<a href="/resultados/categorias/carroceria_convertible">Convertible</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_deportivo">Deportivo</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_pickup">Pickup</a>

							</li>
							
							<li class="nestedLink">
								<a href="/resultados/categorias/carroceria_van">Van</a>
							</li>
						</ul>
					</li>
					<li class="subItemLink">
						<a href="#">Motor &#9656;</a>

						<ul class="subItemNested" id="nestedMotor">
							<li class="nestedLink">
								<a href="/resultados/categorias/motor_4">4 Cilindros</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/motor_6">6 Cilindros</a>
							</li>
							<li class="nestedLink">

								<a href="/resultados/categorias/motor_8">8 Cilindros</a>
							</li>
						</ul>
					</li>
					<li class="subItemLink">
						<a href="#">Transmisi&oacute;n &#9656;</a>
						<ul class="subItemNested" id="nestedTransmision">

							<li class="nestedLink">
								<a href="/resultados/categorias/transmision_manual">Manual</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/transmision_automatico">Autom&aacute;tico</a>
							</li>
						</ul>

					</li>
					<li class="subItemLink">
						<a href="#">Provincia &#9656;</a>
						<ul class="subItemNested" id="nestedProvincia">
							<li class="nestedLink">
								<a href="/resultados/categorias/provincia_sanjose">San Jos&eacute;</a>
							</li>
							<li class="nestedLink">

								<a href="/resultados/categorias/provincia_alajuela">Alajuela</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/provincia_heredia">Heredia</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/provincia_cartago">Cartago</a>

							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/provincia_puntarenas">Puntarenas</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/provincia_limon">Lim&oacute;</a>
							</li>
							<li class="nestedLink">

								<a href="/resultados/categorias/provincia_guanacaste">Guanacaste</a>
							</li>
						</ul>
					</li>
				</ul>
            </li>
            <li>
                <a href="/resultados/aduanas"><img src="/svg/offers_icon.svg"/> Ofertas en Aduanas</a>

            </li>
            <li>
                <a href="/resultados/usados"><img src="/svg/usados_icon.svg"/> Usados</a>
            </li>
			<li>
				<a href="/site/agencias"><img src="/svg/agencias_icon.svg"/> Agencias</a>
			</li>

			<li>
                <a href="/site/anuncios"><img src="/svg/anuncios_icon.svg"/> Anuncios</a>
            </li>
            <li>
                <a href="/site/publicidad"><img src="/svg/publicidad_icon.svg"/> Publicidad</a>
            </li>
            <li id="myAccount">

            	<a href='/profile/dashboard'><img src='/svg/user_icon.svg' alt='Mi Perfil'/> Mi Cuenta</a>
            	<ul class="subItem" id="myAccountMenu">
            		<li class="subItemLink">
            			<a href="/profile/myads">Mis anuncios</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/expired">Vencidos</a>

            		</li>
            		<li class="subItemLink">
            			<a href="/profile/reported">Reportados</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/mymessages">Mis mensajes</a>
            		</li>
            		<li class="subItemLink">

            			<a href="/profile/favorites">Mis favoritos &hearts;</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/member">Mi Perfil</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/choose_ad">Crear Anuncio</a>

            		</li>
            	</ul>
        	</li>
			<!--<li><a href="#">0.0554</a></li>-->
        </ul>
    </nav>
	<section>
		<div class="centerContainer">
		<div class="mainContent">

			<h1>Error en la base de datos</h1>
			<div id="content">
				<h1><?php echo $heading; ?></h1>
				<?php echo $message; ?>
			</div>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<footer>
		<div class="innerFooter">
			<div class="resources">

				<div class="footerBox">
					<h4>Recursos</h4>
					<ul>
						<li><a href="/pages/traspasos" class="plainLink">Traspasos</a></li>
						<li><a href="/pages/riteve" class="plainLink">Riteve</a></li>
						<li><a href="/pages/marchamo" class="plainLink">Marchamo</a></li>
						<li><a href="/pages/impuestos" class="plainLink">Impuestos de Importaci&oacute;n</a></li>

						<li><a href="/pages/seguros" class="plainLink">Seguros</a></li>
					</ul>
				</div>
				<div class="footerBox">
					<h4>Consejos</h4>
					<ul>
						<li><a href="/pages/consejos" class="plainLink">Va a comprar un carro usado?</a></li>

						<li><a href="/pages/mecanicos" class="plainLink">Preguntele a un mecanico</a></li>
						<li><a href="/pages/compare" class="plainLink">Nuevo vs Usado</a></li>
						<li><a href="/pages/seguridad" class="plainLink">Seguridad Vial</a></li>
						<li><a href="/pages/accesorios" class="plainLink">Accesorios</a></li>
					</ul>
				</div>
				<div class="footerBox">

					<h4>Acerca de esta p&aacute;gina</h4>
					<ul>
						<li><a href="/pages/acerca" class="plainLink">Quienes Somos</a></li>
						<li><a href="/pages/privacidad" class="plainLink">Pol&iacute;tica de privacidad</a></li>
						<li><a href="/pages/terminos" class="plainLink">T&eacute;rminos y condiciones</a></li>

						<li><a href="/pages/contactenos" class="plainLink">Contactenos</a></li>
						<li><a href="/pages/preguntas" class="plainLink">Preguntas frecuentes</a></li>
					</ul>
				</div>
			</div>
			<div class="copy">
				Derechos Reservados&copy; 2012 - carros<strong><em>506</em></strong>.com 
			</div>

		</div>
	</footer>
	<script>
	    var getContentHeight = document.getElementsByTagName('section')[0];
	    var contentHeight = getContentHeight.clientHeight;
	    var setContentheight = nativeScreenHeight - 372;
	    if(contentHeight < setContentheight){
	        getContentHeight.style.height = setContentheight + "px";
	    }
</script>
	<script>
		var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID 
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
	</script>
</body>
</html>