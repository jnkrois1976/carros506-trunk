	<?php $this->load->view('includes/header'); ?>
	<section class="authenticate">
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('auth_failed_header')?></h1>
				<div class="leftWrapper">
    				<h5>
    					Por favor siga las instrucciones que se le enviaron por correo electr&oacute;nico cuando se registr&oacute;, para poder autenticar esta cuenta.<br /><br />
    					Una vez que su cuenta haya sido autenticada podr&aacute; crear anuncios sin restricciones.
    				</h5>
    				<br /><br />
    				<p style="margin-left:10px;">
    					Si necesita que le enviemos nuevamente las instrucciones para autenticar su cuenta, nada mas haga click en el siguiente bot&oacute;n:<br /><br />
    					<a href="/profile/auth_instructions" class="buttonLink">Enviar instrucciones</a>
    				</p>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>