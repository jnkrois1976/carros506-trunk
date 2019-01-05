	<?php $this->load->view('includes/header'); ?>
	<?php 
		/*include 'ChromePhp.php';
		ChromePhp::log($post_by_dealer);*/
	?>
	<section>
		<div class="centerContainer">
		<div class="mainContentPages">
			<div class="horizontalBlock">
				<?php if($post_by_dealer): ?>
					<h2 id="resultCounter" name="carajo">
						<?php echo $post_by_dealer[0]->ad_sellerName." tiene ".$rows_by_dealer.' '.$seller_ads = ($rows_by_dealer > 1 ? 'carros' : ' carro'); ?> a la venta &nbsp;
						<!--<img src="/images/load_bar.png" id="loaderBar" alt="Actualizando" />-->
					</h2>
				<?php endif; ?>
				<div class="leftWrapper">
					<?php if($post_by_dealer): ?>
						<?php $dealer_id = $this->uri->segment(3, 0); ?>
						<!--<img class="dealerAd" src="/dealer_ads/<?php //echo $dealer_id; ?>.jpg" />-->
						<img src="http://lorempixel.com/g/324/600/transport/Su-anuncio-aqui/"/>
					<?php endif; ?>
					<script>
				        $(window).load(function(){
							$(".searchWidget").sticky({ topSpacing: 68 });
						});
				    </script>
				</div>
				<div class="rightWrapper">
					<div class="carThumbWrapper">
						<div class="filter">
							<span>Filtro:</span>
							<span>
								<button id="newCars" type="button">Para estrenar</button>
								<button id="usedCars" type="button">Usados</button>
								<button id="allCars" type="button">Todos</button>
							</span>
						</div>
						<hr />
						<?php if($post_by_dealer): ?>
							
							<?php setlocale(LC_MONETARY, 'it_IT'); ?>
							<?php foreach($post_by_dealer as $post_by_dealer_row): ?>
								<?php
									$today = date('Y-m-d');
									$posted_date = date_create($post_by_dealer_row->ad_postedOn);
									$posted_date_format = date_format($posted_date, 'Y-m-d');
									$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
									$week_ahead_format = date_format($week_ahead, 'Y-m-d');
									$img_folder = strtolower($post_by_dealer_row->ad_idprefix).$post_by_dealer_row->ad_id;
									if($post_by_dealer_row->ad_categoria == "A"){
										$folder_path = 'cars/large_thumb/'.$img_folder.'/';
										$images_large = get_filenames($folder_path);
									}elseif($post_by_dealer_row->ad_categoria == "B" || $post_by_dealer_row->ad_categoria == "C"){
										$folder_path = 'cars/large_thumb/'.$img_folder.'/';
										$images_large = get_filenames($folder_path);
									}elseif($post_by_dealer_row->ad_categoria == "P"){
										$folder_path = 'cars/large_premier/'.$img_folder.'/';
										$images_premier = get_filenames($folder_path);
									}
								?>
								<?php if($post_by_dealer_row->ad_categoria == "A" || $post_by_dealer_row->ad_categoria == "P"): ?>
									<div class="carThumb <?php echo $condition = ($post_by_dealer_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="30%"/>
												<col width="35%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top">
														<h5 class="postTitle"><?php echo $post_by_dealer_row->ad_marca." ".$post_by_dealer_row->ad_modelo." - ".$post_by_dealer_row->ad_year; ?></h5>
													</td>
													<td valign="top">
														<h6>Comentarios: <?php echo $post_by_dealer_row->ad_publicComments; ?></h6>
													</td>
													<td valign="top" align="right">
														<h6>Visitas: <?php echo $post_by_dealer_row->ad_visits; ?></h6>
													</td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newLargeBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>"/>
														<?php elseif($post_by_dealer_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
														<?php elseif($post_by_dealer_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newLargeBadge' width="75" />
														<?php endif; ?>
														<?php if($post_by_dealer_row->ad_categoria == "A"): ?>
															<?php if($images_large): ?>
																<a href="/resultados/anuncio/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">
																	<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images_large[0]; ?>" class="postThumb"/>
																</a><br />
																<a class="viewAdLink" href="/resultados/anuncio/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">Ver detalles</a>
															<?php elseif(!$images_large): ?>
																<img src="/cars/large_thumb/no_image.jpg" class="postThumb"/>
															<?php endif; ?>
														<?php endif; ?>
														<?php if($post_by_dealer_row->ad_categoria == "P"): ?>
															<?php if($images_premier || $post_by_dealer_row->ad_categoria == "P"): ?>
																<a href="/resultados/anuncio_premier/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">
																	<img src="/cars/large_premier/<?php echo $img_folder.'/'.$images_premier[0]; ?>" class="postThumb"/>
																</a><br />
																<a class="viewAdLink" href="/resultados/anuncio_premier/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">Ver detalles</a>
															<?php elseif(!$images_premier): ?>
																<img src="/cars/large_thumb/no_image.jpg" class="postThumb"/>
															<?php endif; ?>
														<?php endif; ?>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $post_by_dealer_row->ad_marca; ?></li>
															<li><?php echo $post_by_dealer_row->ad_modelo; ?></li>
															<li><?php echo $post_by_dealer_row->ad_year; ?></li>
															<li><?php echo $post_by_dealer_row->ad_motor; ?> Cilindros</li>
															<li><?php echo $post_by_dealer_row->ad_transmision; ?></li>
															<li><?php echo number_format($post_by_dealer_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353;
																<?php
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $post_by_dealer_row->ad_precio);
																?>
															</li>
														</ul></td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $post_by_dealer_row->ad_estado; ?> estado</li>
															<li><?php echo $post_by_dealer_row->ad_color; ?></li>
															<li><?php echo $post_by_dealer_row->ad_combustible; ?></li>
															<li>Motor <?php echo $post_by_dealer_row->ad_centimetros; ?> CC</li>
															<li>Tracci&oacute;n <?php echo $post_by_dealer_row->ad_traccion; ?></li>
															<li>Vendedor: <?php echo $post_by_dealer_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_a = explode('-', $post_by_dealer_row->ad_postedOn);
																setlocale(LC_TIME, "es_ES"); 
															?>
															<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_a[1], $break_date_a[2], $break_date_a[0])); ?></li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php elseif($post_by_dealer_row->ad_categoria == "B"): ?>
									<div class="carThumb <?php echo $condition = ($post_by_dealer_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="30%"/>
												<col width="35%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top">
														<h5 class="postTitle"><?php echo $post_by_dealer_row->ad_marca." ".$post_by_dealer_row->ad_modelo." - ".$post_by_dealer_row->ad_year; ?></h5>
													</td>
													<td valign="top">
														<h6>Comentarios: <?php  echo $post_by_dealer_row->ad_publicComments; ?></h6>
													</td>
													<td valign="top" align="right">
														<h6>Visitas: <?php echo $post_by_dealer_row->ad_visits; ?></h6>
													</td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newLargeBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>"/>
														<?php elseif($post_by_dealer_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
														<?php elseif($post_by_dealer_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newLargeBadge' width="75" />
														<?php endif; ?>
														<?php if($images_large): ?>
															<a href="/resultados/anuncio_medio/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">
																<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images_large[0]; ?>" class="postThumb"/>
															</a><br />
															<a class="viewAdLink" href="/resultados/anuncio_medio/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">Ver detalles</a>
														<?php elseif(!$images_large): ?>
															<img src="/cars/large_thumb/no_image.jpg" class="postThumb"/>
														<?php endif; ?>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $post_by_dealer_row->ad_marca; ?></li>
															<li><?php echo $post_by_dealer_row->ad_modelo; ?></li>
															<li><?php echo $post_by_dealer_row->ad_year; ?></li>
															<li><?php echo $post_by_dealer_row->ad_motor; ?> Cilindros</li>
															<li><?php echo $post_by_dealer_row->ad_transmision; ?></li>
															<li><?php echo number_format($post_by_dealer_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353; 
																<?php 
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $post_by_dealer_row->ad_precio);
																?>
															</li>
														</ul></td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $post_by_dealer_row->ad_combustible; ?></li>
															<li><?php echo $post_by_dealer_row->ad_carroceria; ?></li>
															<li>Vendedor: <?php echo $post_by_dealer_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_b = explode('-', $post_by_dealer_row->ad_postedOn);
																setlocale(LC_TIME, "es_ES"); 
															?>
															<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_b[1], $break_date_b[2], $break_date_b[0])); ?></li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php elseif($post_by_dealer_row->ad_categoria == "C"): ?>
									<div class="carThumb <?php echo $condition = ($post_by_dealer_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="35%"/>
												<col width="30%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top">
														<h5 class="postTitle"><?php echo $post_by_dealer_row->ad_marca." ".$post_by_dealer_row->ad_modelo." - ".$post_by_dealer_row->ad_year; ?></h5>
													</td>
													<td valign="top">
														<h6>Visitas: <?php echo $post_by_dealer_row->ad_visits; ?></h6>
													</td>
													<td valign="top">
														&nbsp;
													</td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newLargeBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>"/>
														<?php elseif($post_by_dealer_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
														<?php elseif($post_by_dealer_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newLargeBadge' width="75" />
														<?php endif; ?>
														<?php if($images_large): ?>
															<a href="/resultados/anuncio_basico/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">
																<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images_large[0]; ?>" class="postThumb"/>
															</a><br />
															<a class="viewAdLink" href="/resultados/anuncio_basico/<?php echo $post_by_dealer_row->ad_idprefix.$post_by_dealer_row->ad_id; ?>">Ver detalles</a>
														<?php elseif(!$images_large): ?>
															<img src="/cars/large_thumb/no_image.jpg" class="postThumb"/>
														<?php endif; ?>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $post_by_dealer_row->ad_marca; ?></li>
															<li><?php echo $post_by_dealer_row->ad_modelo; ?></li>
															<li><?php echo $post_by_dealer_row->ad_year; ?></li>
															<li><?php echo number_format($post_by_dealer_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353;
																<?php
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $post_by_dealer_row->ad_precio);
																?>
															</li>
															<li>Vendedor: <?php echo $post_by_dealer_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_c = explode('-', $post_by_dealer_row->ad_postedOn);
																setlocale(LC_TIME, "es_ES"); 
															?>
															<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_c[1], $break_date_c[2], $break_date_c[0])); ?></li>
														</ul>
													</td>
													<td style="vertical-align:top;">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php echo $this->pagination->create_links(); ?>
						<?php elseif(!$post_by_dealer): ?>
							<div class="serverError">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="90%" valign="center" align="center">
											<h5>No hay carros disponibles en la categor&iacute;a que escogi&oacute.<br />Por favor seleccione otra categor&iacute;a.</h5>
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
			</div>
		</div>
		<div class="centerContainer">
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<!--<script type="text/javascript" src="/js/search_widget.js"></script>-->
	<script type="text/javascript" src="/js/dialog.js"></script>
	<script type="text/javascript" src="/js/jquery_slider.js"></script>
	<?php $this->load->view('includes/footer'); ?>