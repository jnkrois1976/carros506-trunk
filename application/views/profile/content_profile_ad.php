	<?php 
		$this->load->view('includes/header'); 
		/* PAGE ARRAYS */
		$car_trans[0] = $this->lang->line('sw_ad_trans_type0');
		$car_trans[1] = $this->lang->line('sw_ad_trans_type1');
		
		$body_types[0] = $this->lang->line('sw_ad_bodytype0');
		$body_types[1] = $this->lang->line('sw_ad_bodytype1');
		$body_types[2] = $this->lang->line('sw_ad_bodytype2');
		$body_types[3] = $this->lang->line('sw_ad_bodytype3');
		$body_types[4] = $this->lang->line('sw_ad_bodytype4');
		$body_types[5] = $this->lang->line('sw_ad_bodytype5');
		$body_types[6] = $this->lang->line('sw_ad_bodytype6');
		$body_types[7] = $this->lang->line('sw_ad_bodytype7');
		$body_types[8] = $this->lang->line('sw_ad_bodytype8');
		$body_types[9] = $this->lang->line('sw_ad_bodytype9');
		
		$car_cond[0] = $this->lang->line('sw_ad_car_cond0');
		$car_cond[1] = $this->lang->line('sw_ad_car_cond1');
		$car_cond[2] = $this->lang->line('sw_ad_car_cond2');
		$car_cond[3] = $this->lang->line('sw_ad_car_cond3');
		
		$car_motor = array('4', '6', '8', '10', '12');
		
		$car_fuel[0] = $this->lang->line('sw_ad_fuel_type0');
		$car_fuel[1] = $this->lang->line('sw_ad_fuel_type1');
		$car_fuel[2] = $this->lang->line('sw_ad_fuel_type2');
		$car_fuel[3] = $this->lang->line('sw_ad_fuel_type3');
		$car_fuel[4] = $this->lang->line('sw_ad_fuel_type4');
		
		$car_traccion[0] = $this->lang->line('sw_ad_traction_type0');
		$car_traccion[1] = $this->lang->line('sw_ad_traction_type1');
		$car_traccion[2] = $this->lang->line('sw_ad_traction_type2');
		
		$province = array('sanjose' =>'San José', 'alajuela' => 'Alajuela', 'heredia' => 'Heredia', 'cartago' => 'Cartago', 'puntarenas' => 'Puntarenas', 'limon' => 'Limón', 'guanacaste' => 'Guanacaste');

	?>
	<section>
		<div id="toolTip" class="bubble">
			<span id="tooltipMessage"></span>
			<span class="arrow"></span>
		</div>
		<div class="centerContainer">
		<div class="mainContentPages">
		    <?php if($posting): ?>
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
    						<?=$this->lang->line('sw_ad_view_count_a').$posting['ad_visits'].$this->lang->line('sw_ad_view_count_b')?>
    					</h5>
    				</div>
    			</div>
    			<div class="horizontalBlock">
    				<div class="carDesc">
    					<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
    						<tbody>
    							<tr>
    								<td colspan="2">
    									<strong><em><?=$this->lang->line('sw_car_info_header')?></em></strong>
    								</td>
    								<td>
    									<?php if($posting['ad_categoria'] == "A"): ?>
    										<?=$this->lang->line('sw_full_ad_header')?>
    									<?php elseif($posting['ad_categoria'] == "B"): ?>
    										<?=$this->lang->line('sw_detailed_ad_header')?>
    									<?php elseif($posting['ad_categoria'] == "C"): ?>
    										<?=$this->lang->line('sw_basic_ad_header')?>
    									<?php endif; ?>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_code')?></td>
    								<td><?php echo $posting['ad_idprefix'].$posting['ad_id']; ?></td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_make')?></td>
    								<td><?php echo $posting['ad_marca']; ?></td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_model')?></td>
    								<td><?php echo $posting['ad_modelo']; ?></td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_year')?></td>
    								<td><?php echo $posting['ad_year']; ?></td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_transmision')?></td>
    								<td>
    									<span id="carTrans">
    										<?php echo $posting['ad_transmision']; ?>
    									</span>
    									<select name="editCarTrans" id="editCarTrans" data-error="<?=$this->lang->line('error_msg_select_transmision')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_transmision" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_trans as $trans_option){
    												if($posting['ad_transmision'] == $trans_option){
    													echo "<option selected='selected' value='".$trans_option."' >".$trans_option."</option>";
    												}elseif($posting['ad_transmision'] != $trans_option){
    													echo "<option value='".$trans_option."'>".$trans_option."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="carTrans" data-field="editCarTrans"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="carTrans" data-field="editCarTrans"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="carTrans" data-field="editCarTrans"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_mileage')?></td>
    								<td>
    									<input id="editMileage" type="text" value="<?php echo $posting['ad_kilometraje']; ?>" data-defaultvalue="<?php echo number_format($posting['ad_kilometraje'], 0, ',', '.'); ?>" disabled="disabled" data-validationtype="number" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_kilometraje" />
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="false" data-field="editMileage"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="false" data-field="editMileage"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="false" data-field="editMileage"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_price')?></td>
    								<td>
    									<span id="formattedPrice">
    										<?php
    											setlocale(LC_MONETARY, 'it_IT');
    											echo "&#8353;".money_format('%!.0n', $posting['ad_precio']);
    										?>
    									</span>
    									<input id="editPrice" style="display:none;" type="text" value="<?php echo $posting['ad_precio']; ?>" data-defaultvalue="<?php echo $posting['ad_precio']; ?>" disabled="disabled" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_precio" required="true" data-error="<?=$this->lang->line('error_msg_car_price')?>" data-validationtype="number" />
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="formattedPrice" data-field="editPrice"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="formattedPrice" data-field="editPrice"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="formattedPrice" data-field="editPrice"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<?php if($posting['ad_categoria'] == "A"): ?>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_body')?></td>
    								<td>
    									<span id="bodyType">
    										<?php echo $posting['ad_carroceria']; ?>
    									</span>
    									<select name="editBody" id="editBody" data-error="<?=$this->lang->line('error_msg_body_type')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_carroceria" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($body_types as $type_option){
    												if($posting['ad_carroceria'] == $type_option){
    													echo "<option selected='selected' value='".$type_option."' >".$type_option."</option>";
    												}elseif($posting['ad_carroceria'] != $type_option){
    													echo "<option value='".$type_option."'>".$type_option."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="bodyType" data-field="editBody"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="bodyType" data-field="editBody"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="bodyType" data-field="editBody"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_condition')?></td>
    								<td>
    									<span id="carCond">
    										<?php echo $posting['ad_estado']; ?>
    									</span>
    									<select name="editCarCond" id="editCarCond" data-error="<?=$this->lang->line('error_msg_car_cond')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_estado" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_cond as $cond_option){
    												if($posting['ad_estado'] == $cond_option){
    													echo "<option selected='selected' value='".$cond_option."' >".$cond_option."</option>";
    												}elseif($posting['ad_estado'] != $cond_option){
    													echo "<option value='".$cond_option."'>".$cond_option."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="carCond" data-field="editCarCond"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="carCond" data-field="editCarCond"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="carCond" data-field="editCarCond"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_engine_size')?></td>
    								<td>
    									<input id="editCC" type="text" data-error="<?=$this->lang->line('error_msg_engine_size')?>" value="<?php echo $posting['ad_centimetros']; ?>" data-defaultvalue="<?php echo $posting['ad_centimetros']; ?>" required="true" disabled="disabled" data-validationtype="number" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_centimetros" />
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="false" data-field="editCC"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="false" data-field="editCC"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="false" data-field="editCC"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_cilinders')?></td>
    								<td>
    									<span id="carMotor">
    										<?php echo $posting['ad_motor']; ?>
    									</span>
    									<select name="editCarMotor" id="editCarMotor" data-error="<?=$this->lang->line('error_msg_cilinders')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_motor" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_motor as $motor_option){
    												if($posting['ad_motor'] == $motor_option){
    													echo "<option selected='selected' value='".$motor_option."' >".$motor_option."</option>";
    												}elseif($posting['ad_motor'] != $motor_option){
    													echo "<option value='".$motor_option."'>".$motor_option."</option>";
    												}
    												
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_fuel_type')?></td>
    								<td>
    									<span id="carFuel">
    										<?php echo $posting['ad_combustible']; ?>
    									</span>
    									<select name="editCarFuel" id="editCarFuel" data-error="<?=$this->lang->line('error_msg_fuel_type')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_combustible" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_fuel as $fuel_option){
    												if($posting['ad_combustible'] == $fuel_option){
    													echo "<option selected='selected' value='".$fuel_option."' >".$fuel_option."</option>";
    												}elseif($posting['ad_combustible'] != $fuel_option){
    													echo "<option value='".$fuel_option."'>".$fuel_option."</option>";
    												}
    												
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="carFuel" data-field="editCarFuel"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="carFuel" data-field="editCarFuel"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="carFuel" data-field="editCarFuel"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_door_count')?></td>
    								<td>
    									<input id="editPuertas" type="text" data-error="<?=$this->lang->line('error_msg_door_count')?>" value="<?php echo $posting['ad_puertas']; ?>" data-defaultvalue="<?php echo $posting['ad_puertas']; ?>" disabled="disabled" data-validationtype="number" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_puertas" />
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="false" data-field="editPuertas"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="false" data-field="editPuertas"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="false" data-field="editPuertas"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_traction')?></td>
    								<td>
    									<span id="carTraccion">
    										<?php echo $posting['ad_traccion']; ?>
    									</span>
    									<select name="editCarTraccion" id="editCarTraccion" data-error="<?=$this->lang->line('error_msg_traction_type')?>" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_traccion" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_traccion as $traccion_option){
    												if($posting['ad_traccion'] == $traccion_option){
    													echo "<option selected='selected' value='".$traccion_option."' >".$traccion_option."</option>";
    												}elseif($posting['ad_traccion'] != $traccion_option){
    													echo "<option value='".$traccion_option."'>".$traccion_option."</option>";
    												}
    												
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="<?=$this->lang->line('btn_edit')?>" class="edit" data-ishidden="true" data-spandata="carTraccion" data-field="editCarTraccion"><?=$this->lang->line('btn_edit')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_cancel')?>" class="cancel" data-ishidden="true" data-spandata="carTraccion" data-field="editCarTraccion"><?=$this->lang->line('btn_cancel')?></button>
    									<button type="button" value="<?=$this->lang->line('btn_save')?>" class="save" data-ishidden="true" data-spandata="carTraccion" data-field="editCarTraccion"><?=$this->lang->line('btn_save')?></button>
    								</td>
    							</tr>
    							<tr>
    								<td><?=$this->lang->line('sw_ad_location')?></td>
    								<td>
    									<span id="adLocation">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo $key;
    												}
    											}
    										?>
    									</span>
    									<select name="editLocation" id="editLocation" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_location" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo "<option selected='selected' value='".$province_option."' >".$key."</option>";
    												}elseif($posting['ad_location'] != $province_option){
    													echo "<option value='".$province_option."'>".$key."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="Editar" class="edit" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Editar</button>
    									<button type="button" value="Cancelar" class="cancel" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Cancelar</button>
    									<button type="button" value="Guardar" class="save" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Guardar</button>
    								</td>
    							</tr>
    							<tr>
    								<td>Detalles adicionales:</td>
    								<td colspan="2">&nbsp;</td>
    							</tr>
    							<tr>
    								<td colspan="2">
    									<textarea 
    										cols="47" 
    										id="editDetails" 
    										class="editDetails" 
    										disabled="disabled" 
    										data-id="<?php echo $posting['ad_fullid']; ?>" 
    										data-dbfield="ad_detalles"><?php echo $posting['ad_detalles']; ?></textarea>
    								</td>
    								<td>
    									<button type="button" value="Editar" class="edit" data-ishidden="false" data-field="editDetails">Editar</button>
    									<button type="button" value="Cancelar" class="cancel" data-ishidden="false" data-field="editDetails">Cancelar</button>
    									<button type="button" value="Guardar" class="save" data-ishidden="false" data-field="editDetails">Guardar</button>
    								</td>
    							</tr>
    							<tr>
    								<td>
    									Publicado el: 
    								</td>
    								<td>
    									<?php
    										$break_date_pos = explode('-', $posting['ad_postedOn']);
    										setlocale(LC_TIME, "es_ES"); 
    										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
    									?>
    								</td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td>
    									Expira el: 
    								</td>
    								<td>
    									<strong id="orig_exp_date">
    										<?php
    											$break_date_exp = explode('-', $posting['ad_expires']);
    											setlocale(LC_TIME, "es_ES");
    											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
    										?>
    									</strong>
    								</td>
    								<td>
    									<?php
    										$break_future_date = date('d/m/Y', strtotime('+30 days'));
    										$break_date_renew = explode('/', $break_future_date);
    										setlocale(LC_TIME, "es_ES");
    									?>
    									<button type="button" value="extend" data-adfullid="<?php echo $posting['ad_fullid']; ?>" data-newdate="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-formatdate="<?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_renew[1], $break_date_renew[0], $break_date_renew[2])); ?>" class="calendar">Extender 30 d&iacute;as</button>
    								</td>
    							</tr>
    							<?php elseif($posting['ad_categoria'] == "B"): ?>
    							<tr>
    								<td>Cilindros:</td>
    								<td>
    									<span id="carMotor">
    										<?php echo $posting['ad_motor']; ?>
    									</span>
    									<select name="editCarMotor" id="editCarMotor" data-error="Por favor seleccione los cilindros del carro" required="true" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_motor" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($car_motor as $motor_option){
    												if($posting['ad_motor'] == $motor_option){
    													echo "<option selected='selected' value='".$motor_option."' >".$motor_option."</option>";
    												}elseif($posting['ad_motor'] != $motor_option){
    													echo "<option value='".$motor_option."'>".$motor_option."</option>";
    												}
    												
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="Editar" class="edit" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor">Editar</button>
    									<button type="button" value="Cancelar" class="cancel" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor">Cancelar</button>
    									<button type="button" value="Guardar" class="save" data-ishidden="true" data-spandata="carMotor" data-field="editCarMotor">Guardar</button>
    								</td>
    							</tr>
    							<tr>
    								<td>Ubicaci&oacute;n:</td>
    								<td>
    									<span id="adLocation">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo $key;
    												}
    											}
    										?>
    									</span>
    									<select name="editLocation" id="editLocation" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_location" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo "<option selected='selected' value='".$province_option."' >".$key."</option>";
    												}elseif($posting['ad_location'] != $province_option){
    													echo "<option value='".$province_option."'>".$key."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="Editar" class="edit" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Editar</button>
    									<button type="button" value="Cancelar" class="cancel" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Cancelar</button>
    									<button type="button" value="Guardar" class="save" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Guardar</button>
    								</td>
    							</tr>
    							<tr>
    								<td>
    									Publicado el: 
    								</td>
    								<td>
    									<?php
    										$break_date_pos = explode('-', $posting['ad_postedOn']);
    										setlocale(LC_TIME, "es_ES"); 
    										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
    									?>
    								</td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td>
    									Expira el: 
    								</td>
    								<td>
    									<strong id="orig_exp_date">
    										<?php
    											$break_date_exp = explode('-', $posting['ad_expires']);
    											setlocale(LC_TIME, "es_ES");
    											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
    										?>
    									</strong>
    								</td>
    								<td>
    									<?php
    										$break_future_date = date('d/m/Y', strtotime('+30 days'));
    										$break_date_renew = explode('/', $break_future_date);
    										setlocale(LC_TIME, "es_ES");
    									?>
    									<button type="button" value="extend" data-adfullid="<?php echo $posting['ad_fullid']; ?>" data-newdate="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-formatdate="<?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_renew[1], $break_date_renew[0], $break_date_renew[2])); ?>" class="calendar">Extender 30 d&iacute;as</button>
    								</td>
    							</tr>
    							<?php elseif($posting['ad_categoria'] == "C"): ?>
    							<tr>
    								<td>Ubicaci&oacute;n:</td>
    								<td>
    									<span id="adLocation">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo $key;
    												}
    											}
    										?>
    									</span>
    									<select name="editLocation" id="editLocation" data-adid="<?php echo $posting['ad_fullid']; ?>" data-dbfield="ad_location" style="display:none;" disabled="disabled">
    										<?php 
    											foreach($province as $province_option => $key){
    												if($posting['ad_location'] == $province_option){
    													echo "<option selected='selected' value='".$province_option."' >".$key."</option>";
    												}elseif($posting['ad_location'] != $province_option){
    													echo "<option value='".$province_option."'>".$key."</option>";
    												}
    											}
    										?>
    									</select>
    								</td>
    								<td>
    									<button type="button" value="Editar" class="edit" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Editar</button>
    									<button type="button" value="Cancelar" class="cancel" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Cancelar</button>
    									<button type="button" value="Guardar" class="save" data-ishidden="true" data-spandata="adLocation" data-field="editLocation">Guardar</button>
    								</td>
    							</tr>
    							<tr>
    								<td>
    									Publicado el: 
    								</td>
    								<td>
    									<?php
    										$break_date_pos = explode('-', $posting['ad_postedOn']);
    										setlocale(LC_TIME, "es_ES"); 
    										echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_pos[1], $break_date_pos[2], $break_date_pos[0]));
    									?>
    								</td>
    								<td>&nbsp;</td>
    							</tr>
    							<tr>
    								<td>
    									Expira el: 
    								</td>
    								<td>
    									<strong id="orig_exp_date">
    										<?php
    											$break_date_exp = explode('-', $posting['ad_expires']);
    											setlocale(LC_TIME, "es_ES");
    											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
    										?>
    									</strong>
    								</td>
    								<td>
    									<?php
    										$break_future_date = date('d/m/Y', strtotime('+30 days'));
    										$break_date_renew = explode('/', $break_future_date);
    										setlocale(LC_TIME, "es_ES");
    									?>
    									<button type="button" value="extend" data-adfullid="<?php echo $posting['ad_fullid']; ?>" data-newdate="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-formatdate="<?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_renew[1], $break_date_renew[0], $break_date_renew[2])); ?>" class="calendar">Extender 30 d&iacute;as</button>
    								</td>
    							</tr>
    							<?php endif; ?>
    						</tbody>
    					</table>
    				</div>
    				<div class="carPics">
    					<?php if($posting['ad_categoria'] == "A" || $posting['ad_categoria'] == "B" || $posting['ad_categoria'] == "C"): ?>
    						<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
    							<tr>
    								<td>Fotos: (click para borrar)</td>
    							</tr>
    							<tr>
    								<td id="thumbContainer" data-imgcount="<?php echo $posting['ad_pictures']; ?>">
    									<?php
    										$img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
    										$folder_path = 'cars/small_thumb/'.$img_folder.'/';
    										$images = get_filenames($folder_path);
    										if($images){
    											foreach ($images as $single_image) {
    												$img_name = explode(".", $single_image);
    												echo "<div id='".$img_name[0]."'>";
    												echo "	<span>
    														<br />Borrar foto?<br /><br />
    														<a href='#' name='".$single_image."' data-parent='".$img_name[0]."' data-folder='".$img_folder."' class='fixedYesBgLink'>Si</a>
    														&nbsp;
    														<a href='#' class='fixedNoBgLink'>No</a></span>";
    												echo '<img class="toErase" src="/cars/small_thumb/'.$img_folder.'/'.$single_image.'"/>';
    												echo "</div>";
    											}
    										}else {
    											echo "Este carro no tiene fotos!";
    										}
    									?>
    								</td>
    							</tr>
    						</table>
    					<?php endif; ?>
    					<?php if($posting['ad_categoria'] == "A" && $posting['ad_pictures'] < 20): ?>
    						<br />
    						<?php
    							$images_number = array();;
    							if($images){
    								foreach ($images as $single_image) {
    									$split_at_underscore = explode("_", $single_image);
    									$split_at_dot = explode(".", $split_at_underscore[1]);
    									array_push($images_number, $split_at_dot[0]);
    								}
    								sort($images_number, SORT_NUMERIC);
    							}
    							
    						?>
    						<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
    							<tr>
    								<td>
    									Puede agregar hasta <?php echo 20 - $posting['ad_pictures']; ?> fotos m&aacute;s.
    								</td>
    							</tr>
    							<tr>
    								<td>
    									<form action="/new_listing/single_upload" method="post" enctype="multipart/form-data" novalidate="novalidate">
    										<input type="hidden" name="image_name" value="pr<?php echo $posting['ad_id'].'_'.(end($images_number) + 1).'.jpg'; ?>" />
    										<input type="hidden" name="adUrl" value="/profile/ad_details/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="ad_fullid" value="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="newImgCount" value="<?php echo ($posting['ad_pictures'] + 1); ?>" />
    										<input id="singleImgUpload" type="file" name="userfile" value="" required="true" data-error="Por favor seleccione una imagen" autocomplete="off" data-validationtype="file" />
    										<input type="submit" name="add_pic" id="add_pic" value="Agregar" />
    									</form><br /><br />
    									<span style="font-size:70%; padding-top:10px; line-height: normal; display: block"">
    										El tama&ntilde;o de la foto no puede exceder 1000KB.<br />
    										Puede agregar fotos en formato .gif, .jpg, .jpeg o .png
    									</span>
    								</td>
    							</tr>
    						</table>
    					<?php elseif($posting['ad_categoria'] == "B" && $posting['ad_pictures'] < 10): ?>
    						<br />
    						<?php
    							$images_number = array();;
    							if($images){
    								foreach ($images as $single_image) {
    									$split_at_underscore = explode("_", $single_image);
    									$split_at_dot = explode(".", $split_at_underscore[1]);
    									array_push($images_number, $split_at_dot[0]);
    								}
    								sort($images_number, SORT_NUMERIC);
    							}
    							
    						?>
    						<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
    							<tr>
    								<td>
    									Puede agregar hasta <?php echo 10 - $posting['ad_pictures']; ?> fotos m&aacute;s.
    								</td>
    							</tr>
    							<tr>
    								<td>
    									<form action="/new_listing/single_upload" method="post" enctype="multipart/form-data" novalidate="novalidate">
    										<input type="hidden" name="image_name" value="pr<?php echo $posting['ad_id'].'_'.(end($images_number) + 1).'.jpg'; ?>" />
    										<input type="hidden" name="adUrl" value="/profile/ad_details/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="ad_fullid" value="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="newImgCount" value="<?php echo ($posting['ad_pictures'] + 1); ?>" />
    										<input id="singleImgUpload" type="file" name="userfile" value="" required="true" data-error="Por favor seleccione una imagen" autocomplete="off" data-validationtype="file" />
    										<input type="submit" name="add_pic" id="add_pic" value="Agregar" />
    									</form><br /><br />
    									<span style="font-size:70%; padding-top:10px; line-height: normal; display: block">
    										El tama&ntilde;o de la foto no puede exceder 1000KB.<br />
    										Puede agregar fotos en formato .gif, .jpg, .jpeg o .png
    									</span>
    								</td>
    							</tr>
    						</table>
    					<?php elseif($posting['ad_categoria'] == "C" && $posting['ad_pictures'] < 5): ?>
    						<br />
    						<?php
    							$images_number = array();;
    							if($images){
    								foreach ($images as $single_image) {
    									$split_at_underscore = explode("_", $single_image);
    									$split_at_dot = explode(".", $split_at_underscore[1]);
    									array_push($images_number, $split_at_dot[0]);
    								}
    								sort($images_number, SORT_NUMERIC);
    							}
    							
    						?>
    						<table cellpadding="0" cellspacing="0" border="0" class="carDetails">
    							<tr>
    								<td>
    									Puede agregar hasta <?php echo 5 - $posting['ad_pictures']; ?> fotos m&aacute;s.
    								</td>
    							</tr>
    							<tr>
    								<td>
    									<form action="/new_listing/single_upload" method="post" enctype="multipart/form-data" novalidate="novalidate">
    										<input type="hidden" name="image_name" value="pr<?php echo $posting['ad_id'].'_'.(end($images_number) + 1).'.jpg'; ?>" />
    										<input type="hidden" name="adUrl" value="/profile/ad_details/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="ad_fullid" value="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" />
    										<input type="hidden" name="newImgCount" value="<?php echo ($posting['ad_pictures'] + 1); ?>" />
    										<input id="singleImgUpload" type="file" name="userfile" value="" required="true" data-error="Por favor seleccione una imagen" autocomplete="off" data-validationtype="file" />
    										<input type="submit" name="add_pic" id="add_pic" value="Agregar" />
    									</form><br /><br />
    									<span style="font-size:70%; padding-top:10px; line-height: normal; display: block">
    										El tama&ntilde;o de la foto no puede exceder 1000KB.<br />
    										Puede agregar fotos en formato .gif, .jpg, .jpeg o .png
    									</span>
    								</td>
    							</tr>
    						</table>	
    					<?php endif; ?>
    					<?php if($posting['ad_categoria'] == "A"): ?>
    						<a class="secondaryButton" href="/resultados/anuncio/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" style="margin-top: 20px;">Ver al anuncio</a>
    					<?php elseif($posting['ad_categoria'] == "B"): ?>
    						<a class="secondaryButton" href="/resultados/anuncio_medio/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" style="margin-top: 20px;">Ver al anuncio</a>
    					<?php elseif($posting['ad_categoria'] == "C"): ?>
    						<a class="secondaryButton" href="/resultados/anuncio_basico/<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" style="margin-top: 20px;">Ver al anuncio</a>
    					<?php endif; ?>
    					<?php if($posting['ad_status'] == 0): ?>
    						<a 
    							id="markAsSold"
    							class="secondaryButtonAttention tooltip" 
    							href="#" 
    							data-title="Al marcar su carro como 'vendido', se mostrar&aacute; un mensaje en su anuncio indicando que el carro ya se vendi&oacute;. Pero continuar&aacute; apareciendo en los resultados de b&uacute;squedas hasta que el anuncio expire."
    							data-adid="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" 
    							>
    							Marcar como vendido
    						</a>
    						<a id="forSale" 
    							class="secondaryButtonAttention tooltip"  
    							style="display:none;" 
    							href="#" 
    							data-title="Si su carro no se ha vendido todavia, puede cambiar el estatus del carro de 'vendido' a 'para la venta'. De esta manera su anuncio aparecer&aacute; en los resultados normalmente hasta que el anuncio expire." 
    							data-adid="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" 
    							>
    							Poner a la venta
    						</a>
    					<?php elseif($posting['ad_status'] == 1): ?>
    						<a 
    							id="markAsSold"
    							class="secondaryButtonAttention tooltip" 
    							style="display:none;" 
    							href="#" 
    							data-title="Al marcar su carro como 'vendido', se mostrar&aacute; un mensaje en su anuncio indicando que el carro ya se vendi&oacute;. Pero continuar&aacute; apareciendo en los resultados de b&uacute;squedas hasta que el anuncio expire."
    							data-adid="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" 
    							>
    							Marcar como vendido
    						</a>
    						<a 
    							id="forSale" 
    							class="secondaryButtonAttention tooltip"  
    							href="#" 
    							data-title="Si su carro no se ha vendido todavia, puede cambiar el estatus del carro de 'vendido' a 'para la venta'. De esta manera su anuncio aparecer&aacute; en los resultados normalmente hasta que el anuncio expire." 
    							data-adid="<?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>" 
    							>
    							Poner a la venta
    						</a>
    					<?php endif; ?>
    				</div>
    			</div>
			<?php elseif(!$posting): ?>
                <div class="serverError">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td width="90%" valign="center" align="center">
                                <h5>Este anuncio no existe o ya expir&oacute;!</h5>
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