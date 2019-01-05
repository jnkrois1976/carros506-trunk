<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
		<div class="mainContentPages">
			<h2>Escoja su anuncio</h2>
			<div class="horizontalBlock">
				<div class="adTypes">
					<div class="actions">
						<a href="/profile/new_basic_ad" class="secondaryButton"><span style="text-decoration:line-through">$1</span>&nbsp; Gratis*</a>
					</div>
					<br /><br />
					<h5>Resumido</h5><?php //print_r($user_cat); ?>
					<p>
						Anuncios resumidos contienen &uacute;nicamente la informaci&oacute;n principal del carro, tal como:
					</p>
					<ul class="adDesc">
						<li>Marca</li>
						<li>Modelo</li>
						<li>A&ntilde;o</li>
						<li>Kilometraje</li>
						<li>Hasta 5 fotograf&iacute;as</li>
					</ul>
					<p>Publicaci&oacute;n por 30 d&iacute;as*</p>
					<div class="actions">
						<a href="/profile/new_basic_ad" class="secondaryButton"><span style="text-decoration:line-through">$1</span>&nbsp; Gratis*</a>
					</div>
				</div>
				<div class="adTypes">
					<div class="actions">
						<a href="/profile/new_detailed_ad" class="secondaryButton"><span style="text-decoration:line-through">$2</span>&nbsp; Gratis*</a>
					</div>
					<br /><br />
					<h5>Detallado</h5>
					<p>
						Anuncios detallados contienen informaci&oacute;n detallada del carro, tal como:
					</p>
					<ul class="adDesc">
						<li>Marca</li>
						<li>Modelo</li>
						<li>A&ntilde;o</li>
						<li>Kilometraje</li>
						<li>Tipo de motor</li>
						<li>Tipo de carrocer&iacute;a</li>
						<li>Tipo de combustible</li>
						<li>Tipo de transmisi&oacute;n</li>
						<li>Galer&iacute;a de hasta 10 fotograf&iacute;as</li>
					</ul>
					<p>
						Adem&aacute;s, el anuncio se mostrar&aacute; en una p&aacute;gina individual y los visitantes podr&aacute;n enviar mensajes
						directamente al vendedor y/o agregar comentarios acerca del carro.
					</p>
					<p>Publicaci&oacute;n por 30 d&iacute;as*</p>
					<div class="actions">
						<a href="/profile/new_detailed_ad" class="secondaryButton"><span style="text-decoration:line-through">$2</span>&nbsp; Gratis*</a>
					</div>
				</div>
				<div class="adTypes">
					<div class="actions">
						<a href="/profile/new_full_ad" class="secondaryButton"><span style="text-decoration:line-through">$3</span>&nbsp; Gratis*</a>
					</div>
					<br /><br />
					<h5>Completo</h5>
					<p>
						Anuncios completos contienen toda la informaci&oacute;n relevante acerca del carro, tal como:
					</p>
					<ul class="adDesc">
						<li>Marca</li>
						<li>Modelo</li>
						<li>A&ntilde;o</li>
						<li>Kilometraje</li>
						<li>Tipo de motor</li>
						<li>Tipo de carrocer&iacute;a</li>
						<li>Tipo de combustible</li>
						<li>Tipo de transmisi&oacute;n</li>
						<li>Tipo de tracci&oacuten;</li>
						<li>Estado f&iacute;sico del carro</li>
						<li>Estado legal del carro</li>
						<li>Color</li>
						<li>Cent&iacute;metros C&uacute;bicos</li>
						<li>N&uacute;mero de puertas</li>
						<li>Detalles adicionales acerca de accesorios y/o extras</li>
						<li>Galer&iacute;a de hasta 20 fotograf&iacute;as</li>
					</ul>
					<p>
						No solamente podr&aacute; recibir mensajes y comentarios acerca del carro, tambi&eacute;n puede compartir directamente su anuncio
						en redes sociales como Facebook, Twitter y Google+
					</p>
					<p>Publicaci&oacute;n por 30 d&iacute;as*</p>
					<div class="actions">
						<a href="/profile/new_full_ad" class="secondaryButton"><span style="text-decoration:line-through">$3</span>&nbsp; Gratis*</a>
					</div>
				</div>
			</div>
		</div>
		<div id="promotionNotice" style="display:none; text-align:center;">
			<h2 style="border:none;">Por motivo del lanzamiento de este sitio, todos los anuncios son gratis hasta el 31 de Diciembre del 2013.</h2>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<?php $this->load->view('includes/footer'); ?>