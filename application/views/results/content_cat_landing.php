	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
		<div class="mainContentPages">
			<div class="horizontalBlock">
				<h1>Categor&iacute;as</h1>
				<?php if($allmakes): ?>
				<div class="catWrapper">
					<h2>Marcas</h2>
					<ul class="makeListLarge">
					<?php foreach($allmakes as $allmakes_row): ?>
						<li>
							<a href="/resultados/categorias/marca_<?php echo $allmakes_row->ad_marca; ?>">
								<img src="/svg/make_logos/<?php echo strtolower($allmakes_row->ad_marca); ?>.svg" />
							</a>
						</li>
                    <?php endforeach; ?>
                    </ul>
				</div>
				<?php endif; ?>
				<div class="catWrapper">
					<h2>Carrocer&iacute;a</h2>
					<ul class="bodyListLarge">
						<li>
							<a href="/resultados/categorias/carroceria_sedan" title="Sedan">
								<img src="/images/sedan.png" alt="Sedan" /><br /><small>Sedan</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_station" title="Station Wagon">
								<img src="/images/station.png" alt="Station Wagon" /><br /><small>Station Wagon</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_suv" title="Sport Utility Vehicle (SUV)">
								<img src="/images/suv.png" alt="Sport Utility Vehicle (SUV)" /><br /><small>Sport Utility Vehicle (SUV)</small>	
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_hatchback" title="Hatchback">
								<img src="/images/hatchback.png" alt="Hatchback" /><br /><small>Hatchback</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_minivan" title="Minivan">
								<img src="/images/minivan.png" alt="Minivan" /><br /><small>Minivan</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_coupe" title="Coupe">
								<img src="/images/coupe.png" alt="Coupe" /><br /><small>Coupe</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_convertible" title="Convertible">
								<img src="/images/convertible.png" alt="Convertible" /><br /><small>Convertible</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_deportivo" title="Deportivo">
								<img src="/images/deportivo.png" alt="Deportivo" /><br /><small>Deportivo</small>
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/carroceria_pickup" title="Pickup">
								<img src="/images/pickup.png" alt="Pickup" /><br /><small>Pickup</small>
							</a>
						</li>
						
						<li>
							<a href="/resultados/categorias/carroceria_van" title="Van">
								<img src="/images/van.png" alt="Van" /><br /><small>Van</small>
							</a>
						</li>
					</ul>
				</div>
				<div class="catWrapper">
					<h2>Provincias</h2>
					<ul class="provinceList">
						<li>
							<a href="/resultados/categorias/location_sanjose" title="San Jos&eacute;">
								<img src="/images/sjo_flag.png" alt="San Jos&eacute;" /><br />San Jos&eacute;
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_alajuela" title="Alajuela">
								<img src="/images/alajuela_flag.png" alt="Alajuela" /><br />Alajuela
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_heredia" title="Heredia">
								<img src="/images/heredia_flag.png" alt="Heredia" /><br />Heredia
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_cartago" title="Cartago">
								<img src="/images/cartago_flag.png" alt="Cartago" /><br />Cartago
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_puntarenas" title="Puntarenas">
								<img src="/images/puntarenas_flag.png" alt="Puntarenas" /><br />Puntarenas
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_limon" title="Lim&oacute;n">
								<img src="/images/limon_flag.png" alt="Lim&oacute;n" /><br />Lim&oacute;n
							</a>
						</li>
						<li>
							<a href="/resultados/categorias/location_guanacaste" title="Guanacaste">
								<img src="/images/guanacaste_flag.png" alt="Guanacaste" /><br />Guanacaste
							</a>
						</li>
					</ul>
				</div>
				<div class="catWrapper">
					<h2>Motor o transmisi&oacute;n</h2>
					<ul class="motorTrans">
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/motor_4">4 Cilindros</a>
						</li>
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/motor_6">6 Cilindros</a>
						</li>
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/motor_8">8 Cilindros</a>
						</li>
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/motor_10">10 Cilindros</a>
						</li>
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/motor_12">12 Cilindros</a>
						</li>
						<br />
						<hr />
						<br />
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/transmision_manual">Manual</a>
						</li>
						<li>
							<a class="plainDarkLink" href="/resultados/categorias/transmision_automatico">Autom&aacute;tico</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="centerContainer">
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<?php $this->load->view('includes/footer'); ?>