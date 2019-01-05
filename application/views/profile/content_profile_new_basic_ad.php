	<?php $this->load->view('includes/header'); ?>
	<section class="newListingForm">
		<script>
			var image_limit = 5;
			var kb_limit = 5000;
			var fallback = false;
		</script>
		<div class="centerContainer">
		<div class="mainContentPages">
			<h1>Anuncio Nuevo</h1>
			<div class="horizontalBlock">
				<form action="/new_listing/create_basic_post" method="post" enctype="multipart/form-data" class="newListing" id="newListingSingle" novalidate="novalidate">
					<fieldset class="newListingSection">
						<legend><h5>Informaci&oacute;n del vendedor</h5></legend>
						<input type="hidden" name="profile_complete" value="<?php echo $contact_query['profile_complete']; ?>" />
						<input type="hidden" name="totalImages" id="totalImagesHidden" value="5" />
						<input type="hidden" name="listingCat" id="picListingCap" value="C" />
						<input type="hidden" name="sellerPrefix" value="<?php echo $contact_query['contact_categoria']; ?>" />
						<?php if($contact_query['profile_complete'] == 1): ?>
							<input type="hidden" name="sellerCode" value="<?php echo $contact_query['contact_prefix'].$contact_query['contact_id']; ?>" />
						<?php endif; ?>
						<input type="hidden" name="postedOn" value="<?php
								$postedDay = date("d");
								$postedMonth = date("m");
								$postedYear = date("Y");
								$notformattedposted = $postedYear."-".$postedMonth."-".$postedDay;
								echo $notformattedposted;
							?>" />
						<input type="hidden" name="expiresOn" value="<?php
								$expireDay = date("d");
								$expireMonth = date("m");
								if($expireMonth == 12){
									$months = "1";
									$addzero = ($months < 10) ? "0".$months: $months;
									$expireYear = date("Y")+1;
								}elseif($expireMonth == "01"){
									$months = $expireMonth = date("n")+1;
									$addzero = ($months < 10) ? "0".$months: $months;
									$expireYear = date("Y");
								}else{
									$months = $expireMonth = date("n")+1;
									$addzero = ($months < 10) ? "0".$months: $months;
									$expireYear = date("Y");
								}
								$notformatted = $expireYear."-".$addzero."-".$expireDay;
								$formated = date( 'Y-m-d', strtotime($notformatted));
								echo $formated;
							?>" />
						<table cellpadding="0" cellspacing="0" border="0">
							<colgroup>
								<col width="25%"/>
								<col width="75%" />
							</colgroup>
							<tr>
								<td><label for="sellerName">Nombre:</label></td>
								<td>
									<input type="text" name="sellerName" id="sellerName" readonly="readonly" value="<?php echo $contact_query['contact_fullname']; ?>" />
								</td>
							</tr>
							<?php if($contact_query['contact_categoria'] == "AG"): ?>
							<tr>
								<td><label for="dealerName">Agencia:</label></td>
								<td>
									<input type="text" name="dealerName" id="dealerName" readonly="readonly" value="<?php echo $contact_query['dealer_name']; ?>" />
								</td>
							</tr>
							<?php endif; ?>
							<tr>
								<td><label for="sellerEmail">Email:</label></td>
								<td>
									<input type="text" name="sellerEmail" id="sellerEmail" readonly="readonly" value="<?php echo $contact_query['contact_email']; ?>" />
								</td>
							</tr>
							<?php if($contact_query['profile_complete'] == 1): ?>
								<tr>
									<td><label for="sellerPhone">Tel&eacute;fono:</label></td>
									<td>
										<input type="text" name="sellerPhone" id="sellerPhone" readonly="readonly" value="<?php echo $contact_query['contact_phone']; ?>" />
									</td>
								</tr>
								<tr>
									<td>Provincia:</td>
									<td>
										<strong><?php echo $contact_query['contact_provincia']; ?></strong>
									</td>
								</tr>
								<tr>
									<td>Cant&oacute;n:</td>
									<td>
										<strong><?php echo $contact_query['contact_canton']; ?></strong>
									</td>
								</tr>
								<tr>
									<td>Distrito:</td>
									<td>
										<strong><?php echo $contact_query['contact_distrito']; ?></strong>
									</td>
								</tr>
								<tr>
									<td>Direcci&oacute;n:</td>
									<td>
										<strong>
											<?php echo $contact_query['contact_direccion']; ?>
										</strong>
									</td>
								</tr>
							<?php elseif($contact_query['profile_complete'] == 0): ?>
								<tr>
									<td><label class="fieldRequired" for="seller_cat">Categor&iacute;a:</label></td>
									<td>
										<input type="hidden" name="sellerCode" value="<?php echo $contact_query['contact_id']; ?>" />
										<?php 
											if($contact_query['contact_categoria'] == "PR"){
												$seller_type = "Vendedor Privado";
											}else{
												$seller_type = "Agencia";
											}
										?>
										<select name="sellerCat" id="sellerCat" readonly>
											<option value="<?php echo $contact_query['contact_categoria'] ?>"><?php echo $seller_type; ?></option>
										</select>
									</td>
								</tr>
								<!--<tr id="dealerNameRow" style="display:none;">
									<td><label class="fieldRequired" for="dealerName">Nombre de<br />la Agencia</label></td>
									<td>
										<input
											type="text"
											name="dealerName"
											id="dealerName"
											required="false"
											value=""
											data-error="Por favor digite el nombre de la Agencia"
											onclick="this.select();"
											autocomplete="off"
											data-validationtype="text" 
											disabled="disabled"
										/>
									</td>
								</tr>-->
								<tr>
									<td><label class="fieldRequired" for="sellerPhone">Tel&eacute;fono:</label></td>
									<td>
										<input
											type="text"
											name="sellerPhone"
											id="sellerPhone"
											value=""
											required="true"
											data-error="Por favor digite su n&uacute;mero de tel&eacute;fono"
											onclick="this.select();"
											autocomplete="off"
											data-validationtype="number"
										/>
									</td>
								</tr>
								<tr>
									<td><label class="fieldRequired" for="sellerProvince">Provincia:</label></td>
									<td>
										<select name="sellerProvince" id="sellerProvince" required="true" data-error="Por favor seleccione su provincia">
											<option value="">Seleccione una provincia</option>
											<option value="San Jos&eacute;">San Jos&eacute;</option>
											<option value="Cartago">Cartago</option>
											<option value="Heredia">Heredia</option>
											<option value="Alajuela">Alajuela</option>
											<option value="Puntarenas">Puntarenas</option>
											<option value="Lim&oacute;n">Lim&oacute;n</option>
											<option value="Guanacaste">Guanacaste</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><label class="fieldRequired" for="sellerCanton">Cant&oacute;n:</label></td>
									<td>
										<select name="sellerCanton" id="sellerCanton" required="true" data-error="Por favor seleccione su cant&oacute;n" disabled="disabled">
											<option value="">Seleccione su cant&oacute;n</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><label class="fieldRequired" for="sellerDistrito">Distrito:</label></td>
									<td>
										<select name="sellerDistrito" id="sellerDistrito" required="true" data-error="Por favor seleccione su distrito" disabled="disabled">
											<option value="">Seleccione su distrito</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><label class="fieldRequired" for="sellerAddress">Direcci&oacute;n:</label></td>
									<td>
										<textarea name="sellerAddress" id="sellerAddress" required="true" data-error="Por favor digite su direcci&oacute;n" placeholder="Direcci&oacute;n completa..."></textarea>
									</td>
								</tr>
							<?php endif; ?>
						</table>
					</fieldset>
					<fieldset class="newListingSection">
						<legend><h5>Informaci&oacute;n del carro</h5></legend>
						<table cellpadding="0" cellspacing="0" border="0">
							<colgroup>
								<col width="30%"/>
								<col width="70%" />
							</colgroup>
							<tr>
								<td><label class="fieldRequired" for="carMake">Marca</label></td>
								<td>
									<input
										type="text"
										name="carMake"
										id="carMake"
										value=""
										placeholder="Escoja o digite una marca..."
										autocomplete="off"
										onclick="this.select();"
										data-error="Por favor seleccione la marca de este carro" required="true"
										data-validationtype="text"
									/>
									<div class="makeSuggestWrap">
										<ul id="makeSuggest">
											<?php if($allmakes): ?>
												<?php foreach($allmakes as $allmakes_row): ?>
													<li class="makeDisplay"><?php echo $allmakes_row->ad_marca; ?></li>
												<?php endforeach; ?>
											<?php elseif(!$allmakes): ?>
												<li class="makeDisplay">No hay sugerencias</li>
											<?php endif;?>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carModel">Modelo</label></td>
								<td>
									<div class="modelSuggestWrap">
										<input
											type="text"
											name="carModel"
											id="carModel"
											value=""
											placeholder="Escoja o digite un modelo..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor seleccione el modelo de este carro"
											required="true"
											disabled="disabled"
											data-validationtype="text"
										/>
										<ul id="modelSuggest"></ul>
									</div>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carYear">A&ntilde;o</label></td>
								<td>
									<input
										type="text"
										name="carYear"
										id="carYear"
										value=""
										placeholder="A&ntilde;o..."
										autocomplete="off"
										onclick="this.select();"
										data-error="Por favor seleccione el a&ntilde;o de fabricaci&oacute;n"
										required="true"
										data-validationtype="number"
									/>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carMileage">Kilometraje</label></td>
								<td>
									<input
										type="text"
										name="carMileage"
										id="carMileage"
										value=""
										placeholder="Kilometraje..."
										autocomplete="off"
										onclick="this.select();"
										data-error="Por favor digite el kilometraje del carro"
										required="true"
										data-validationtype="number"
									/>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carPrice">Precio</label></td>
								<td>
									<input
										type="text"
										name="carPrice"
										id="carPrice"
										value=""
										placeholder="Precio..."
										autocomplete="off"
										onclick="this.select();"
										data-error="Por favor indique el precio del carro"
										required="true"
										data-validationtype="number"
									/>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carTrans">Transmisi&oacute;n:</label></td>
								<td>
									<select name="carTrans" id="carTrans" data-error="Por favor seleccione el tipo de transmisi&oacute;n" required="true">
										<option value="">Seleccione una opci&oacute;n</option>
										<option value="Manual">Manual</option>
										<option value="Autom&aacute;tico">Autom&aacute;tico</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="adProvince">Ubicaci&oacute;n</label></td>
								<td>
									<select name="adProvince" id="adProvince">
										<?php if($contact_query['profile_complete'] == 1): ?>
											<?php 
												$province = array(
													'sanjose' =>'San José', 
													'alajuela' => 'Alajuela', 
													'heredia' => 'Heredia', 
													'cartago' => 'Cartago', 
													'puntarenas' => 'Puntarenas', 
													'limon' => 'Limón', 
													'guanacaste' => 'Guanacaste'
													);
												foreach($province as $province_option => $key){
													if($contact_query['contact_provincia'] == $key){
														echo "<option selected='selected' value='".$province_option."' >".$key."</option>";
													}elseif($contact_query['contact_provincia'] != $key){
														echo "<option value='".$province_option."'>".$key."</option>";
													}
												}
											?>
										<?php elseif($contact_query['profile_complete'] == 0): ?>
											<option value="sanjose">San Jos&eacute;</option>
											<option value="cartago">Cartago</option>
											<option value="heredia">Heredia</option>
											<option value="alajuela">Alajuela</option>
											<option value="puntarenas">Puntarenas</option>
											<option value="limon">Lim&oacute;n</option>
											<option value="guanacaste">Guanacaste</option>
										<?php endif; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="carPlate">Estado</label></td>
								<td>
									<select name="carPlate" id="carPlate" data-error="Por favor indique si el carro es nuevo o usado?" required="true">
										<option value="">Seleccione una opci&oacute;n</option>
										<option value="1">Nuevo</option>
										<option value="0">Usado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label class="fieldRequired" for="legalStatus">Registrado</label></td>
								<td>
									<input type="radio" name="legalStatus" id="legalStatusYes" value="1" checked="checked"/>&nbsp;S&iacute; <small>(con placas)</small>&nbsp;&nbsp;
									<input type="radio" name="legalStatus" id="legalStatusNo" value="0"/>&nbsp;No <small>(en aduana)</small>
								</td>
							</tr>
						</table>
					</fieldset>
					<fieldset class="newListingSection">
						<legend><h5>Fotos del carro</h5></legend>
						<table cellpadding="0" cellspacing="0" border="0">
							<!--<tbody>
								<tr>
									<td><label class="fieldRequired" for="otherDetails">Detalles Adicionales:</label></td>
								</tr>
								<tr>
									<td>
										<textarea name="otherDetails" id="otherDetails" placeholder="Otros detalles..." rows="6" cols="26" required="true" data-error="Por favor indique detalles adicionales" /></textarea>
									</td>
								</tr>
								<tr><td><hr /></td></tr>
							</tbody>-->
							<tbody id="selectImage" style="display: none;">
								<tr>
									<td>
										<span>Puede agregar hasta 5 fotos a su anuncio.<label class="fieldRequired"></label></span><br /><br />
										<a href="#" class="buttonLink" id="imagesModal">Agregar fotos</a>
										<div id="selectImages">
											<h1>Seleccione sus fotos</h1>
											<div id="tempThumbs">
												<span>
													Puede seleccionar una o m&aacute;s fotos al mismo tiempo.<br />
													<small>Windows (control + click) or Mac (command + click)</small>
												</span>
												<input value="" required="true" class="chooseImg" data-error="Por favor seleccione al menos una imagen" autocomplete="off" data-validationtype="file" type="file" id="imageFiles" name="userfile[]" multiple />
												&nbsp;&nbsp;<span id="imageCount"></span><br />
												<output id="list"></output>
												<span id="imagesTotalWarning" >
													<div class="serverError">
														<table cellpadding="0" cellspacing="0" border="0" width="100%">
															<tr>
																<td width="90%" valign="center" align="center">
																	<h5 class="attention">
																		Por favor seleccione un m&aacute;ximo de 5 imagenes !
																	</h5>
																</td>
																<td width="10%" valign="center" align="left">
																	<img src="/images/warning_mid.png" />
																</td>
															</tr>
														</table>
													</div>
												</span>
											</div>
											<div id="byteCounter">
												<span>El l&iacute;mite es de 5 fotos o 5.000KB (5MB)</span>
												<span style="margin-bottom: 0px;"><h6>Total actual</h6></span>
												<span>
													<span id="currentTotal"class="xlarge" style="float:left; margin-right: 5px;">0KB</span>
													<img src="/images/checkmark_green_large.png" id="counterOk" style="float: left;"/>
													<img src="/images/delete_large.png" id="counterNotOk" style="float: left;"/>
												</span>
												<span style="margin-bottom: 0px;"><h6>L&iacute;mite</h6></span>
												<span id="totalLimit" class="xlarge attention">5.000KB</span>
												<span id="imagesWarning" >
													<div class="serverError">
														<table cellpadding="0" cellspacing="0" border="0" width="100%">
															<tr>
																<td width="90%" valign="center" align="center">
																	<h5 class="attention">
																		Las imanenes seleccionadas sobrepasan el l&iacute;mite permitido.<br /><br />
																		<small>Seleccione menos imagenes o imagenes de menor peso (KB).</small>
																	</h5>
																</td>
																<td width="10%" valign="center" align="left">
																	<img src="/images/warning_mid.png" />
																</td>
															</tr>
														</table>
													</div>
												</span>
												<span>
													<small>Si llega al l&iacute;mite en kylobytes pero no ha sobrepasado la cantidad de fotos permitidas, puede agregar m&aacute;s en la seccion de "mis anuncios" de su perfil.</small>
												</span>
												<span><a href="#" class="secondaryButton" id="acceptImages">Y&aacute; termin&eacute;</a></span>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
							<tbody id="selectImageFallback" style="display: block;">
								<tr>
									<td>
										<label class="fieldRequired" for="userfile">Puede agregar hasta 5 fotos a su anuncio</label><br /><br />
										<!--<span>Total: <span id="livePicCount">0</span> de 5 (m&aacute;ximo)</span>-->
									</td>
								</tr>
								<tr>
									<td>
										<div id="chooseFileWrap">
											<span>
											    <?php for($i = 1; $i < 6; $i++): ?>
											        <?php if($i == 1): ?>
												        <input type="file" name="userfile<?php echo $i; ?>" id="userfile<?php echo $i; ?>" value="" required="true" class="chooseImg" data-error="Por favor seleccione al menos una imagen" autocomplete="off" data-validationtype="file" />
											        <?php else: ?>
											            <input type="file" name="userfile<?php echo $i; ?>" id="userfile<?php echo $i; ?>" value="" class="chooseImg" autocomplete="off" />
										            <?php endif; ?>
												<?php endfor; ?>
											</span>
										</div>
									</td>
								</tr>
								<tr style="display: none;">
									<td>
										<div class="linkWithIcon">
											<span id="reachedMax"><strong>5 fotos m&aacute;ximo </strong><img src="/images/warning_red.png" /></span>
											<a href="#" class="plainDarkLink" id="adNewFile">Agregar otra foto <img src="/images/photo_camera.png" /></a>&nbsp;&nbsp;
											<a href="#" class="plainDarkLink" id="toggleSelectedPics">Ver seleccionadas &#9660;</a>
										</div>
									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td>
										<div style="font-size:70%; padding-top:10px;">
											Puede agregar fotos en formato .gif, .jpg, .jpeg o .png
										</div>
									</td>
								</tr>
								<tr><td><hr /></td></tr>
								<tr>
									<td>
										<label class="fieldRequired" for="create" ></label>&nbsp;&nbsp;Todos los campos son obligatorios.<br /><br />
										<input type="submit" class="secondaryButton" name="create_basic" id="create" value="Publicar" />
										<div id="postNewAd">
											<div style="text-align:center;">
												<h2 style="border:none;">Procesando</h2>
												<h5>Por favor espere</h5><br />
												<img src="/images/load_bar.png" alt="Procesando" style="display:inline;" />
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div style="font-size:70%; padding-top:10px;">
											Al publicar este anuncio, usted acepta los
											<a href="/pages/terminos" class="plainDarkLink">T&eacute;rminos y condiciones</a>, y garantiza que las imagenes
											publicadas est&aacute; libres de derechos de autor y que son de su propiedad.
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</fieldset>
				</form>
			</div>
			<div class="infoMessage" id="expirationNotice" style="display:none;">
				<h1>Anuncios expiran en 30 dias!</h1>
				<div class="serverError">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="90%" valign="center">
								<?php
                                    $break_future_date = date('d/m/Y', strtotime('+30 days'));
                                    $break_date_renew = explode('/', $break_future_date);
                                    setlocale(LC_TIME, "es_ES");
                                ?>
                                <h5>
                                    Todos los anuncios tienen una duraci&oacute;n de un mes.<br /><br />
                                    Si publica este anuncio hoy, el <strong><?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_renew[1], $break_date_renew[0], $break_date_renew[2])); ?></strong> ser&aacute; eliminado autom&aacute;ticamente.<br /><br />
                                    Para extender la duraci&oacute;n puede hacerlo en la secci&oacute;n "Mis Anuncios" de su perfil.
                                </h5>
							</td>
							<td width="10%" valign="center" align="left">
								<img src="/images/exclamation.png" />
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/page_model.js"></script>
	<script type="text/javascript" src="/js/new_listing.js"></script>
	<script type="text/javascript" src="/js/dialog.js"></script>
	<?php $this->load->view('includes/footer'); ?>