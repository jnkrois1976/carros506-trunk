	<?php $this->load->view('includes/header'); ?>
	<section class="acerca">
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pages_about_header')?></h1>
				<div class="leftWrapper">
					<h5>Bienvenido y gracias por su interes!</h5>
					<p>
					    Gu&iacute;a de uso:
					    <ol>
					        <li><a href="#registro" class="plainLink">Registro (crear una cuenta)</a></li>
					        <li><a href="#perfil" class="plainLink">Ver o modificar su perfil</a></li>
					        <li><a href="#crear_anuncio" class="plainLink">Crear un anuncio nuevo</a></li>
					        <li><a href="#editar_anuncio" class="plainLink">Editar un anuncio</a></li>
					        <li><a href="#ver_mensajes" class="plainLink">Ver mensajes y comentarios</a></li>
					    </ol>
					</p>
					<hr />
					<p>
					    <a name="registro"><h5>Registrarse</h5></a><br />
						Para poder utilizar la mayoria de las funciones de este sitio, lo primero que hay <br />que hacer es registrarse con su direcci&oacute;n de correo electr&oacute;nico y una contrase&ntilde;a.<br /><br />
						<img src="/images/register.png" class="imgDecor" /><br /><br />
						Si tan solo desea ver los carros disponibles para la venta, lo puede hacer sin registrarse.<br /><br />
						Una vez que haya creado su cuenta, podr&aacute; a&ntilde;adir comentarios, enviar mensajes, a&ntilde;adir a sus favoritos, calificar carros, <br />compartir con amigos y hasta reportar el anuncio.<br /><br />
						Al registrarse, por favor incluya su nombre completo (nombre y dos apellidos), su direcci&oacute;n de correo electr&oacute;nico y cualquier <br />contrase&ntilde;a que usted eliga.<br /><br />
						<img src="/images/registerForm.png" class="imgDecor" width="75%" /><br /><br />
						Al momento de crear su cuenta, le enviaremos un mensaje por correo electr&oacute;nico, solicitandole que autentique su cuenta (esto es requerido <br />solamente si desea publicar un anuncio).<br /><br />
						Luego de haberse registrado tendr&aacute; acceso a su cuenta, desde ah&iacute; podr&aacute; administrar sus anuncios, ver y responder a mensajes, 
						modificar su perfil <br />o anuncio(s) y crear anuncios nuevos.<br /><br />
						<img src="/images/account.png" class="imgDecor" />&nbsp;<img src="/images/dashboard.png" class="imgDecor" height="275" /><br /><br />
					</p>
					<hr />
					<p>
                        <a name="perfil"><h5>Ver o modificar su perfil</h5></a><br />
                        Si as&iacute; lo desea puede completar su perfil, sin embargo esto es requerido &uacute;nicamente si <br />tiene pensado publicar un anuncio.<br /><br />
                        <img src="/images/incomplete_profile.png" class="imgDecor" width="500" /><br /><br />
                    </p>
                    <hr />
                    <p>
                        <a name="crear_anuncio"><h5>Crear un anuncio nuevo</h5></a><br />
                        Si es su primera vez creando un anuncio, deber&aacute; seleccionar que tipo de vendedor es usted, ya sea privado o agencia.<br /><br />
                        <img src="/images/select_seller.png" class="imgDecor" width="75%" /><br /><br />
                        Como vendedor privado puede escojer entre un anuncio b&aacute;sico, detallado o completo, y como agencia puede escojer entre un <br />anuncio completo individual o crear anuncios para varios carros a la vez.<br /><br />
                        Todos los anuncios ser&aacute;n creados y publicados inmediatamente, excepto cuando utilize la opci&oacute;n de anuncios multiples (agencia).<br />
                        En dado caso, debera agregar fotos y detalles adicionales del carro individualmente, una vez hecho esto, los anuncios ser&aacute;n <br />publicados automaticamente.<br /><br />
                        <img src="/images/new_listing_form.png" class="imgDecor" width="75%" /><br /><br />
                    </p>
                    <hr />
                    <p>
                        <a name="editar_anuncio"><h5>Editar un anuncio</h5></a><br />
                        En la seccion de "Mis Anuncios" podra editar cualquier anuncio, asi como extender la duraci&oacute;on de la publicaci&oacute;n, agregar o eliminar fotos y marcar el anuncio como "vendido".<br /><br />
                        <img src="/images/edit_listing.png" class="imgDecor" width="75%" /><br /><br />
                    </p>
                    <hr />
                    <p>
                        <a name="ver_mensajes"><h5>Ver mensajes y comentarios</h5></a><br />
                        Su anuncio puede recibir tanto comentarios como mensajes privados.<br /><br />
                        Comentarios hechos por compradores son privados hasta que usted decida hacerlos publicos.<br />
                        Si usted responde a un comentario, automaticamente se hara publico, de lo contrario, permanecer&aacute; privado. 
                        Sin embargo <br />usted puede hacer que el comentario sea privado de nuevo, aun despues de haber respondido.<br /><br />
                        Mensajes son extrictamemte privados entre el comprador y usted. Nadie, excepto usted puede ver el mensaje y si usted responde, <br />la respuesta le ser&aacute; enviada unicamente al comprador.<br /><br />
                        <img src="/images/msg_and_cmt.png" class="imgDecor" width="75%" /><br /><br />
                    </p>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>