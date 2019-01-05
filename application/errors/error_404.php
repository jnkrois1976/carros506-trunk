<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carros506 - P&aacute;gina no encontrada!</title>
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
						<li><a href='/profile/log_out'id='logmeout'>Salir</a></li><li class='welcome'>Bienvenido(a) <strong>Juan Carlos</strong>!</li>
					</ul>
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
        <div class="navWrapper">
        <ul class="mainNavLinks">
            <li>
                <a href="/site/index"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
						<polygon fill="none" points="4.5,6.3 4.5,13.5 7.5,13.5 7.5,10.5 9.5,10.5 9.5,13.5 12.5,13.5 12.5,6.3 8.5,3.5"></polygon>
						<path fill="#FFFFFF" d="M8 0L0 8h2v8h12V8h2L8 0z M12 14H9v-3H7v3H4V6.828L8 4l4 2.828V14z"></path>
					</svg> Inicio</a>
            </li>
            <li id="searchBy">
                <a href="/resultados/categorias">
                	<svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                		<g>
                			<path fill="#FFFFFF" d="M10.001 0C13.314 0 16 2.7 16 6c0 3.315-2.686 6-5.999 6C6.687 12 4 9.3 4 6C4 2.7 6.7 0 10 0 M10.001 2C7.795 2 6 3.8 6 6c0 2.2 1.8 4 4 4C12.206 10 14 8.2 14 6C14 3.8 12.2 2 10 2L10.001 2z"></path>
            			</g>
            			<rect x="0.3" y="10" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -7.314 6.3437)" fill="#FFFFFF" width="7.3" height="4"></rect>
        			</svg>
                	Buscar por Categoría                 	<span style="color:#3B6083;">▼</span>
            	</a>
				<ul class="subItem" id="subItemMenu" style="display: none;">
					<li class="subItemLink">
						<a href="#">Marca ▸</a>
						<ul class="subItemNested" id="nestedMake" style="-webkit-column-count: 2; width: 260px; display: none;">
															<li class="nestedLink">
									<a href="/resultados/categorias/marca_Acura">Acura</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Audi">Audi</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_BMW">BMW</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Chevrolet">Chevrolet</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Dodge">Dodge</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Fiat">Fiat</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Ford">Ford</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Honda">Honda</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Hyundai">Hyundai</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Infiniti">Infiniti</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Jeep">Jeep</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Kia">Kia</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Lexus">Lexus</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Maserati">Maserati</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Mazda">Mazda</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Mercedes Benz">Mercedes Benz</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Nissan">Nissan</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Pontiac">Pontiac</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Porshe">Porshe</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Range Rover">Range Rover</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Subaru">Subaru</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Suzuki">Suzuki</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Toyota">Toyota</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Volkswagen">Volkswagen</a>
								</li>
                            								<li class="nestedLink">
									<a href="/resultados/categorias/marca_Volvo">Volvo</a>
								</li>
                            						</ul>
					</li>
					<li class="subItemLink">
						<a href="#">Carrocería ▸</a>
						<ul class="subItemNested" id="nestedCarroceria" style="display: block;">
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
						<a href="#">Motor ▸</a>
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
							<li class="nestedLink">
								<a href="/resultados/categorias/motor_8">10 Cilindros</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/motor_8">12 Cilindros</a>
							</li>
						</ul>
					</li>
					<li class="subItemLink">
						<a href="#">Transmisión ▸</a>
						<ul class="subItemNested" id="nestedTransmision">
							<li class="nestedLink">
								<a href="/resultados/categorias/transmision_manual">Manual</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/transmision_automatico">Automático</a>
							</li>
						</ul>
					</li>
					<li class="subItemLink">
						<a href="#">Provincia ▸</a>
						<ul class="subItemNested" id="nestedProvincia">
							<li class="nestedLink">
								<a href="/resultados/categorias/location_sanjose">San José</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_alajuela">Alajuela</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_heredia">Heredia</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_cartago">Cartago</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_puntarenas">Puntarenas</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_limon">Limón</a>
							</li>
							<li class="nestedLink">
								<a href="/resultados/categorias/location_guanacaste">Guanacaste</a>
							</li>
						</ul>
					</li>
				</ul>
            </li>
            <li>
                <a href="/resultados/aduanas">
                	<svg xmlns="http://www.w3.org/2000/svg" width="12px" height="16px" viewBox="0 0 12 16"><g><path fill="#FFFFFF" d="M12 10.502c-0.364 1.48-1.021 2.625-1.969 3.432c-0.977 0.838-2.193 1.252-3.651 1.238H6.185L5.956 16H4.62 l0.269-0.973c-0.438-0.088-0.846-0.209-1.223-0.361L3.306 16H1.972l0.546-2.002C0.84 12.7 0 10.7 0 7.8 C0 5.8 0.5 4.1 1.6 2.821c1.112-1.334 2.621-2.033 4.529-2.097L6.352 0h1.334L7.462 0.8C7.87 0.9 8.3 1 8.7 1.1 L9 0h1.334l-0.49 1.792c0.921 0.7 1.6 1.7 1.9 3.002L10 5.223C9.815 4.6 9.6 4.1 9.3 3.737L6.629 13.6 c1.921-0.158 3.112-1.338 3.576-3.535L12 10.502z M5.713 2.344C4.399 2.5 3.4 3.1 2.7 4.2 c-0.592 0.947-0.889 2.163-0.889 3.65c0 1.8 0.4 3.3 1.2 4.277L5.713 2.344z M8.252 2.7 C7.906 2.5 7.5 2.4 7 2.354l-2.936 10.71c0.364 0.2 0.8 0.4 1.2 0.438L8.252 2.745z"></path></g></svg>
                	Ofertas en Aduanas            	</a>
            </li>
            <!--<li>
                <a href="/resultados/subasta">
                	<svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16"><path fill="#FFFFFF" d="M16 6.639V0H9.361L0 9.359h6.639V16L16 6.639z M10.439 3.656c0-1.051 0.852-1.903 1.901-1.903 s1.902 0.9 1.9 1.903s-0.853 1.902-1.902 1.902S10.439 4.7 10.4 3.656z"/></svg>
                	Subasta            	</a>
            </li>-->
			<li>
				<a href="/site/agencias">
					<svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
						<circle fill="none" cx="11" cy="5" r="1"></circle>
						<path fill="#FFFFFF" d="M11 0C8.238 0 6 2.2 6 5c0 0.3 0 0.6 0.1 0.908L0 12v4h6v-2h2v-2h2v-2l0.092-0.092 C10.387 10 10.7 10 11 10c2.762 0 5-2.238 5-5S13.762 0 11 0z M11.004 6c-0.553 0-1-0.447-1-1s0.447-1 1-1s1 0.4 1 1 S11.557 6 11 6z"></path>
					</svg> 
					Agencias				</a>
			</li>
			<li>
                <a href="/site/anunciese">
                	<svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
						<path fill="#FFFFFF" d="M16 4c0-2.208-1.793-4-4-4c-1.491 0-2.779 0.829-3.467 2.041C8.352 2 8.2 2 8 2 c-3.312 0-6 2.686-6 6c0 1.3 0.4 2.4 1.1 3.399L0 16l4.645-3.032c0.957 0.6 2.1 1 3.3 1.017c3.314 0 6-2.686 6-6 c0-0.173-0.034-0.334-0.051-0.504C15.16 6.8 16 5.5 16 4z M7.984 11.984c-2.206 0-4-1.795-4-4c0-2.206 1.794-4 4-4 c0.008 0 0 0 0 0.002c0-0.004 0.002-0.007 0.002-0.01C8.002 4 8 4 8 4c0 0.3 0.1 0.7 0.1 1 L6.555 6.586c-0.781 0.781-0.781 2 0 2.828c0.781 0.8 2 0.8 2.8 0l1.57-1.57c0.33 0.1 0.7 0.2 1 0.2 C11.977 10.2 10.2 12 8 11.984z M12 6c-1.102 0-2-0.897-2-2s0.898-2 2-2s2 0.9 2 2S13.102 6 12 6z"></path>
					</svg> 
                	Anuncios            	</a>
            </li>
            <li>
                <a href="/site/publicidad">
                	<svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                		<path fill="#FFFFFF" d="M10.805 0H0v16l3.988-3.32L7.996 16L12 12.686L16 16V5.15L10.805 0z M9 7V2l5 5H9z"></path>
            		</svg>
                	Publicidad            	</a>
            </li>
            
        </ul>
        <ul class="myAccountWrapper">
        	<li id="myAccount">
            	<a href="/profile/dashboard">
            		<svg xmlns="http://www.w3.org/2000/svg" width="12px" height="16px" viewBox="0 0 12 16"><path fill="#FFFFFF" d="M6 8c-3.312 0-6 2.686-6 6c0 1.1 0.9 2 2 2h8c1.105 0 2-0.896 2-2C12 10.7 9.3 8 6 8z"></path><circle fill="#FFFFFF" cx="6" cy="3" r="3"></circle></svg> 
            		Mi Cuenta        		</a>
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
            			<a href="/profile/favorites">Mis favoritos ♥</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/member">Mi Perfil</a>
            		</li>
            		<li class="subItemLink">
            			<a href="/profile/choose_ad">Crear Anuncio</a>
            		</li>
            	</ul>
        	</li>
			<!--<li><a href="#">0.1335</a></li>-->
        </ul>
        </div>
    </nav>
	<section>
		<div class="centerContainer">
		<div class="mainContent">
			<h1>P&aacute;gina no encontrada!</h1>
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