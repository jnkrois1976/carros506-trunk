	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
		<div class="mainContentPages">
			<div class="horizontalBlock">
				<div class="postDetailsTitle">
					<h2>
						<?php
							setlocale(LC_MONETARY, 'it_IT');
							echo $posting['ad_marca']." ".$posting['ad_modelo']." ".$posting['ad_year']." - &#8353;".money_format('%!.0n', $posting['ad_precio']);
						?>
					</h2>
				</div>
				<div class="visitsCount">
					<h5>
						Este anuncio fue visitado <strong><em><?php echo $posting['ad_visits']; ?></em></strong> veces!
					</h5>
				</div>
			</div>
			<div class="horizontalBlock">
				<div class="carDesc">
					<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
						<tbody>
							<tr>
								<td>
									<strong><em>Informaci&oacute;n del veh&iacute;culo</em></strong>
								</td>
								<td align="right">
									<?php if($posting['ad_categoria'] == "A"): ?>
										Anuncio Completo
									<?php elseif($posting['ad_categoria'] == "B"): ?>
										Anuncio Detallado
									<?php elseif($posting['ad_categoria'] == "C"): ?>
										Anuncio B&aacute;sico
									<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td>C&oacute;digo: </td>
								<td><?php echo $posting['ad_idprefix'].$posting['ad_id']; ?></td>
							</tr>
							<tr>
								<td>Marca:</td>
								<td><?php echo $posting['ad_marca']; ?></td>
							</tr>
							<tr>
								<td>Modelo:</td>
								<td><?php echo $posting['ad_modelo']; ?></td>
							</tr>
							<tr>
								<td>A&ntilde;o:</td>
								<td><?php echo $posting['ad_year']; ?></td>
							</tr>
							<tr>
								<td>Kilometraje:</td>
								<td><?php echo number_format($posting['ad_kilometraje'], 0, ',', '.') ; ?></td>
							</tr>
							<tr>
								<td>Precio:</td>
								<td>
								<?php
									setlocale(LC_MONETARY, 'it_IT');
									echo "&#8353;".money_format('%!.0n', $posting['ad_precio']);
								?>
								</td>
							</tr>
							<?php if($posting['ad_categoria'] == "A"): ?>
							<tr>
								<td>Carroceria:</td>
								<td><?php echo $posting['ad_carroceria']; ?></td>
							</tr>
							<tr>
								<td>Estado:</td>
								<td><?php echo $posting['ad_estado']; ?></td>
							</tr>
							<tr>
								<td>CC:</td>
								<td><?php echo $posting['ad_centimetros']; ?></td>
							</tr>
							<tr>
								<td>Cilindros:</td>
								<td><?php echo $posting['ad_motor']; ?></td>
							</tr>
							<tr>
								<td>Combustible:</td>
								<td><?php echo $posting['ad_combustible']; ?></td>
							</tr>
							<tr>
								<td>Transmisi&oacute;n:</td>
								<td><?php echo $posting['ad_transmision']; ?></td>
							</tr>
							<tr>
								<td>Puertas:</td>
								<td><?php echo $posting['ad_puertas']; ?></td>
							</tr>
							<tr>
								<td>Tracci&oacute;n:</td>
								<td><?php echo $posting['ad_traccion']; ?></td>
							</tr>
							<tr>
								<td colspan="2">Detalles adicionales:</td>
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $posting['ad_detalles']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Publicado el: 
								</td>
								<td>
									<?php
										$break_date_pos = explode('-', $posting['ad_postedOn']);
										setlocale(LC_TIME, "es_ES"); 
										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
									?>
								</td>
							</tr>
							<tr>
								<td>
									Expir&oacute; el: 
								</td>
								<td>
									<strong  id="orig_exp_date">
										<?php
											$break_date_exp = explode('-', $posting['ad_expires']);
											setlocale(LC_TIME, "es_ES");
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
										?>
									</strong>
								</td>
							</tr>
							<?php elseif($posting['ad_categoria'] == "B"): ?>
							<tr>
								<td>Cilindros:</td>
								<td><?php echo $posting['ad_motor']; ?></td>
							</tr>
							<tr>
								<td>Transmisi&oacute;n:</td>
								<td><?php echo $posting['ad_transmision']; ?></td>
							</tr>
							<tr>
								<td>
									Publicado el: 
								</td>
								<td>
									<?php
										$break_date_pos = explode('-', $posting['ad_postedOn']);
										setlocale(LC_TIME, "es_ES");
										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
									?>
								</td>
							</tr>
							<tr>
								<td>
									Expir&oacute; el: 
								</td>
								<td>
									<strong  id="orig_exp_date">
										<?php
											$break_date_exp = explode('-', $posting['ad_expires']);
											setlocale(LC_TIME, "es_ES");
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
										?>
									</strong>
								</td>
							</tr>
							<?php elseif($posting['ad_categoria'] == "C"): ?>
							<tr>
								<td>
									Publicado el: 
								</td>
								<td>
									<?php
										$break_date_pos = explode('-', $posting['ad_postedOn']);
										setlocale(LC_TIME, "es_ES");
										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
									?>
								</td>
							</tr>
							<tr>
								<td>
									Expir&oacute; el: 
								</td>
								<td>
									<strong  id="orig_exp_date">
										<?php
											$break_date_exp = explode('-', $posting['ad_expires']);
											setlocale(LC_TIME, "es_ES");
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
										?>
									</strong>
								</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<div class="carPics">
					<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
						<tr>
							<td>Fotos:</td>
						</tr>
						<tr>
							<td>
								<?php
									$img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
									$folder_path = 'cars/small_thumb/'.$img_folder.'/';
									$images = get_filenames($folder_path);
									if($images){
										foreach ($images as $single_image) {
											echo '<img src="/cars/small_thumb/'.$img_folder.'/'.$single_image.'" name="'.$single_image.'"/>';
										}
									}else {
										echo "Este carro no tiene fotos!";
									}
								?>
							</td>
						</tr>
					</table>
					<br />
					<div id="renewNow" style="float: left;">
						<h5>Su carro no se ha vendido?</h5><br /><br />
						<h5>No hay problema!!!</h5><br /><br />
						<h5>Puede renovar su anuncio por un <br />mes mas si lo desea.</h5><br /><br /><br />
						<?php
							$break_future_date = date('d/m/Y', strtotime('+30 days'));
							$break_date_renew = explode('/', $break_future_date);
							setlocale(LC_TIME, "es_ES");
						?>
						<a href="#" class="secondaryButton calendar" data-adfullid="<?php echo $posting['ad_fullid']; ?>" data-newdate="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-formatdate="<?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_renew[1], $break_date_renew[0], $break_date_renew[2])); ?>">Renovar su anuncio</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>