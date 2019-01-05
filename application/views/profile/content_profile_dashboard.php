	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h2>Dashboard</h2><br />
				<div class="dashBox">
					<h5>Mis Anuncios</h5><br />
					<table cellpadding="0" cellspacing="0" border="0">
						<colgroup width="30%"></colgroup>
						<colgroup width="70%"></colgroup>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $active_ads_per_member; ?>
								</span>
							</td>
							<td>anuncios vigentes</td>
						</tr>
						<tr>
							<td>
								<span class="xlarge attention">
									<?php echo $expired_ads_per_member; ?>
								</span>
							</td>
							<td>anuncios vencidos</td>
						</tr>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $ads_per_member; ?>
								</span>
							</td>
							<td>anuncios en total</td>
						</tr>
					</table><br />
					<a class="secondaryButton" href="/profile/myads">Anuncios vigentes (<?php echo $active_ads_per_member; ?>)</a>
					<a class="secondaryButtonAttention" href="/profile/expired">Anuncios vencidos (<?php echo $expired_ads_per_member; ?>)</a>
				</div>
				<div class="dashBox">
					<h5>Comentarios y consultas</h5><br />
					<table cellpadding="0" cellspacing="0" border="0">
						<colgroup width="30%"></colgroup>
						<colgroup width="70%"></colgroup>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $count_messages; ?>
								</span>
							</td>
							<td>consultas recibidas</td>
						</tr>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $count_comments; ?>
								</span>
							</td>
							<td>comentarios agregados</td>
						</tr>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $count_comments + $count_messages; ?>
								</span>
							</td>
							<td>mensajes en total</td>
						</tr>
					</table><br />
					<a class="secondaryButton" href="/profile/mymessages">Ver mis mensajes (<?php echo $count_comments + $count_messages; ?>)</a>
				</div>
				<div class="dashBox">
					<h5>Mis favoritos y reportados</h5><br />
					<table cellpadding="0" cellspacing="0" border="0">
						<colgroup width="30%"></colgroup>
						<colgroup width="70%"></colgroup>
						<tr>
							<td>
								<span class="xlarge">
									<?php echo $get_total_favorites; ?>
								</span>
							</td>
							<td>favoritos</td>
						</tr>
							<td>
								<span class="xlarge attention">
									<?php echo $get_total_reported; ?>
								</span>
							</td>
							<td>reportados</td>
						</tr>
							<td>
								<span class="xlarge">
									<?php echo $get_total_favorites + $get_total_reported; ?>
								</span>
							</td>
							<td>favoritos y/o reportados total</td>
						</tr>
					</table><br />
					<a class="secondaryButton" href="/profile/favorites">Ver  mis favoritos (<?php echo $get_total_favorites; ?>)</a>
					<a class="secondaryButtonAttention" href="/profile/reported">Ver reportados (<?php echo $get_total_reported; ?>)</a>
				</div>
				<div class="dashBox">
					<h5>Informaci&oacute;n del Contacto</h5><br />
					<table cellpadding="0" cellspacing="0" border="0">
						<colgroup width="40%"></colgroup>
						<colgroup width="60%"></colgroup>
						<tr>
							<td>Vendedor: </td>
							<td>
								<?php
									$define_seller_cat = $getcontact['contact_categoria'];
									if($getcontact['contact_categoria'] == "PR"){
										echo "Privado";
									}elseif($getcontact['contact_categoria'] == "AG"){
										echo "Agencia";
									}else{
										echo "-";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>C&oacute;digo:</td>
							<td><?php echo $this->session->userdata('member_id'); ?></td>
						</tr>
						<tr>
							<td>Nombre:</td>
							<td><span class="cliptext"><?php echo $getcontact['contact_fullname']; ?></span></td>
						</tr>
						<tr>
							<td>Tel&eacute;fono:</td>
							<td><?php echo $getcontact['contact_phone']; ?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><span class="cliptext"><?php echo $getcontact['contact_email']; ?></span></td>
						</tr>
					</table><br />
					<a href="/profile/member" class="secondaryButton">Ver perfil completo</a>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>