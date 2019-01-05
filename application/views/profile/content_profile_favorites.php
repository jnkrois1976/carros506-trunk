	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h2>Mis carros favoritos: <?php echo $get_total_favorites; ?></h2>
				<div class="filter">
					<span>Filtro:</span>
					<span>
						<button id="newCars" type="button">Para estrenar</button>
						<button id="usedCars" type="button">Usados</button>
						<button id="allCars" type="button">Todos</button>
					</span>
				</div>
				<hr />
				<div class="carThumbWrapper">
					<?php if($get_favorites_premier): ?>
						<?php foreach($get_favorites_premier as $post_premier_row): ?>
							<?php 
								$today = date('Y-m-d');
								$posted_date = date_create($post_premier_row->ad_postedOn);
								$posted_date_format = date_format($posted_date, 'Y-m-d');
								$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
								$week_ahead_format = date_format($week_ahead, 'Y-m-d');
								$img_folder = strtolower($post_premier_row->ad_idprefix).$post_premier_row->ad_id;
								$folder_path = 'cars/large_premier/'.$img_folder.'/';
								$images = get_filenames($folder_path);
							?>
							<div class="carThumb <?php echo $condition = ($post_premier_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
									<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
										<colgroup>
											<col width="35%"/>
											<col width="30%"/>
											<col width="35%" />
										</colgroup>
										<tbody>
											<tr>
												<td valign="top">
													<h5 class="postTitle"><?php echo $post_premier_row->ad_marca." ".$post_premier_row->ad_modelo." - ".$post_premier_row->ad_year; ?></h5>
												</td>
												<td valign="top">
													<h6>Visitas: <?php echo $post_premier_row->ad_visits; ?></h6>
												</td>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td>
													<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
														<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
													<?php elseif($post_premier_row->ad_nuevo == "1"): ?>
														<img src='/images/estrenar_badge.png' class='newBadge' width="75"/>
													<?php elseif($post_premier_row->ad_nuevo == "0"): ?>	
														<img src='/images/usado_badge.png' class='newBadge' width="75"/>
													<?php endif; ?>
													<a href="/resultados/anuncio_premier/<?php echo $post_premier_row->ad_idprefix.$post_premier_row->ad_id; ?>">
														<img src="/cars/large_premier/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
													</a>
													<a class="viewAdLink" href="/resultados/anuncio_premier/<?php echo $post_premier_row->ad_idprefix.$post_premier_row->ad_id; ?>">Ver anuncio</a>
													<a class="viewAdLink attention" href="#" id="removeFromFavorites" data-adid="<?php echo $post_premier_row->ad_idprefix.$post_premier_row->ad_id; ?>" data-memberid="<?php echo $this->session->userdata('member_id'); ?>">Eliminar de mis favoritos</a>
												</td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_premier_row->ad_marca; ?></li>
														<li><?php echo $post_premier_row->ad_modelo; ?></li>
														<li><?php echo $post_premier_row->ad_year; ?></li>
														<li><?php echo $post_premier_row->ad_motor; ?> Cilindros</li>
														<li><?php echo $post_premier_row->ad_transmision; ?></li>
														<li><?php echo number_format($post_premier_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
														<li>
															&#8353;
															<?php
																setlocale(LC_MONETARY, 'it_IT');
																echo money_format('%!.0n', $post_premier_row->ad_precio);
															?>
														</li>
													</ul></td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_premier_row->ad_estado; ?> estado</li>
														<li><?php echo $post_premier_row->ad_color; ?></li>
														<li><?php echo $post_premier_row->ad_combustible; ?></li>
														<li>Motor <?php echo $post_premier_row->ad_centimetros; ?> CC</li>
														<li>Tracci&oacute;n <?php echo $post_premier_row->ad_traccion; ?></li>
														<li>Vendedor <?php echo $post_premier_row->ad_sellerCategory; ?></li>
														<?php 
															$break_date_premier = explode('-', $post_premier_row->ad_postedOn);
															setlocale(LC_TIME, "es_ES"); 
														?>
														<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_premier[1], $break_date_premier[2], $break_date_premier[0])); ?></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>	
						<?php endforeach; ?>
					<?php endif; ?>
					
					<?php if($get_favorites): ?>
						<?php foreach($get_favorites as $post_row): ?>
							<?php 
								$today = date('Y-m-d');
								$posted_date = date_create($post_row->ad_postedOn);
								$posted_date_format = date_format($posted_date, 'Y-m-d');
								$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
								$week_ahead_format = date_format($week_ahead, 'Y-m-d');
								$img_folder = strtolower($post_row->ad_idprefix).$post_row->ad_id;
								$folder_path = 'cars/large_thumb/'.$img_folder.'/';
								$images = get_filenames($folder_path);
							?>
							<?php if($post_row->ad_categoria == "A"): ?>
								<div class="carThumb <?php echo $condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
									<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
										<colgroup>
											<col width="35%"/>
											<col width="30%"/>
											<col width="35%" />
										</colgroup>
										<tbody>
											<tr>
												<td valign="top">
													<h5 class="postTitle"><?php echo $post_row->ad_marca." ".$post_row->ad_modelo." - ".$post_row->ad_year; ?></h5>
												</td>
												<td valign="top">
													<h6>Comentarios: <?php echo $post_row->ad_publicComments; ?></h6>
												</td>
												<td valign="top">
													<h6>Visitas: <?php echo $post_row->ad_visits; ?></h6> 
												</td>
											</tr>
											<tr>
												<td>
													<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
														<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
													<?php elseif($post_row->ad_nuevo == "1"): ?>
														<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
													<?php elseif($post_row->ad_nuevo == "0"): ?>	
														<img src='/images/usado_badge.png' class='newBadge' width="75" />
													<?php endif; ?>
													<a href="/resultados/anuncio/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">
														<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
													</a>
													<a class="viewAdLink" href="/resultados/anuncio/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">Ver anuncio</a>
													<a class="viewAdLink attention" href="#" id="removeFromFavorites" data-adid="<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>" data-memberid="<?php echo $this->session->userdata('member_id'); ?>">Eliminar de mis favoritos</a>
												</td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_marca; ?></li>
														<li><?php echo $post_row->ad_modelo; ?></li>
														<li><?php echo $post_row->ad_year; ?></li>
														<li><?php echo $post_row->ad_motor; ?> Cilindros</li>
														<li><?php echo $post_row->ad_transmision; ?></li>
														<li><?php echo number_format($post_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
														<li>
															&#8353;
															<?php
																setlocale(LC_MONETARY, 'it_IT');
																echo money_format('%!.0n', $post_row->ad_precio);
															?>
														</li>
													</ul></td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_estado; ?> estado</li>
														<li><?php echo $post_row->ad_color; ?></li>
														<li><?php echo $post_row->ad_combustible; ?></li>
														<li>Motor <?php echo $post_row->ad_centimetros; ?> CC</li>
														<li>Tracci&oacute;n <?php echo $post_row->ad_traccion; ?></li>
														<li>Vendedor <?php echo $post_row->ad_sellerCategory; ?></li>
														<?php 
															$break_date_a = explode('-', $post_row->ad_postedOn);
															setlocale(LC_TIME, "es_ES"); 
														?>
														<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_a[1], $break_date_a[2], $break_date_a[0])); ?></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							<?php elseif($post_row->ad_categoria == "B"): ?>
								<div class="carThumb <?php echo $condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
									<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
										<colgroup>
											<col width="35%"/>
											<col width="30%"/>
											<col width="35%" />
										</colgroup>
										<tbody>
											<tr>
												<td valign="top">
													<h5 class="postTitle"><?php echo $post_row->ad_marca." ".$post_row->ad_modelo." - ".$post_row->ad_year; ?></h5>
												</td>
												<td valign="top">
													<h6>Comentarios: <?php  echo $post_row->ad_publicComments; ?></h6>
												</td>
												<td valign="top">
													<h6>Visitas: <?php echo $post_row->ad_visits; ?></h6>
												</td>
											</tr>
											<tr>
												<td>
													<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
														<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
													<?php elseif($post_row->ad_nuevo == "1"): ?>
														<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
													<?php elseif($post_row->ad_nuevo == "0"): ?>	
														<img src='/images/usado_badge.png' class='newBadge' width="75" />
													<?php endif; ?>
													<a href="/resultados/anuncio_medio/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">
														<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
													</a>
													<a class="viewAdLink" href="/resultados/anuncio_medio/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">Ver anuncio</a>
													<a class="viewAdLink attention" href="#" id="removeFromFavorites" data-adid="<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>" data-memberid="<?php echo $this->session->userdata('member_id'); ?>">Eliminar de mis favoritos</a>
												</td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_marca; ?></li>
														<li><?php echo $post_row->ad_modelo; ?></li>
														<li><?php echo $post_row->ad_year; ?></li>
														<li><?php echo $post_row->ad_motor; ?> Cilindros</li>
														<li><?php echo $post_row->ad_transmision; ?></li>
														<li><?php echo number_format($post_row->ad_kilometraje, 0, ',', '.') ?> Km</li>
														<li>
															&#8353; 
															<?php 
																setlocale(LC_MONETARY, 'it_IT');
																echo money_format('%!.0n', $post_row->ad_precio);
															?>
														</li>
													</ul></td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_combustible; ?></li>
														<li><?php echo $post_row->ad_carroceria; ?></li>
														<li>Vendedor <?php echo $post_row->ad_sellerCategory; ?></li>
														<?php 
															$break_date_b = explode('-', $post_row->ad_postedOn);
															setlocale(LC_TIME, "es_ES"); 
														?>
														<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_b[1], $break_date_b[2], $break_date_b[0])); ?></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							<?php elseif($post_row->ad_categoria == "C"): ?>
								<div class="carThumb <?php echo $condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
									<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
										<colgroup>
											<col width="35%"/>
											<col width="35%"/>
											<col width="30%" />
										</colgroup>
										<tbody>
											<tr>
												<td valign="top">
													<h5 class="postTitle"><?php echo $post_row->ad_marca." ".$post_row->ad_modelo." - ".$post_row->ad_year; ?></h5>
												</td>
												<td valign="top" colspan="2">
													<h6>Visitas: <?php echo $post_row->ad_visits; ?></h6>
												</td>
											</tr>
											<tr>
												<td>
													<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
														<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
													<?php elseif($post_row->ad_nuevo == "1"): ?>
														<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
													<?php elseif($post_row->ad_nuevo == "0"): ?>	
														<img src='/images/usado_badge.png' class='newBadge' width="75" />
													<?php endif; ?>
													<a href="/resultados/anuncio_basico/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">
														<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
													</a>
													<a class="viewAdLink" href="/resultados/anuncio_basico/<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>">Ver anuncio</a>
													<a class="viewAdLink attention" href="#" id="removeFromFavorites" data-adid="<?php echo $post_row->ad_idprefix.$post_row->ad_id; ?>" data-memberid="<?php echo $this->session->userdata('member_id'); ?>">Eliminar de mis favoritos</a>
												</td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_marca; ?></li>
														<li><?php echo $post_row->ad_modelo; ?></li>
														<li><?php echo $post_row->ad_year; ?></li>
														<li><?php echo number_format($post_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
														<li>
															&#8353;
															<?php
																setlocale(LC_MONETARY, 'it_IT');
																echo money_format('%!.0n', $post_row->ad_precio);
															?>
														</li>
													</ul>
												</td>
												<td>
													<ul class="listedDetails">
														<li><?php echo $post_row->ad_sellerName; ?></li>
														<li><?php echo $post_row->ad_sellerPhone; ?></li>
														<li>Vendedor <?php echo $post_row->ad_sellerCategory; ?></li>
														<?php 
															$break_date_c = explode('-', $post_row->ad_postedOn);
															setlocale(LC_TIME, "es_ES"); 
														?>
														<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_c[1], $break_date_c[2], $break_date_c[0])); ?></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php elseif(!$get_favorites && !$get_favorites_premier): ?>
							<div class="serverError">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="90%" valign="center" align="center">
											<h5>No has agregado ning&uacute;n carro a tu lista de favoritos!</h5>
										</td>
										<td width="10%" valign="center" align="left">
											<img src="/images/exclamation.png" />
										</td>
									</tr>
								</table>
							</div>
						<?php endif; ?>
					</div>
					<?php $this->load->view('includes/advertisement'); ?>
					<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>