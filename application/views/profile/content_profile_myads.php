	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<div>
					<h2 style="clear: both;">Anuncios vigentes: <?php echo $active_ads_per_member; ?></h2>
				</div>
				<?php if($ads_query): ?>
					<div class="adsWrapper">
						<?php setlocale(LC_MONETARY, 'it_IT'); ?>
						<?php foreach($ads_query as $ads_query_row): ?>
							<?php 
								$img_folder = strtolower($ads_query_row->ad_idprefix).$ads_query_row->ad_id;
								$folder_path = 'cars/small_thumb/'.$img_folder.'/';
								$images = get_filenames($folder_path);
							?>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" class="visible">
								<colgroup>
									<col width="20%" />
									<col width="30%" />
									<col width="25%" />
									<col width="25%" />
								</colgroup>
								<thead>
									<tr>
										<th>
											<?php echo $ads_query_row->ad_marca.' '.$ads_query_row->ad_modelo; ?>
										</th>
										<th>
											&#8353; <?php echo money_format('%!.0n', $ads_query_row->ad_precio); ?>
										</th>
										<th>
											C&oacute;digo <?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>
										</th>
										<th>
											<?php if($ads_query_row->ad_categoria == "A"): ?>
												Anuncio Completo
											<?php elseif($ads_query_row->ad_categoria == "B"): ?>
												Anuncio Detallado
											<?php elseif($ads_query_row->ad_categoria == "C"): ?>
												Anuncio B&aacute;sico
											<?php endif; ?>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Mensajes:</td>
										<td>
											<?php echo $ads_query_row->ad_messages; ?>
										</td>
										<td rowspan="5">
											<?php if($images): ?>
												<img src="/cars/small_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" />
											<?php elseif(!$images): ?>
											<img src="/cars/small_thumb/no_image.jpg" />
											<?php endif; ?>
										</td>
										<td rowspan="5">
											<a class="secondaryButton" href="/profile/ad_details/<?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>">Ver/Editar Detalles</a><br /><br />
											<?php if($ads_query_row->ad_categoria == "A"): ?>
												<a class="secondaryButton" href="/resultados/anuncio/<?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>">Ver al anuncio</a>
											<?php elseif($ads_query_row->ad_categoria == "B"): ?>
												<a class="secondaryButton" href="/resultados/anuncio_medio/<?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>">Ver al anuncio</a>
											<?php elseif($ads_query_row->ad_categoria == "C"): ?>
												<a class="secondaryButton" href="/resultados/anuncio_basico/<?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>">Ver al anuncio</a>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td>Visitas:</td>
										<td>
											<?php echo $ads_query_row->ad_visits; ?>
										</td>
									</tr>
									<tr>
										<td>Comentarios:</td>
										<td>
											<?php echo $ads_query_row->ad_comments; ?>
										</td>
									</tr>
									<tr>
										<td>Expira el: </td>
										<td>
											<?php 
												$break_date = explode('-', $ads_query_row->ad_expires);
												setlocale(LC_TIME, "es_ES"); 
												echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date[1], $break_date[2], $break_date[0]));
											?>
										</td>
									</tr>
								</tbody>
							</table>
						<?php endforeach; ?>
						<?php echo $this->pagination->create_links(); ?>
					</div>
					<div class="newListingBox" style="margin-right:0px;">
						<span style="text-align: left;">
							<h5>Puede crear un anuncio nuevo</h5>
						</span>
						<br />
						<a href="/profile/choose_ad">
							<img class="" src="/images/new_ad.jpg" />
						</a>
						<br /><br />
						<a href="/profile/choose_ad" class="secondaryButton">Crear Anuncio Nuevo</a>
					</div>
				<?php elseif(!$ads_query): ?>
					<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="90%" valign="center" align="center">
									<h5>Todavia no ha creado ning&uacute;n anuncio!</h5>
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