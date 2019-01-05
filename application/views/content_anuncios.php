	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pages_ads_header')?></h1>
				<h5><?=$this->lang->line('pages_ads_subhead1')?></h5>
				<p><?=$this->lang->line('pages_ads_parra1')?></p>
				<div class="horizontalBlock">
				<div class="adTypes">
					<h5>B&aacute;sico</h5>
					<p>
						Anuncios b&aacute;sicos contienen &uacute;nicamente la informaci&oacute;n principal del carro, tal como:
					</p>
					<ul class="adDesc">
						<li>Marca</li>
						<li>Modelo</li>
						<li>A&ntilde;o</li>
						<li>Kilometraje</li>
						<li>Hasta 5 fotograf&iacute;as</li>
					</ul>
					<p>Publicaci&oacute;n por 30 d&iacute;as*</p>
					<img id="sample_basic_trigger" class="sample_ads" src="/images/sample_basic_add.png"/>
					<img id="lgsample_basic_add" src="/images/lgsample_basic_add.png"/>
				</div>
				<div class="adTypes">
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
					<img id='sample_detailed_trigger' class="sample_ads" src="/images/sample_detailed_add.png"/>
					<img id="lgsample_detailed_add" src="/images/lgsample_detailed_add.png"/>
				</div>
				<div class="adTypes">
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
						<li>Tipo de tracci&oacute;n</li>
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
					<img id="sample_full_trigger" class="sample_ads" src="/images/sample_full_add.png"/>
					<img id="lgsample_full_add" src="/images/lgsample_full_add.png"/>
				</div>
			</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<?php $this->load->view('includes/footer'); ?>