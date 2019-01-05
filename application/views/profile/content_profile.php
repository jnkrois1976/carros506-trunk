	<?php 
		$this->load->view('includes/header'); 
		/**** PAGE ARRAYS ****/
		$province = array('San José', 'Alajuela', 'Heredia', 'Cartago', 'Puntarenas', 'Limón', 'Guanacaste');	
	?>
	<section>
		<div class="centerContainer">
			<div class="mainContentPages">
				<div class="myInfoWrapper">
					<div class="personalInfo">
						<h2>Informaci&oacute;n del Contacto</h2>
						<?php 
							if($contact_query['profile_complete'] == "0"){
								echo '<div class="userNotice">Por favor complete su perfil</div>';	
							}
						?>
						<script>
							<?php 
								if($contact_query['contact_categoria'] == "PR" || $contact_query['contact_categoria'] == ""){
									echo "var fieldsToUpdate = ['editPhone', 'editCanton', 'editDistrito', 'editDireccion']";
								}elseif($contact_query['contact_categoria'] == "AG"){
									echo "var fieldsToUpdate = ['editDealerName', 'editPhone', 'editCanton', 'editDistrito', 'editDireccion']";
								}
							?>
						</script>
						<table cellpadding="0" cellspacing="0" border="0" class="profileDetails">
							<colgroup>
								<col width="30%">
								<col width="50%">
								<col width="30%">
							</colgroup>
							<tr>
								<td>Vendedor:</td>
								<td>
									<?php
										$define_seller_cat = $contact_query['contact_categoria'];
										if($contact_query['contact_categoria'] == "PR" || $contact_query['contact_categoria'] == ""){
											echo "Privado";
										}elseif($contact_query['contact_categoria'] == "AG"){
											echo "Agencia";
										}
										if($contact_query['profile_complete'] == "0"){
											$button_text = "Agregar";
										}elseif($contact_query['profile_complete'] == "1"){
											$button_text = "Editar";
										}
									?>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>C&oacute;digo:</td>
								<td><?php echo $this->session->userdata('member_id'); ?></td>
								<td>&nbsp;</td>
							</tr>
							<?php if($contact_query['contact_categoria'] == "PR" || $contact_query['contact_categoria'] == ""): ?>
							<tr>
								<td>Nombre:</td>
								<td>
									<input id="editName" type="text" data-validationtype="text" value="<?php echo $contact_query['contact_fullname']; ?>" data-defaultvalue="<?php echo $contact_query['contact_fullname']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_fullname" />
								</td>
								<td>
									<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editName">Editar</button>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editName">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editName">Guardar</button>
								</td>
							</tr>
							<?php elseif($contact_query['contact_categoria'] == "AG"): ?>
							<tr>
								<td>Nombre del contacto:</td>
								<td>
									<input id="editName" type="text" data-validationtype="text" value="<?php echo $contact_query['contact_fullname']; ?>" data-defaultvalue="<?php echo $contact_query['contact_fullname']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_fullname" />
								</td>
								<td>
									<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editName">Editar</button>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editName">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editName">Guardar</button>
								</td>
							</tr>
							<tr>
								<td>Nombre de la agencia:</td>
								<td>
									<?php if($contact_query['dealer_name'] == ""): ?>
										<input id="editDealerName" placeholder="-" type="text" data-validationtype="text" value="" data-defaultvalue="<?php echo $contact_query['dealer_name']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="dealer_name" data-error="Por favor indique el nombre de la agencia." />
									<?php elseif($contact_query['dealer_name'] != ""): ?>
										<input id="editDealerName" type="text" data-validationtype="text" value="<?php echo $contact_query['dealer_name']; ?>" data-defaultvalue="<?php echo $contact_query['dealer_name']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="dealer_name" />
									<?php endif; ?>
								</td>
								<td>
									<?php if($contact_query['dealer_name'] == ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editDealerName">Agregar</button>
									<?php elseif($contact_query['dealer_name'] != ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editDealerName">Editar</button>
									<?php endif; ?>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editDealerName">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editDealerName">Guardar</button>
								</td>
							</tr>
							<?php endif; ?>
							<tr>
								<td>Tel&eacute;fono:</td>
								<td>
									<?php if($contact_query['contact_phone'] == ""): ?>
										<input id="editPhone" type="text" placeholder="-" data-validationtype="number" value="<?php echo $contact_query['contact_phone']; ?>" data-defaultvalue="<?php echo $contact_query['contact_phone']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_phone" data-error="Por favor digite el n&uacute;mero de tel&eacute;fono." />
									<?php elseif($contact_query['contact_phone'] != ""): ?>
										<input id="editPhone" type="text" placeholder="-" data-validationtype="number" value="<?php echo $contact_query['contact_phone']; ?>" data-defaultvalue="<?php echo $contact_query['contact_phone']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_phone" data-error="Por favor digite el n&uacute;mero de tel&eacute;fono." />
									<?php endif; ?>
								</td>
								<td>
									<?php if($contact_query['contact_phone'] == ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editPhone">Agregar</button>
									<?php elseif($contact_query['contact_phone'] != ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editPhone">Editar</button>
									<?php endif; ?>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editPhone">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editPhone">Guardar</button>
								</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>
									<input id="editEmail" type="text" data-validationtype="email" value="<?php echo $contact_query['contact_email']; ?>" data-defaultvalue="<?php echo $contact_query['contact_email']; ?>" disabled="disabled" data-adid="<?php echo $contact_query['contact_email']; ?>" data-dbfield="contact_email" data-error="Por favor digite una direcci&oacute;n de correo v&aacute;lida"/>
								</td>
								<td>
									<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editEmail">Editar</button>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editEmail">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editEmail">Guardar</button>
								</td>
							</tr>
							<tr>
								<td>Provincia:</td>
								<td>
									<span id="contactProv" class="groupSelectSpan">
										<?php echo $contact_query['contact_provincia']; ?>
									</span>
									<select name="editProvincia" id="editProvincia" class="groupSelect" data-selected="false" data-error="Por favor seleccione su provincia" required="true" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_provincia" style="display:none;" disabled="disabled">
										<option value="">Seleccione su provincia</option>
										<?php 
											foreach($province as $province_option){
												if($contact_query['contact_provincia'] == $province_option){
													echo "<option selected='selected' value='".$province_option."' >".$province_option."</option>";
												}elseif($contact_query['contact_provincia'] != $province_option){
													echo "<option value='".$province_option."'>".$province_option."</option>";
												}
											}
										?>
									</select>
								</td>
								<td>
									<?php if($contact_query['contact_provincia'] == ""): ?>
										<button type="button" value="Editar" class="editGroup" data-ishidden="true" data-spandata="contactProv" data-field="editProvincia">Agregar</button>
									<?php elseif($contact_query['contact_provincia'] != ""): ?>
										<button type="button" value="Editar" class="editGroup" data-ishidden="true" data-spandata="contactProv" data-field="editProvincia">Editar</button>
									<?php endif; ?>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="true" data-spandata="contactProv" data-field="editProvincia">Cancelar</button>
									<button type="button" value="Guardar" class="saveLocation" data-ishidden="true" data-spandata="contactProv" data-field="editProvincia" disabled="disabled">Guardar</button>
								</td>
							</tr>
							<tr>
								<td>Cant&oacute;n:</td>
								<td>
									<span id="contactCant" class="groupSelectSpan">
										<?php echo $contact_query['contact_canton']; ?>
									</span>
									<select name="editCanton" id="editCanton" class="groupSelect" data-selected="false" data-error="Por favor seleccione su cant&oacute;n" required="true" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_canton" style="display:none;" disabled="disabled">
										<option value="">Seleccione su cant&oacute;n</option>
									</select>
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>Distrito:</td>
								<td>
									<span id="contactDist" class="groupSelectSpan">
										<?php echo $contact_query['contact_distrito']; ?>
									</span>
									<select name="editDistrito" id="editDistrito" class="groupSelect" data-selected="false" data-error="Por favor seleccione su distrito" required="true" data-adid="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_distrito" style="display:none;" disabled="disabled">										
										<option value="">Seleccione su distrito</option>
									</select>
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="2">Direcci&oacute;n:</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2">
									<?php if($contact_query['contact_direccion'] == ""): ?>
										<textarea cols="57" id="editDireccion" class="editDireccion" disabled="disabled" data-id="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_direccion" placeholder="-" data-error="Por favor digite la direcci&oacute; de la agencia."></textarea>
									<?php elseif($contact_query['contact_direccion'] != ""): ?>
										<textarea cols="57" id="editDireccion" class="editDireccion" disabled="disabled" data-id="<?php echo $contact_query['contact_fullid']; ?>" data-dbfield="contact_direccion" data-error="Por favor digite la direcci&oacute; de la agencia."><?php echo $contact_query['contact_direccion']; ?></textarea>
									<?php endif; ?>
								</td>
								<td>
									<?php if($contact_query['contact_direccion'] == ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editDireccion">Agregar</button>
									<?php elseif($contact_query['contact_direccion'] != ""): ?>
										<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editDireccion">Editar</button>
									<?php endif; ?>
									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editDireccion">Cancelar</button>
									<button type="button" value="Guardar" class="saveProfile" data-ishidden="false" data-field="editDireccion">Guardar</button>
								</td>
							</tr>
						</table>
					</div>
					<div class="newListingBox" style="margin-right:0px;">
						<span style="text-align: left;">
							<h5>Puede crear un anuncio nuevo</h5>
						</span>
						<br />
						<a href="/profile/choose_ad">
							<img class="" src="/images/new_ad.jpg" />
						</a>
						<br /><br />
						<a href="/profile/choose_ad" class="secondaryButton">Crear Anuncio Nuevo</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/page_model.js"></script>
	<?php $this->load->view('includes/footer'); ?>