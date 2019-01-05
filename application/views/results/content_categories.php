	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
		<div class="mainContentPages">
			<div class="horizontalBlock">
				<div class="leftWrapper">
					<?php if($postbycat): ?>
					<div class="searchWidget">
						<h3>Busqueda r&aacute;pida &emsp;<img src="/svg/search_icon.svg" alt="Buscar" /></h3>
						<form method="post" action="/resultados/anuncios" class="quickSearch" id="quickSearch">
							<div class="inputWrapper">
								<label for="make">Marca:</label>
								<div class="makesElemWrap">
									<input type="text" value="<?php echo $this->input->post('make'); ?>" placeholder="Escoja un fabricante..." name="make" id="make" onclick="this.select();" autocomplete="off" data-error="Seleccione una marca" />
									<div id="makersList">
										<ul id="makesDisplayList"></ul>
										<div class="infoDialog">
											<a href="#" id="dialog_linkMakes" class="ui-state-default ui-corner-all">Marcas Disponibles</a>
										</div>
										<div id="dialogMakes" title="Marcas Disponibles">
											<p>
												En este momento, las marcas de automoviles mostradas reflejan los automobiles disponibles para la venta.<br /><br />
												Mas marcas estar&aacute;n disponibles conforme nuevos anuncios sean publicados. <br /><br />
												Gracias por su comprensi&oacute;n.
											</p>
										</div>
									</div>
								</div>
								<select id="manufacturers" name="manufacturers" disabled="disabled">
									<?php foreach($allmakes as $allmakes_row): ?>
									<option value="<?php echo $allmakes_row->ad_marca; ?>"><?php echo $allmakes_row->ad_marca; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="inputWrapper">
								<label for="model">Modelo:</label>
								<div class="modelElemWrap">
									<div class="elemWrap">
										<input type="text" value="" placeholder="Escoja un modelo..." name="model" id="model" autocomplete="off" onclick="this.select();" data-error="Seleccione un modelo" />
									</div>
									<div id="modelsList">
										<ul id="modelsDisplayList"></ul>
										<div class="infoDialog">
											<a href="#" id="dialog_linkModels" class="ui-state-default ui-corner-all">Modelos Disponibles</a>
										</div>
										<div id="dialogModels" title="Modelos Disponibles">
											<p>
												En este momento, los modelos de automoviles mostrados reflejan los automobiles disponibles para la venta.<br /><br />
												Mas modelos estar&aacute;n disponibles conforme nuevos anuncios sean publicados. <br /><br />
												Gracias por su comprensi&oacute;n.
											</p>
										</div>
									</div>
								</div>
								<select id="carModels" name="carModels" disabled="disabled"></select>
							</div>
							<div class="inputWrapperShort">
								<div class="priceRangeDisplay">
									<label>Rango de Precios:</label>
									<span class="currency">&#8353;</span><span id="minAmountDisplay"></span>
								<input type="hidden" id="minamount" name="minamount" class="rangeInfoSmall" autocomplete="off" value="" />
								<span class="currency"> - &#8353;</span><span id="maxAmountDisplay"></span>
								<input type="hidden" id="maxamount" name="maxamount" class="rangeInfoSmall" autocomplete="off" value="" />
								</div>
								<div id="priceRange"></div>
							</div>
							<div class="inputWrapperShort">
								<label>Rango de A&ntilde;os:</label>
								<input type="text" id="yearstart" name="yearstart" class="rangeInfoYear" readonly="readonly" autocomplete="off" /><span class="currency"> - </span>
								<input type="text" id="yearend" name="yearend" class="rangeInfoYear" readonly="readonly" />
								<div id="yearRange"></div>
							</div>
							<div class="inputWrapperSearch">
								Los resultados se actualizar&aacute;n con base en los criterios que seleccione.
								<!--<input type="submit" value="Buscar" name="submit" id="submit" class="button search" />&emsp;&emsp;<a href="#" class="plainLink">busqueda detallada &gt;&gt;</a>-->
							</div>
						</form>
					</div>
					<script>
				        $(window).load(function(){
							$(".searchWidget").sticky({ topSpacing: 68 });
						});
				    </script>
				    <?php endif; ?>
				</div>
				<?php if($postbycat): ?>
					<div class="rightWrapper">
						<div class="carThumbWrapper">
							<h1 id="resultCounter">Encontr&eacute; <?php echo $single_result = ($rowsbycat == 1) ? $rowsbycat." resultado" : $rowsbycat." resultados"; ?> &nbsp;<img src="/images/load_bar.png" id="loaderBar" alt="Actualizando" /></h1>
							<div class="filter">
								<span>Filtro:</span>
								<span>
									<button id="newCars" type="button">Para estrenar</button>
									<button id="usedCars" type="button">Usados</button>
									<button id="allCars" type="button">Todos</button>
								</span>
							</div>
							<hr />
							<?php
								setlocale(LC_MONETARY, 'it_IT');
							?>
							<?php foreach($postbycat as $postbycat_row): ?>
								<?php
									$today = date('Y-m-d');
									$posted_date = date_create($postbycat_row->ad_postedOn);
									$posted_date_format = date_format($posted_date, 'Y-m-d');
									$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
									$week_ahead_format = date_format($week_ahead, 'Y-m-d'); 
									$img_folder = strtolower($postbycat_row->ad_idprefix).$postbycat_row->ad_id;
									$folder_path = 'cars/large_thumb/'.$img_folder.'/';
									$images = get_filenames($folder_path);
								?>
								<?php if($postbycat_row->ad_categoria == "A"): ?>
									<div class="carThumb <?php echo $condition = ($postbycat_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="30%"/>
												<col width="35%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top"><h5 class="postTitle"><?php echo $postbycat_row->ad_marca." ".$postbycat_row->ad_modelo." - ".$postbycat_row->ad_year; ?></h5></td>
													<td valign="top"><h6>Comentarios: <?php echo $postbycat_row->ad_publicComments; ?></h6></td>
													<td valign="top" align="right"><h6>Visitas: <?php echo $postbycat_row->ad_visits; ?></h6></td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
														<?php elseif($postbycat_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
														<?php elseif($postbycat_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newBadge' width="75" />
														<?php endif; ?>
														<a href="/resultados/anuncio/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">
															<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
														</a><br />
														<a class="viewAdLink" href="/resultados/anuncio/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">Ver detalles</a>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $postbycat_row->ad_marca; ?></li>
															<li><?php echo $postbycat_row->ad_modelo; ?></li>
															<li><?php echo $postbycat_row->ad_year; ?></li>
															<li><?php echo $postbycat_row->ad_motor; ?> Cilindros</li>
															<li><?php echo $postbycat_row->ad_transmision; ?></li>
															<li><?php echo number_format($postbycat_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353;
																<?php
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $postbycat_row->ad_precio);
																?>
															</li>
														</ul>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $postbycat_row->ad_estado; ?> estado</li>
															<li><?php echo $postbycat_row->ad_color; ?></li>
															<li><?php echo $postbycat_row->ad_combustible; ?></li>
															<li>Motor <?php echo $postbycat_row->ad_centimetros; ?> CC</li>
															<li>Tracci&oacute;n <?php echo $postbycat_row->ad_traccion; ?></li>
															<li>Vendedor: <?php echo $postbycat_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_a = explode('-', $postbycat_row->ad_postedOn);
																setlocale(LC_TIME, "es_ES"); 
															?>
															<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_a[1], $break_date_a[2], $break_date_a[0])); ?></li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php elseif($postbycat_row->ad_categoria == "B"): ?>
									<div class="carThumb <?php echo $condition = ($postbycat_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="30%"/>
												<col width="35%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top"><h5 class="postTitle"><?php echo $postbycat_row->ad_marca." ".$postbycat_row->ad_modelo." - ".$postbycat_row->ad_year; ?></h5></td>
													<td valign="top"><h6>Comentarios: <?php  echo $postbycat_row->ad_publicComments; ?></h6></td>
													<td valign="top" align="right"><h6>Visitas: <?php echo $postbycat_row->ad_visits; ?></h6></td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
														<?php elseif($postbycat_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
														<?php elseif($postbycat_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newBadge' width="75" />
														<?php endif; ?>
														<a href="/resultados/anuncio_medio/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">
															<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
														</a><br />
														<a class="viewAdLink" href="/resultados/anuncio_medio/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">Ver detalles</a>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $postbycat_row->ad_marca; ?></li>
															<li><?php echo $postbycat_row->ad_modelo; ?></li>
															<li><?php echo $postbycat_row->ad_year; ?></li>
															<li><?php echo $postbycat_row->ad_motor; ?> Cilindros</li>
															<li><?php echo $postbycat_row->ad_transmision; ?></li>
															<li><?php echo number_format($postbycat_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353; 
																<?php 
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $postbycat_row->ad_precio);
																?>
															</li>
														</ul>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $postbycat_row->ad_combustible; ?></li>
															<li><?php echo $postbycat_row->ad_carroceria; ?></li>
															<li>Vendedor: <?php echo $postbycat_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_b = explode('-', $postbycat_row->ad_postedOn);
																setlocale(LC_TIME, "es_ES"); 
															?>
															<li>Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_b[1], $break_date_b[2], $break_date_b[0])); ?></li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php elseif($postbycat_row->ad_categoria == "C"): ?>
									<div class="carThumb <?php echo $condition = ($postbycat_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
										<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
											<colgroup>
												<col width="35%"/>
												<col width="35%"/>
												<col width="30%" />
											</colgroup>
											<tbody>
												<tr>
													<td valign="top"><h5 class="postTitle"><?php echo $postbycat_row->ad_marca." ".$postbycat_row->ad_modelo." - ".$postbycat_row->ad_year; ?></h5></td>
													<td valign="top"><h6>Visitas: <?php echo $postbycat_row->ad_visits; ?></h6></td>
													<td valign="top">&nbsp;</td>
												</tr>
												<tr>
													<td style="position:relative;">
														<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
															<img src='/images/new_large_badge.png' class='newBadge' width="75" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
														<?php elseif($postbycat_row->ad_nuevo == "1"): ?>
															<img src='/images/estrenar_badge.png' class='newBadge' width="75" />
														<?php elseif($postbycat_row->ad_nuevo == "0"): ?>	
															<img src='/images/usado_badge.png' class='newBadge' width="75" />
														<?php endif; ?>
														<a href="/resultados/anuncio_basico/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">
															<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
														</a><br />
														<a class="viewAdLink" href="/resultados/anuncio_basico/<?php echo $postbycat_row->ad_idprefix.$postbycat_row->ad_id; ?>">Ver detalles</a>
													</td>
													<td style="vertical-align:top;">
														<ul class="listedDetails">
															<li><?php echo $postbycat_row->ad_marca; ?></li>
															<li><?php echo $postbycat_row->ad_modelo; ?></li>
															<li><?php echo $postbycat_row->ad_year; ?></li>
															<li><?php echo number_format($postbycat_row->ad_kilometraje, 0, ',', '.'); ?> Km</li>
															<li>
																&#8353;
																<?php
																	setlocale(LC_MONETARY, 'it_IT');
																	echo money_format('%!.0n', $postbycat_row->ad_precio);
																?>
															</li>
															<li>Vendedor: <?php echo $postbycat_row->ad_sellerCategory; ?></li>
															<?php 
																$break_date_c = explode('-', $postbycat_row->ad_postedOn);
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
						</div>
					</div>
				<?php elseif(!$postbycat): ?>
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
		<div class="centerContainer">
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/search_widget.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<script type="text/javascript" src="/js/jquery_slider.js"></script>
	<?php $this->load->view('includes/footer'); ?>