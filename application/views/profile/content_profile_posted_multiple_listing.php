	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<?php if($last_multiple_posting): ?>
					<h1>Y&aacute; termin&eacute; de crear sus anuncios, Gracias <?php echo $this->session->userdata('member_name'); ?></h1><br />
					<h6 class="attention">MUY IMPORTANTE<br />Sus anuncios ya estan listos, pero para poder mostralos en los resultados de busqueda, <br />necesito que les agregue por lo menos una foto.</h6><br /><br />
					<div class="carThumbWrapper">
					<?php foreach($last_multiple_posting as $post_row): ?>
						<div class="carThumb <?php echo $condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
							<span class="shortDesc">
								<h2><?php echo $post_row->ad_marca ." ".$post_row->ad_modelo." - ". $post_row->ad_year; ?></h2><br />
								<?php 
									if ($post_row->ad_pictures == "1") {
										echo "<h5>".$post_row->ad_pictures ." Foto</h5>";
									}elseif($post_row->ad_pictures > "1" || $post_row->ad_pictures == "0"){
										echo "<h5>".$post_row->ad_pictures ." Fotos</h5>"; 
									}
								?><br />
								<h5>&#8353;
									<?php
										setlocale(LC_MONETARY, 'it_IT');
										echo money_format('%!.0n', $post_row->ad_precio);
									?>
								</h5>
							</span>
							<a href="/profile/ad_details/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>" class="secondaryButton" target="_blank">Agregar fotos y detalles</a>
						</div>
					<?php endforeach; ?>
					</div>
				<?php elseif(!$last_multiple_posting): ?>
					<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="90%" valign="center" align="center">
									<h5>No ha publicado ning&uacute;n anuncio hoy!</h5>
								</td>
								<td width="10%" valign="center" align="left">
									<img src="/images/exclamation.png" />
								</td>
							</tr>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>