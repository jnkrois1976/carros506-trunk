	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h1>Los Carros Destacados</h1>
				<?php if($get_destacados): ?>
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
					<?php foreach($get_destacados as $get_destacados_row): ?>
						<?php 
							$today = date('Y-m-d');
							$posted_date = date_create($get_destacados_row->ad_postedOn);
							$posted_date_format = date_format($posted_date, 'Y-m-d');
							$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
							$week_ahead_format = date_format($week_ahead, 'Y-m-d');
							$img_folder = strtolower($get_destacados_row->ad_idprefix).$get_destacados_row->ad_id;
							$folder_path = 'cars/small_thumb/'.$img_folder.'/';
							$images = get_filenames($folder_path);
						?>
						<div class="carThumb <?php echo $condition = ($get_destacados_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
							<?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
								<img src='/images/new_large_badge.png' class='newBadge' width="50" data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>" />
							<?php elseif($get_destacados_row->ad_nuevo == "1"): ?>
								<img src='/images/estrenar_badge.png' class='newBadge' width="50" />
							<?php elseif($get_destacados_row->ad_nuevo == "0"): ?>	
								<img src='/images/usado_badge.png' class='newBadge' width="50" />
							<?php endif; ?>
							<a href="/resultados/anuncio/<?php echo $get_destacados_row->ad_idprefix.$get_destacados_row->ad_id; ?>">
								<img class="thumbnail" src="/cars/small_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" />
							</a>
							<span class="shortDesc">
								<?php echo $get_destacados_row->ad_marca." ".$get_destacados_row->ad_modelo." - ".$get_destacados_row->ad_year; ?><br />
								<?php 
									if ($get_destacados_row->ad_nuevo == "1") {
										echo "Para estrenar";
									}elseif($get_destacados_row->ad_nuevo == "0"){
										echo "Usado"; 
									} 
								?><br />
								<?php echo number_format($get_destacados_row->ad_kilometraje, 0, ',', '.')." Km"; ?><br />
								&#8353;
								<?php
									setlocale(LC_MONETARY, 'it_IT');
									echo money_format('%!.0n', $get_destacados_row->ad_precio);
								?><br />
								<a href="/resultados/anuncio/<?php echo $get_destacados_row->ad_idprefix.$get_destacados_row->ad_id; ?>" class="plainDarkLink">Ver detalles</a>
							</span>
						</div>
					<?php endforeach; ?>
					</div>
				<?php elseif(!$get_destacados): ?>
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
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>