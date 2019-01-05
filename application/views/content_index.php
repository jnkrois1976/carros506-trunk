	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
		<div class="mainContentIndex">
			<div>
				<div class="searchWidget">
					<h3>Busqueda r&aacute;pida &emsp;
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
							<path fill="#FFFFFF" d="M23.298 19.902c0.938 0.9 0.9 2.5 0 3.395c-0.937 0.938-2.457 0.938-3.394 0l-5.43-5.427 c-1.428 0.843-3.094 1.329-4.875 1.329c-5.301 0-9.6-4.299-9.6-9.6C0.001 4.3 4.3 0 9.6 0s9.6 4.3 9.6 9.6 c0 1.781-0.486 3.446-1.329 4.875L23.298 19.902z M16.802 9.6c0-3.969-3.229-7.2-7.2-7.2c-3.969 0-7.2 3.23-7.2 7.2 c0 4 3.2 7.2 7.2 7.2C13.57 16.8 16.8 13.6 16.8 9.6z"/>
							<radialGradient id="SVGID_1_" cx="261.5" cy="-347.6" r="4.8" gradientTransform="matrix(1 0 0 -1 -251.8623 -338)" gradientUnits="userSpaceOnUse">
								<stop offset="0" style="stop-color:#FFFFFF"/>
								<stop offset="1" style="stop-color:#7A7A7A"/>
							</radialGradient>
							<path fill="url(#SVGID_1_)" d="M9.602 4.8c2.647 0 4.8 2.2 4.8 4.8s-2.152 4.8-4.8 4.8c-2.647 0-4.8-2.152-4.8-4.8 C4.802 7 7 4.8 9.6 4.8z"/>
						</svg>
					</h3>
					<form method="post" action="/resultados/anuncios" class="quickSearch" id="quickSearch">
                        <div class="inputWrapper">
                            <label for="make">Marca:</label>
							<div class="makesElemWrap">
								<input type="text" value="" placeholder="Escoja un fabricante..." name="make" id="make" onclick="this.select();" autocomplete="off" data-error="Seleccione una marca" />
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
									<input type="text" value="" placeholder="Escoja un modelo..." disabled="disabled" name="model" id="model" autocomplete="off" onclick="this.select();" data-error="Seleccione un modelo" />
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
								<label for="amount">Rango de Precios: </label>
								<span class="currency">&#8353;</span><span id="minAmountDisplay"></span>
								<input type="hidden" id="minamount" name="minamount" class="rangeInfoSmall" autocomplete="off" value="" />
								<span class="currency"> - &#8353;</span><span id="maxAmountDisplay"></span>
								<input type="hidden" id="maxamount" name="maxamount" class="rangeInfoSmall" autocomplete="off" value="" />
							</div>
                            <div id="priceRange"></div>
                        </div>
                        <div class="inputWrapperShort">
                            <label for="year">Rango de A&ntilde;os:</label>
							<input type="text" id="yearstart" name="yearstart" class="rangeInfoYear" readonly="readonly" autocomplete="off" /><span class="currency"> - </span>
							<input type="text" id="yearend" name="yearend" class="rangeInfoYear" readonly="readonly" />
                            <div id="yearRange"></div>
                        </div>
						<div class="inputWrapperSearch">
							<input type="submit" value="Buscar Su Carro" name="submit" id="submit" class="secondaryButton search" style="padding:5px 0px; font-size: 18px; margin-top: 10px;"/>
						</div>
					</form>
				</div>
				<div class="slideshow">
					<div class="slider-wrapper theme-default">
						<div id="slider" class="nivoSlider">
						    <div class="staticSlide">
						        <h1 style="font-size: 96px; font-family: 'OpenSansItalic'; line-height: 96px; text-align: center;">Bienvenido!</h1><br /><br /><br /><br />
						        <h5>Para vender su carro, publique su anuncio GRATIS aqu&iacute;!</h5><br /><br />
						        <a href="/site/anunciese" class="secondaryButton">M&aacute;s informaci&oacute;n.</a>
						    </div>
							<?php 
								/*if($get_premier){
									foreach($get_premier as $get_premier_row){
										$img_folder = strtolower($get_premier_row->ad_idprefix).$get_premier_row->ad_id;
										$folder_path = 'cars/slideshow/'.$img_folder.'/';
										$images = get_filenames($folder_path);
										echo 	'<a href="/resultados/anuncio_premier/'.strtoupper($get_premier_row->ad_fullid).'">
													<img src="/'.$folder_path.$images[0].'" alt="'.$get_premier_row->ad_marca.' '.$get_premier_row->ad_modelo.'" title="'.$get_premier_row->ad_marca.' '.$get_premier_row->ad_modelo.' - '.$get_premier_row->ad_year.'" />
												</a>';
									}
								}*/ /*remove comments to enable home page slideshow, also uncomment line 16 (bg) in default.css */
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="bottomBoxes hidden-phone">
				<div class="bottomBox popularCars">
					<h2>Carros populares</h2>
					<div>
						<?php if($getpopular): ?>
							<?php foreach($getpopular as $getpopular_row): ?>
							<div class="carThumb <?php echo $condition = ($getpopular_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
								<?php 
									$today = date('Y-m-d');
									$posted_date = date_create($getpopular_row->ad_postedOn);
									$posted_date_format = date_format($posted_date, 'Y-m-d');
									$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
									$week_ahead_format = date_format($week_ahead, 'Y-m-d');
									$img_folder = strtolower($getpopular_row->ad_idprefix).$getpopular_row->ad_id;
									$folder_path = 'cars/small_thumb/'.$img_folder.'/';
									$images = get_filenames($folder_path);
									if($images){
										if($today >= $posted_date_format && $today <= $week_ahead_format){
											echo "<img src='/images/new_large_badge.png' style='left:0px;' class='newBadge' width='50' data-today=".$today." data-posted=".$posted_date_format." data-weekahead=".$week_ahead_format." />";
										}elseif($getpopular_row->ad_nuevo == "1"){
											echo "<img src='/images/estrenar_badge.png' style='left:0px;' class='newBadge' width='50' />";
										}elseif($getpopular_row->ad_nuevo == "0"){
											echo "<img src='/images/usado_badge.png' style='left:0px;' class='newBadge' width='50' />";
										}
										if($getpopular_row->ad_categoria == "A"){
											echo '<a href="/resultados/anuncio/'.$getpopular_row->ad_idprefix.$getpopular_row->ad_id.'">';
											echo '<img class="thumbnail" src="/cars/small_thumb/'.$img_folder.'/'.$images[0].'" />';
											echo "</a>";
										}elseif($getpopular_row->ad_categoria == "B"){
											echo '<a href="/resultados/anuncio_medio/'.$getpopular_row->ad_idprefix.$getpopular_row->ad_id.'">';
											echo '<img class="thumbnail" src="/cars/small_thumb/'.$img_folder.'/'.$images[0].'" />';
											echo "</a>";
										}elseif($getpopular_row->ad_categoria == "C"){
											echo '<a href="/resultados/anuncio_basico/'.$getpopular_row->ad_idprefix.$getpopular_row->ad_id.'">';
											echo '<img class="thumbnail" src="/cars/small_thumb/'.$img_folder.'/'.$images[0].'" />';
											echo "</a>";
										}
										
									}elseif(!$images){
										echo '<img class="thumbnail" src="/cars/small_thumb/no_image.jpg" />';
									}
								?>
								<span class="shortDesc" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>">
									<?php echo $getpopular_row->ad_marca." ".$getpopular_row->ad_modelo." - ". $getpopular_row->ad_year; ?><br />
									<?php echo $getpopular_row->ad_transmision; ?><br />
									<?php echo number_format($getpopular_row->ad_kilometraje, 0, ',', '.'); ?> Km<br />
									&#8353;
									<?php
										setlocale(LC_MONETARY, 'it_IT');
										echo money_format('%!.0n', $getpopular_row->ad_precio);
									?><br />
									<?php if($getpopular_row->ad_categoria == "A"): ?>
										<a href="/resultados/anuncio/<?php echo $getpopular_row->ad_idprefix.$getpopular_row->ad_id; ?>" class="plainDarkLink">Ver detalles</a>
									<?php elseif ($getpopular_row->ad_categoria == "B"): ?>
										<a href="/resultados/anuncio_medio/<?php echo $getpopular_row->ad_idprefix.$getpopular_row->ad_id; ?>" class="plainDarkLink">Ver detalles</a>
									<?php elseif ($getpopular_row->ad_categoria == "C"): ?> 
										<a href="/resultados/anuncio_basico/<?php echo $getpopular_row->ad_idprefix.$getpopular_row->ad_id; ?>" class="plainDarkLink">Ver detalles</a>
									<?php endif; ?>
								</span>
							</div>
							<?php endforeach; ?>
						<?php elseif (!$getpopular): ?>
							<span>No hay populares</span>
						<?php endif; ?>
					</div>
					<a href="/resultados/populares" class="buttonLink">Ver los carros m&aacute;s populares</a>
				</div>
				<div class="bottomBox featuredCars">
					<h2>Carros destacados</h2>
					<div>
						<?php if($getfeatured): ?>
							<?php foreach($getfeatured as $getfeatured_row): ?>
							<div class="carThumb <?php echo $condition = ($getfeatured_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
								<?php 
									$today = date('Y-m-d');
									$posted_date = date_create($getfeatured_row->ad_postedOn);
									$posted_date_format = date_format($posted_date, 'Y-m-d');
									$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
									$week_ahead_format = date_format($week_ahead, 'Y-m-d');
									$img_folder = strtolower($getfeatured_row->ad_idprefix).$getfeatured_row->ad_id;
									$folder_path = 'cars/small_thumb/'.$img_folder.'/';
									$images = get_filenames($folder_path);
									if($images){
										if($today >= $posted_date_format && $today <= $week_ahead_format){
											echo "<img src='/images/new_large_badge.png' style='left:0px;' class='newBadge' width='50' data-today=".$today." data-posted=".$posted_date_format." data-weekahead=".$week_ahead_format." />";
										}elseif($getfeatured_row->ad_nuevo == "1"){
											echo "<img src='/images/estrenar_badge.png' style='left:0px;' class='newBadge' width='50' />";
										}elseif($getfeatured_row->ad_nuevo == "0"){
											echo "<img src='/images/usado_badge.png' style='left:0px;' class='newBadge' width='50' />";
										}
										echo '<a href="/resultados/anuncio/'.$getfeatured_row->ad_idprefix.$getfeatured_row->ad_id.'">';
										echo '<img class="thumbnail" src="/cars/small_thumb/'.$img_folder.'/'.$images[0].'" />';
										echo "</a>";
									}elseif(!$images){
										echo '<img class="thumbnail" src="/cars/small_thumb/no_image.jpg" />';
									}
								?>
								<span class="shortDesc" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>">
									<?php echo $getfeatured_row->ad_marca." ".$getfeatured_row->ad_modelo." - ". $getfeatured_row->ad_year; ?><br />
									<?php echo $getfeatured_row->ad_transmision; ?><br />
									<?php echo number_format($getfeatured_row->ad_kilometraje, 0, ',', '.'); ?> Km<br />
									&#8353;
									<?php
										setlocale(LC_MONETARY, 'it_IT');
										echo money_format('%!.0n', $getfeatured_row->ad_precio);
									?><br />
									<a href="/resultados/anuncio/<?php echo $getfeatured_row->ad_idprefix.$getfeatured_row->ad_id; ?>" class="plainDarkLink">Ver detalles</a>
								</span>
							</div>
							<?php endforeach; ?>
						<?php elseif (!$getfeatured): ?> 
							<span>No hay destacados</span>
						<?php endif; ?>
					</div>
					<a href="/resultados/destacados" class="buttonLink">Ver los carros destacados</a>
				</div>
				<div class="bottomBox recentPost">
					<h2>Anuncios recientes</h2>
					<div>
						<?php if($getrecent): ?>
							<ul id="recentPostList">
								<?php foreach($getrecent as $getrecent_row): ?>
									<li>
										<a href="/resultados/anuncio_basico/<?php echo $getrecent_row->ad_idprefix.$getrecent_row->ad_id; ?>" class="plainDarkLink">
											<?php echo $getrecent_row->ad_marca." ".$getrecent_row->ad_modelo." / ".$getrecent_row->ad_year." - &#8353;".money_format('%!.0n', $getrecent_row->ad_precio); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php elseif (!$getrecent): ?>
							<span>No hay recientes</span>
						<?php endif; ?> 
					</div>
					<a href="/resultados/recientes" class="buttonLink">Ver los anuncios m&aacute;s recientes</a>
				</div>
			</div>
		</div>
		<div id="inDevelopment" style="display:none; text-align:center;">
			<h2 style="border:none;">Esta pagina es una demostraci&oacute;n</h2>
			<p>
				Le agradecemos su inter&eacute;s en carros506.com, sin embargo necesito informarle<br />
				que toda la informaci&oacute;n de carros, vendedores y anunciantes mostrada en este sitio es ficticia.<br /><br />
				Para ver el sitio actual, visite <a href="http://carros506.com">carros506.com</a>.<br /><br />
				Gracias.
			</p>
		</div>
		<div id="smartPhone" style="display:none; text-align:center;">
            <strong style="border:none;">Parece que est&aacute; usando un tel&eacute;fono?</strong>
            <p>
                En pantallas peque&ntilde;as el sitio tiene funcionalidad limitada. 
                M&aacute;s funciones est&aacute;n disponibles en pantallas mas grandes.<br />
                Gracias por visitarnos!
            </p>
        </div>
        <div id="smallTablet" style="display:none; text-align:center;">
            <strong style="border:none;">Parece que est&aacute; usando una tableta peque&ntilde;a?</strong>
            <p>
                En pantallas peque&ntilde;as el sitio tiene funcionalidad limitada. 
                M&aacute;s funciones est&aacute;n disponibles en pantallas mas grandes.<br />
                Gracias por visitarnos!
            </p>
        </div>
        <div id="regularTablet" style="display:none; text-align:center;">
            <h5 style="border:none;">Parece que est&aacute; usando una tableta?</h5>
            <p>
                En pantallas peque&ntilde;as el sitio tiene funcionalidad limitada. 
                M&aacute;s funciones est&aacute;n disponibles en pantallas mas grandes.<br />
                Gracias por visitarnos!
            </p>
        </div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/search_widget.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<script type="text/javascript" src="/js/jquery_slider.js"></script>
	<script type="text/javascript" src="/js/slideshow.js"></script>
	<?php $this->load->view('includes/footer'); ?>