	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h1><?php echo $this->session->userdata('username'); ?>, por favor autentique su cuenta, Gracias!</h1>
				<p>
					<h6 style="color: #ac0000;">Para poder crear un anuncio, necesito que autentique su cuenta.</h6><br />
					Le acabo de enviar un mensaje por correo electr&oacute;nico con instrucciones para autenticar la cuenta.
				</p>
				<br />
				<h6>Mientras tanto, aqu&iacute; tiene 3 opciones:</h6>
				<div class="newListingBox">
					<span style="text-align: left;">
						<h5>Crear un anuncio nuevo*</h5>
					</span>
					<br />
					<a href="/profile/choose_ad">
						<img class="" src="/images/new_ad.jpg" />
					</a>
					<br /><br />
					<a href="/profile/choose_ad" class="secondaryButton">Crear Anuncio Nuevo*</a>
				</div>
				<div class="newListingBox">
					<span style="text-align: left;">
						<h5>Busque un carro</h5>
					</span>
					<br />
					<a href="/site/index">
						<img class="" src="/images/go_home.jpg" />
					</a>
					<br /><br />
					<a href="/site/index" class="secondaryButton">Ir al Inicio</a>
				</div>
				<div class="newListingBox" style="margin-right: 0px">
					<span style="text-align: left;">
						<h5>Ver o editar su perfil</h5>
					</span>
					<br />
					<a href="/profile/member">
						<img class="" src="/images/goto_profile.jpg" />
					</a>
					<br /><br />
					<a href="/profile/member" class="secondaryButton">Ver su Perfil</a>
				</div>
				
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>