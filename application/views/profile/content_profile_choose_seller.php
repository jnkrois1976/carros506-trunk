	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<h1>
					Qu&eacute; tipo de vendedor es usted?
				</h1>
				<p style="margin-left: 10px;">
					Por favor seleccione que tipo de vendedor es usted.<br /><br />
					Si usted vende carros ocasionalmente, selecione vendedor privado.<br />
					De lo contrario, si usted tiene m&uacute;ltiples carros para la venta seleccione agencia.
				</p>
				<div class="buttonWrapper">
					<div class="actions">
						<a href="/profile/seller_type_private" class="secondaryButton">Vendedor Privado</a>
					</div>
					<div class="actions">
						<a href="/profile/seller_type_dealer" class="secondaryButton">Agencia / Distribuidor</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>