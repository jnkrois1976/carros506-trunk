	<?php $this->load->view('includes/header'); ?>
	<?php $is_logged_in = $this->session->userdata('is_logged_in'); ?>
	<section class="pages">
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
					Este anuncio ha sido visto <strong><em><?php echo $posting['ad_visits']; ?></em></strong> veces!
				</h5>
			</div>
		</div>
		<div class="galleryWrapper">
			<div id="bigPic">
				<?php
					$img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
					$folder_path = 'cars/large_premier/'.$img_folder.'/';
					$images = get_filenames($folder_path);
					$first_image = 0;
					foreach($images as $image_file => $key){
						if($first_image == 0){
							echo '<img id="largeThumb" src="/'.$folder_path.$key.'" />';
						}else{
							echo '<img src="/'.$folder_path.$key.'" />';
						}
						$first_image = 1;
					}
				?>
			</div>
		</div>
		
		<ul class="tabs">
			<li><a href="#tab1">Acerca de este carro</a></li>
			<li><a href="#tab2">Fotos</a></li>
			<li><a href="#tab3">Videos</a></li>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
				<colgroup width="30%" />
				<colgroup width="40%" />
				<colgroup width="30%" />
				<thead>
					<tr>
						<th colspan="2">
							Informaci&oacute;n del veh&iacute;culo
						</th>
						<th>
							Informaci&oacute;n del vendedor
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<ul class="listedDetails">
								<li>
									Marca: <em><?php echo $posting['ad_marca']; ?></em>
								</li>
								<li>
									Modelo: <em><?php echo $posting['ad_modelo']; ?></em>
								</li>
								<li>
									A&ntilde;o: <em><?php echo $posting['ad_year']; ?></em>
								</li>
								<li>
									Precio: <em><?php echo "&#8353;".money_format('%!.0n', $posting['ad_precio']); ?></em>
								</li>
								<li>
									Carroceria: <em><?php echo $posting['ad_carroceria']; ?></em>
								</li>
								<li>
									Estado: <em><?php echo $posting['ad_estado']; ?></em>
								</li>
								<li>
									CC: <em><?php echo $posting['ad_centimetros']; ?></em>
								</li>
								<li>
									Cilindros: <em><?php echo $posting['ad_motor']; ?></em>
								</li>
								
							</ul> 
						</td>
						<td>
							<ul class="listedDetails">
								<li>
									Combustible: <em><?php echo $posting['ad_combustible']; ?></em>
								</li>
								<li>
									Transmisi&oacute;n: <em><?php echo $posting['ad_transmision']; ?></em>
								</li>
								<li>
									Kilometraje: <em><?php echo number_format($posting['ad_kilometraje'], 0, ',', '.'); ?></em>
								</li>
								<li>
									Puertas: <em><?php echo $posting['ad_puertas']; ?></em>
								</li>
								<li>
									Tracci&oacute;n: <em><?php echo $posting['ad_traccion']; ?></em>
								</li>
								<li>
									Ubicaci&oacute;n: <em><?php echo $posting['ad_location']; ?></em>
								</li>
								<li>
									Detalles adicionales: <em><?php echo $posting['ad_detalles']; ?></em>
								</li>
							</ul>
						</td>
						<td>
							<ul class="listedDetails">
								<!--<li>
									Vendedor: <em><?php echo $posting['ad_sellerCategory']; ?></em>
								</li>-->
								<li>
									Vendedor: <em>Agencia</em>
								</li>
								<!--<li>
									Nombre: <em><?php echo $posting['ad_sellerName']; ?></em>
								</li>-->
								<li>
									Nombre: <em><a href="/resultados/agencia/<?php echo $posting['ad_sellerId']; ?>" class="plainDarkLink"><?php echo $posting['ad_sellerName']; ?></a></em>
								</li>
								<li>
									Tel&eacute;fono: <em><?php echo $posting['ad_sellerPhone']; ?></em>
								</li>
								<li>
									Fecha de publicaci&oacute;n:
									<em>
										<?php
											$break_date = explode('-', $posting['ad_postedOn']);
											setlocale(LC_TIME, "es_ES"); 
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date[1], $break_date[2], $break_date[0]));
										?>
									</em>
								</li>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
			</div>
			<div id="tab2" class="tab_content">
			   <ul id="thumbs">
					<?php
						$img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
						$folder_path = 'cars/small_premier/'.$img_folder.'/';
						$images = get_filenames($folder_path);
						$i = 0;
						foreach($images as $image_file => $key){
							$i++;
							if($i == 1){
								echo '<li class="active" rel="'.$i.'"><img src="/'.$folder_path.$key.'"/></li>';
							}else{
								echo '<li rel="'.$i.'"><img src="/'.$folder_path.$key.'"/></li>';
							}
						}
					?>
				</ul>
			</div>
			<div id="tab3" class="tab_content">
				<a href="#" class="play">
					<img src="/images/video_play_thumb.jpg" alt="<?php echo $posting['ad_marca']." ".$posting['ad_modelo']." ".$posting['ad_year']; ?>" />
				</a>
				<div id="video" style="display: none;">
					<video width="960" height="540" controls="controls" preload="auto" poster="/images/videoLoading.gif">
						<?php
							$codecs = array("video/mp4; codecs='avc1.42E01E, mp4a.40.2'", "video/ogg; codecs=theora,vorbis", "video/webm; codecs='vp8, vorbis'");
							$img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
							$folder_path = 'cars/video_premier/'.$img_folder.'/';
							$images = get_filenames($folder_path);
							$i = 0;
							foreach($images as $image_file => $key){
								echo '<source src="/'.$folder_path.$key.'" type="'.$codecs[$i].'" />';
								$i++;
							}
						?>
						Your browser does not support the video tag.
					</video> 
				</div>
			</div>
		</div>
		<div class="socialSharing">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="socialIcons">
				<colgroup>
					<col width="33%" />
					<col width="33%" />
					<col width="34%" />
				</colgroup>
				<tbody>
					<tr>
						<td>
							<div class="fb-like" data-href="<?=current_url()?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
						</td>
						<td>
							<g:plusone size="medium"></g:plusone>
							<script type="text/javascript">
								window.___gcfg = {lang: 'es'};
								(function() {
									var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									po.src = 'https://apis.google.com/js/plusone.js';
									var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								})();
							</script>
						</td>
						<td>
							<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
							<a href="http://twitter.com/share" class="twitter-share-button" title=""></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<table cellpadding="5" cellspacing="0" border="0" class="socialSharing" width="100%">
			<colgroup>
				<!--<col width="12%" />
				<col width="12%" />-->
				<col width="16%" />
				<col width="16%" />
				<col width="16%" />
				<col width="16%" />
				<col width="16%" />
			</colgroup>
			<tbody>
				<tr>
					<!--<td>
						<div id="fb-root"></div>
						<script src="http://connect.facebook.net/en_US/all.js#appId=176456392424253&amp;xfbml=1"></script>
						<fb:like href="" send="false" layout="button_count" width="30" show_faces="false" font=""></fb:like>
					</td>
					<td>
						<g:plusone size="medium"></g:plusone>
						<script type="text/javascript">
							window.___gcfg = {lang: 'es'};
							(function() {
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/plusone.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							})();
						</script>
					</td>
					<td>
						<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
						<a href="http://twitter.com/share" class="twitter-share-button" title=""></a>
					</td>-->
					<td class="withBorder">
						<?php
							if($is_logged_in == true){
								if($is_favorite == false){
									echo "<div id='favorites'>";
									echo '<a href="#" id="adToFavorites" data-adid="'.$posting['ad_idprefix'].$posting['ad_id'].'" data-adexpires="'.$posting['ad_expires'].'" data-memberid="'.$email_name['contact_prefix'].$email_name['contact_id'].'">Agregar a <br />mis favoritos</a>';
									echo "</div>";
								}else{
									echo "<div id='nofavorites'>";
									echo '<a href="#" id="removeFromFavorites" data-adid="'.$posting['ad_idprefix'].$posting['ad_id'].'" data-memberid="'.$email_name['contact_prefix'].$email_name['contact_id'].'">Eliminar de<br />mis favoritos</a>';
									echo "</div>";
								}
							}else{
								echo "<div id='favorites'>";
								echo '<a href="#" id="notLoggedInFavorites" data-error="Favor ingresar o registrarse para agregar a sus favoritos!">Agregar a <br />mis favoritos</a>';
								echo "</div>";
							}
						?>
					</td>
					<td class="withBorder">
						<?php 
							$total_rating_score = $posting['ad_rating'];
							$total_voters = $posting['ad_voters'];
							if($total_voters > 0){
								$average_score = round($total_rating_score / $total_voters);
							}else{
								$average_score = 0;
							}
							echo "<div id='rating' data-voters='".$total_voters."' data-score='".$total_rating_score."' data-postid='".$posting['ad_fullid']."' data-rated='false'>";
							echo "<div id='ratingTitleWrapper'>";
							echo "<div id='ratingTitle'>Calificar</div>";
							echo "<div id='ratingDetails'>Votos: <span id='votersCount'>".$total_voters."</span> - Puntaje: <span id='pointsCount'>".$average_score."</span></div>";
							echo "</div>";
							for ($i=0; $i < 5; $i++) {
								$c = $i + 1;
								if($is_logged_in == true){
									if($is_rated == false){ 
										if($average_score > $i){
											echo "<span id='p_star".$c."' class='full' data-rated='false' data-points='".$c."'></span>";
										}else{
											echo "<span id='p_star".$c."' data-rated='false' data-points='".$c."'></span>";
										}
									}else{
										if($average_score > $i){
											echo "<span id='ratingBlocked".$c."' class='full' data-rated='true' data-points='".$c."' data-error='Ya calificaste este carro anteriormente!'></span>";
										}else{
											echo "<span id='ratingBlocked".$c."' data-rated='false' data-points='".$c."' data-error='Ya calificaste este carro anteriormente!'></span>";
										}
									}
								}else{
									if($average_score > $i){
										echo "<span id='notLoggedInStar".$c."' class='full' data-rated='true' data-points='".$c."' data-error='Favor ingresar o registrarse para calificar!'></span>";
									}else{
										echo "<span id='notLoggedInStar".$c."' data-rated='false' data-points='".$c."' data-error='Favor ingresar o registrarse para calificar!'></span>";
									}
								}
							}
						?>
					</td>
					<td class="withBorder">
						<div id="sellerEmail">
							<?php
								if($is_logged_in == true){
									$seller = $posting['ad_sellerId'];
									$buyer = $email_name['contact_prefix'].$email_name['contact_id'];
									if($seller == $buyer){
										echo '<a href="#" id="notLoggedInMessage" data-error="No puede enviar mensajes a usted mismo!">Mensaje<br />al vendedor</a>';
									}elseif($seller != $buyer){
										echo '<a href="#" id="quickMessage">Mensaje<br />al vendedor</a>';
									}
								}else{
									echo '<a href="#" id="notLoggedInMessage" data-error="Favor ingresar o registrarse para enviar mensajes!">Mensaje<br />al vendedor</a>';
								}
							?>
						</div>
					</td>
					<td class="withBorder">
						<div id="friendEmail">
							<?php
								if($is_logged_in == true){
									echo '<a href="#" id="emailToFriend">Enviar<br /> a un amigo</a>';
								}else{
									echo '<a href="#" id="notLoggedInFriend" data-error="Favor ingresar o registrarse para compartir con amigos!">Enviar<br /> a un amigo</a>';
								}
							?>
						</div>
					</td>
					<td class="withBorder">
						<div id="reportPost">
							<?php
								if($is_logged_in == TRUE){
									if($is_reported == TRUE){
										if($self_report_premier == TRUE){
											echo '<a href="#" id="reportBlocked" data-error="No puedes reportar tu propio anuncio!">Reportar<br />anuncio!</a>';
										}else{
											echo "<a href='#' id='reportThisPost'>Reportar<br />anuncio!</a>";
										}
									}else{
										echo '<a href="#" id="reportBlocked" data-error="Ya reportaste este anuncio anteriormente!">Reportar<br />anuncio!</a>';
									}
								}else{
									echo '<a href="#" id="notLoggedInReport" data-error="Favor ingresar o registrarse para reportar este anuncio!">Reportar<br />anuncio!</a>';
								}
							?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php if($is_logged_in == true): ?>
		<div id="dialogQuickMessage" title="Mensaje r&aacute;pido al vendedor">
			<form method="post" action="" id="quickMessageForm">
				<fieldset>
					<input id="buyer_name" type="hidden" name="buyer_name" value="<?php echo $email_name['contact_fullname']; ?>" />
					<input id="buyer_email" type="hidden" name="buyer_email" value="<?php echo $email_name['contact_email']; ?>" />
					<input id="buyer_id" type="hidden" name="buyer_id" value="<?php echo $email_name['contact_prefix'].$email_name['contact_id']; ?>" />
					<input id="seller_id" type="hidden" name="seller_id" value="<?php echo $posting['ad_sellerId']; ?>" />
					<input id="ad_fullid" type="hidden" name="ad_fullid" value="<?php echo $posting['ad_fullid']; ?>" />
					<input type="hidden" value="anuncios_premier" name="donde" id="donde" />
					<label for="name">Para: <?php echo $posting['ad_sellerName']; ?></label>
					<br /><br />
					<label for="email">De: <?php echo $email_name['contact_fullname']; ?></label>
					<br /><br />
					<label for="question">Su mensaje:</label><br />
					<textarea id="buyer_message" name="buyer_message" cols="40" rows="10" ></textarea><br /><br />
					<input id="msgToSeller" type="submit" value="Enviar" name="submit" class="button search" />
				</fieldset>
			</form>
			<div id="quickMessageSuccess" style="display:none; text-align:center;">
				<img src="/images/checkmark_large.png" /><br />
				<h2 style="border:none;">Su mensaje ha sido enviado!</h2>
			</div>
			<div id="quickMessageFailed" style="display:none; text-align:center;">
				<img src="/images/warning_large.png" /><br />
				<h5 style="border:none;">Hubo un error, y no pudimos enviar su mensaje!</h5><br />
				Por favor intente de nuevo.
			</div>
		</div>
		<div id="dialogEmailToFriend" title="Enviar a un amigo">
			<form method="post" action="" id="emailToFriendForm">
				<fieldset>
					<input id="buyer_name_friend" type="hidden" name="buyer_name_friend" value="<?php echo $email_name['contact_fullname']; ?>" />
					<input id="ad_full_link" type="hidden" name="ad_full_link" value="<?php echo base_url().$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/"; ?>" />
					<label>De: <?php echo $email_name['contact_fullname']; ?></label>
					<br /><br />
					<label for="friend_email">Para (email de su amigo): </label>
					<input type="email" name="friend_email" id="friend_email" value="" data-error="Por favor digite una direcci&oacute;n de correo v&aacute;lida" />
					<br /><br />
					<label for="question">Su mensaje:</label><br />
					<textarea id="message_to_friend" name="message_to_friend" cols="50" rows="3"></textarea><br /><br />
					<span>Un link a este anuncio se agregar&aacute; al mensaje automaticamente.</span><br /><br />
					<input id="emailToFriendSubmit" type="submit" value="Enviar" name="submit" class="button search" />
				</fieldset>
			</form>
			<div id="emailToFriendSuccess" style="display:none; text-align:center;">
				<img src="/images/checkmark_large.png" /><br />
				<h2 style="border:none;">Su mensaje ha sido enviado!</h2>
			</div>
			<div id="emailToFriendFailed" style="display:none; text-align:center;">
				<img src="/images/warning_large.png" /><br />
				<h5 style="border:none;">Hubo un error, y no pudimos enviar su mensaje!</h5><br />
				Por favor intente de nuevo.
			</div>
		</div>
		<div id="dialogReportPost" title="Reportar este anuncio" style="display: none;">
			<form method="" action="post" id="reportPostForm">
				<fieldset>
					<input type="hidden" name="report_buyer_fullid" id="report_buyer_fullid" value="<?php echo $email_name['contact_prefix'].$email_name['contact_id']; ?>" />
					<input type="hidden" name="report_seller_fullid" id="report_seller_fullid" value="<?php echo $posting['ad_sellerId']; ?>" />
					<input type="hidden" name="report_ad_fullid" id="report_ad_fullid" value="<?php echo $posting['ad_fullid']; ?>" />
					<input type="hidden" name="report_ad_expires" id="report_ad_expires" value="<?php echo $posting['ad_expires']; ?>" />
					<input type="hidden" name="report_ad_reports" id="report_ad_reports" value="<?php echo $posting['ad_reports']; ?>" />
					<input id="donde" type="hidden" name="donde" value="anuncios">
					<span>
						Nos preocupamos por brindar informaci&oacute;n correcta para cada anuncio.<br /><br />
						Por favor indique la raz&oacute;n por la cual desea reportar este anuncio.<br /><br />
						Una vez que hayamos verificado la informaci&oacute;n con el vendedor, corregiremos el anuncio inmediatamente.<br /><br />
						Gracias por su cooperaci&oacute;n.
					</span><br /><br />
					<textarea name="report_message" id="report_message" cols="50" rows="10"></textarea><br /><br />
					<input type="submit" name="report_sumbit" id="report_submit" class="button search" value="Reportar" />
				</fieldset>
			</form>
			<div id="reportSuccess" style="display:none; text-align:center;">
				<img src="/images/checkmark_large.png" /><br />
				<h2 style="border:none;">Este anuncio ha sido reportado!</h2>
			</div>
			<div id="reportFailed" style="display:none; text-align:center;">
				<img src="/images/warning_large.png" /><br />
				<h5 style="border:none;">Hubo un error, y no pudimos reportar este anuncio!</h5><br />
				Por favor intente de nuevo.
			</div>
		</div>
		<?php endif; ?>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/slideshow_premier.js"></script>
	<script type="text/javascript" src="/js/tabs.js"></script>
	<script type="text/javascript" src="/js/video.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<?php $this->load->view('includes/footer'); ?>