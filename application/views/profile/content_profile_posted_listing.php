	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h1>Y&aacute; termin&eacute; de crear su anuncio, Gracias <?php echo $this->session->userdata('member_name'); ?></h1><br />
				<div class="newListingBox">
					<span style="text-align: left;">
						<h5>Puede verlo aqu&iacute;</h5>
					</span>
					<?php
						if($last_ad['ad_categoria'] == "A"){
							$ad_type = "anuncio";
						}elseif($last_ad['ad_categoria'] == "B"){
							$ad_type = "anuncio_medio";
						}elseif($last_ad['ad_categoria'] == "C"){
							$ad_type = "anuncio_basico";
						}
					?>
					<br />
					<a href="/resultados/<?php echo $ad_type.'/'.$last_ad['ad_fullid']; ?>">
						<img class="" src="/cars/large_thumb/<?php echo strtolower($last_ad['ad_fullid']).'/'.strtolower($last_ad['ad_fullid']); ?>_1.jpg" />
					</a>
					<h5><?php echo $last_ad['ad_marca'].' '.$last_ad['ad_modelo'].' - '.$last_ad['ad_year']; ?></h5>
					<br />
					<h5><a class="secondaryButton" href="/resultados/<?php echo $ad_type.'/'.$last_ad['ad_fullid']; ?>">Ver la publicaci&oacute;n</a></h5>
				</div>
				<div class="newListingBox">
					<span style="text-align: left;">
						<h5>O puede modificarlo aqu&iacute;</h5>
					</span>
					<br />
					<a href="/profile/ad_details/<?php echo $last_ad['ad_fullid']; ?>">
						<img class="" src="/cars/large_thumb/<?php echo strtolower($last_ad['ad_fullid']).'/'.strtolower($last_ad['ad_fullid']); ?>_1.jpg" />
					</a>
					<h5><?php echo $last_ad['ad_marca'].' '.$last_ad['ad_modelo'].' - '.$last_ad['ad_year']; ?></h5>
					<br />
					<h5><a class="secondaryButton" href="/profile/ad_details/<?php echo $last_ad['ad_fullid']; ?>">Modificar anuncio</a></h5>
				</div>
				<div class="newListingBox" style="margin-right:0px;">
					<span style="text-align: left;">
						<h5>O puede crear un anuncio nuevo</h5>
					</span>
					<br />
					<a href="/profile/choose_ad">
						<img class="" src="/images/new_ad.jpg" />
					</a>
					<h5>Su carro aqu&iacute;</h5>
					<br />
					<a href="/profile/choose_ad" class="secondaryButton">Crear Anuncio Nuevo</a>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>