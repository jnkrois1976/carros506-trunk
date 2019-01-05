	<?php 
		$this->load->view('includes/header'); 
		/**** PAGE ARRAYS ****/
		$table_headers_display = array('Marca', 
								'Modelo', 
								'Año', 
								'Estado Legal', 
								'Precio', 
								'Condición', 
								'Color', 
								'Centímetros', 
								'Cilindros', 
								'Combustible', 
								'Transmisión', 
								'Kilometraje', 
								'Puertas',
								'Estado de uso',
								'Tracción',
								'Carrocería',
								'Detalles'
						);
		
		$postedDay = date("d");
		$postedMonth = date("m");
		$postedYear = date("Y");
		$notformattedposted = $postedYear."-".$postedMonth."-".$postedDay;
						
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
		
		$province = array('sanjose' =>'San José', 'alajuela' => 'Alajuela', 'heredia' => 'Heredia', 'cartago' => 'Cartago', 'puntarenas' => 'Puntarenas', 'limon' => 'Limón', 'guanacaste' => 'Guanacaste');
		foreach($province as $province_option => $key){
			if($contact_query['contact_provincia'] == $key){
				$province_formatted = $province_option;
			}
		}
		$car_makes = array("Acura", "Alfa Romeo", "AMC", "Aro", "Asia", "Aston Martin", "Audi", "Austin", "Avanti", "Bentley", "Bluebird", "BMW", "Buick", "BYD", "Cadillac", "Chery", "Chevrolet", "Chrysler",
							"Citroen", "Dacia", "Daewoo", "Daihatsu", "Datsun", "DFM", "Dodge/RAM", "Eagle", "Ferrari", "Fiat", "Ford", "Freightliner", "Geely", "Geo", "GMC", "Gonow", "Great Wall", "Hafei", 
							"Hino", "Honda", "Hummer", "Hyundai", "Infiniti", "International", "Isuzu", "Iveco", "JAC", "Jaguar", "Janbei", "Jeep", "JMC", "Kia", "Lada", "Lamborghini", "Lancia", "Land Rover", 
							"Lexus", "Lifan", "Lincoln", "Lotus", "Mack", "Magiruz", 'Mahindra', "Maserati", "Mazda", "Mercedes Benz", "Mercury", "MG", "Mini", "Mitsubishi", "Nissan", "Oldsmobile", "Opel", 
							"Peugeot", "Plymouth", "Pontiac", "Porsche", "Proton", "Rambler", "Renault", "Rolls Royce", "Rover", "Saab", "Samsung", "Saturn", "Scania", "Scion", "Seat", "Skoda", "Smart", 
							"Ssang Yong", "Subaru", "Suzuki", "Tianma", "Tiger Truck", "Toyota", "Volkswagen", "Volvo", "Yugo");
	?>
	<?php 
		/*include 'ChromePhp.php';
		ChromePhp::log($table_headers);*/
	?>
	<section>
		<script>
			var fallback = false;
		</script>
		<ul class="makeSuggest" style="display: none;" data-listingindex="">
            <?php foreach($car_makes as $allmakes_row): ?>
            	<li><?php echo $allmakes_row; ?></li>
        	<?php endforeach; ?>
        </ul>
        <ul class="modelSuggest" style="display: none;"></ul>
		<div class="centerContainer">
			<div class="mainContentPages">
				<h2>Anuncio multiple</h2>
				<p>
					Simplemente llene los campos con la informaci&oacute;n de los carros.<br /><br />
					M&aacute;ximo 10 carros para no complicar mucho las cosas. <small>(Todos los campos son requeridos).</small><br /><br />
					Podr&aacute; agregar fotos y detalles adicionales a cada anuncio individualmente, una vez que hayan sido publicados.
				</p>
				<div class="tableContainer">
					<table cellpadding="0" cellspacing="0" border="1" id="dealerMultipleListing">
						<thead>
							<tr class="rawHeaders">
								<?php foreach ($table_headers as $key): ?>
									<?php if(	$key == "ad_id" || 
												$key == "ad_idprefix" || 
												$key == "ad_fullid" ||
												$key == "ad_sellerId" ||
												$key == "ad_sellerName" ||
												$key == "ad_sellerEmail" ||
												$key == "ad_sellerPhone" ||
												$key == "ad_sellerCategory" ||
												$key == "ad_categoria" || 
												$key == "ad_location" ||
												$key == "ad_visits" ||
												$key == "ad_comments" ||
												$key == "ad_publicComments" ||
												$key == "ad_messages" ||
												$key == "ad_pictures" ||
												$key == "ad_expires" ||
												$key == "ad_status" ||
												$key == "ad_postedOn" ||
												$key == "ad_rating" || 
												$key == "ad_voters" ||
												$key == "ad_reports" ||
												$key == "admin_verified" ||
												$key == "ad_detalles"
									): ?>
										<th data-rawheader="ad_id" class="hidden"><?php echo $key; ?></th>
									<?php elseif($key == "ad_marca"): ?>
										<th data-rawheader="ad_marca"><?php echo $table_headers_display[0]; ?></th>
									<?php elseif($key == "ad_modelo"): ?>
										<th data-rawheader="ad_modelo"><?php echo $table_headers_display[1]; ?></th>
									<?php elseif($key == "ad_year"): ?>
										<th data-rawheader="ad_year"><?php echo $table_headers_display[2]; ?></th>
									<?php elseif($key == "ad_legalstatus"): ?>
										<th data-rawheader="ad_legalstatus"><?php echo $table_headers_display[3]; ?></th>
									<?php elseif($key == "ad_precio"): ?>
										<th data-rawheader="ad_precio"><?php echo $table_headers_display[4]; ?></th>
									<?php elseif($key == "ad_estado"): ?>
										<th data-rawheader="ad_estado"><?php echo $table_headers_display[5]; ?></th>
									<?php elseif($key == "ad_color"): ?>
										<th data-rawheader="ad_color"><?php echo $table_headers_display[6]; ?></th>
									<?php elseif($key == "ad_centimetros"): ?>
										<th data-rawheader="ad_centimetros"><?php echo $table_headers_display[7]; ?></th>
									<?php elseif($key == "ad_motor"): ?>
										<th data-rawheader="ad_motor"><?php echo $table_headers_display[8]; ?></th>
									<?php elseif($key == "ad_combustible"): ?>
										<th data-rawheader="ad_combustible"><?php echo $table_headers_display[9]; ?></th>
									<?php elseif($key == "ad_transmision"): ?>
										<th data-rawheader="ad_transmision"><?php echo $table_headers_display[10]; ?></th>
									<?php elseif($key == "ad_kilometraje"): ?>
										<th data-rawheader="ad_kilometraje"><?php echo $table_headers_display[11]; ?></th>
									<?php elseif($key == "ad_puertas"): ?>
										<th data-rawheader="ad_puertas"><?php echo $table_headers_display[12]; ?></th>
									<?php elseif($key == "ad_nuevo"): ?>
										<th data-rawheader="ad_nuevo"><?php echo $table_headers_display[13]; ?></th>
									<?php elseif($key == "ad_traccion"): ?>
										<th data-rawheader="ad_traccion"><?php echo $table_headers_display[14]; ?></th>
									<?php elseif($key == "ad_carroceria"): ?>
										<th data-rawheader="ad_carroceria"><?php echo $table_headers_display[15]; ?></th>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php for($i = 0; $i < 10; $i++): ?>
							<tr data-listingindex="<?php echo $i; ?>" data-rowcomplete='false'>
								<form action="" method="" class="listingRowValues" id="listingIndex<?php echo $i; ?>">
									<td class="hidden"><input type="hidden" value="" name="ad_id"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $contact_query['contact_categoria']; ?>" name="ad_idprefix" /></td>
								    <td class="hidden"><input type="hidden" value="" name="ad_fullid"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $contact_query['contact_fullid']; ?>" name="ad_sellerId"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $contact_query['dealer_name']; ?>" name="ad_sellerName"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $contact_query['contact_email']; ?>" name="ad_sellerEmail"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $contact_query['contact_phone']; ?>" name="ad_sellerPhone"/></td>
								    <td class="hidden"><input type="hidden" value="Agencia" name="ad_sellerCategory"/></td>
								    <td class="hidden"><input type="hidden" value="A" name="ad_categoria"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $province_formatted; ?>" name="ad_location"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_visits"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_comments"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_publicComments"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_messages"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_pictures"/></td>
								    <td class="hidden"><input type="hidden" value="<?php echo $notformatted; ?>" name="ad_expires"/></td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		name="ad_marca" 
								    		placeholder="Marca del carro..." 
								    		required="true"  
								    		autocomplete="off"
											onclick="this.select();"	
											data-error="Por favor seleccione la marca de este carro" 
											data-validationtype="text"/>
							        </td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		required="true" 
								    		name="ad_modelo" 
								    		placeholder="Modelo del carro..."
								    		autocomplete="off"
											onclick="this.select();"
											data-error="Por favor seleccione el modelo de este carro"
											data-validationtype="text"/>
							        </td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		name="ad_year"
								    		required="true" 
								    		placeholder="A&ntilde;o..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor seleccione el a&ntilde;o de fabricaci&oacute;n"
											data-validationtype="number"/>
							    	</td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_status"/></td>
								    <td>
								    	<select name="ad_legalstatus" required="true" data-error="Por favor seleccione el estado legal del carro">
								            <option value="">Seleccione una opción</option>
								            <option value="1">Registrado</option>
								            <option value="0">En Aduana</option>
								        </select>
							        </td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		name="ad_precio"
								    		placeholder="Precio..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor indique el precio del carro"
											required="true"
											data-validationtype="number"/>
							    	</td>
								    <td>
								    	<select name="ad_estado" required="true" data-error="Por favor seleccione el estado del carro">
								            <option value="">Seleccione una opción</option>
								            <option value="Excelente">Excelente</option>
								            <option value="Buena">Buena</option>
								            <option value="Regular">Regular</option>
								            <option value="Para repuestos">Para repuestos</option>
								        </select>
							        </td>
								    <td>
								    	<input 
								    		type="text" 
								    		value=""
								    		name="ad_color"
								    		placeholder="Color..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor indique el color del carro"
											required="true"
											data-validationtype="text"/>
							    	</td>
								    <td>
								    	<input 
								    		type="text" 
								    		value=""
								    		name="ad_centimetros"
								    		placeholder="CC..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor los cent&iacute;metros c&uacute;bicos"
											required="true"
											data-validationtype="number"
								    		/>
							    	</td>
								    <td>
								    	<select name="ad_motor" required="true" data-error="Por favor seleccione los cilindros del carro">
								            <option value="">Seleccione una opción</option>
								            <option value="4 Cilindros">4 Cilindros</option>
								            <option value="6 Cilindros">6 Cilindros</option>
								            <option value="8 Cilindros">8 Cilindros</option>
								            <option value="10 Cilindros">10 Cilindros</option>
								            <option value="12 Cilindros">12 Cilindros</option>
								        </select>
							        </td>
								    <td>
								    	<select name="ad_combustible" required="true" data-error="Por favor seleccione el tipo del combustible">
								            <option value="">Seleccione una opción</option>
								            <option value="Gasolina">Gasolina</option>
								            <option value="Diesel">Diesel</option>
								            <option value="Electrico">Electrico</option>
								            <option value="Hibrido">Hibrido</option>
								            <option value="Gas">Gas</option>
								        </select>
							        </td>
								    <td>
								    	<select name="ad_transmision" required="true" data-error="Por favor seleccione el tipo de transmision">
								            <option value="">Seleccione una opción</option>
								            <option value="Manual">Manual</option>
								            <option value="Automatica">Automatica</option>
								        </select>
							        </td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		name="ad_kilometraje"
								    		placeholder="Kilometraje..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor digite el kilometraje del carro"
											required="true"
											data-validationtype="number" />
							    	</td>
								    <td>
								    	<input 
								    		type="text" 
								    		value="" 
								    		name="ad_puertas"
											placeholder="Cuantas puertas..."
											autocomplete="off"
											onclick="this.select();"
											data-error="Por favor indique cuantas puertas tiene el carro"
											required="true"
											data-validationtype="number"/>
							    	</td>
								    <td class="hidden">
								    	<input type="hidden" value="<?php echo $notformattedposted; ?>" name="ad_postedOn"/>
							    	</td>
								    <td>
								    	<select name="ad_nuevo" required="true" data-error="Por favor seleccione el estado de uso">
								            <option value="">Seleccione una opción</option>
								            <option value="1">Nuevo</option>
								            <option value="0">Usado</option>
								        </select>
							    	</td>
								    <td>
								    	<select name="ad_traccion" required="true" data-error="Por favor seleccione el tipo de traccion del carro">
								            <option value="">Seleccione una opción</option>
								            <option value="Delantera">Delantera</option>
								            <option value="Trasera">Trasera</option>
								            <option value="4 Ruedas">4 Ruedas</option>
								            <option value="4 Ruedas/Todo terreno">4 Ruedas/Todo terreno</option>
								        </select>
							        </td>
								    <td>
								    	<select name="ad_carroceria" required="true" data-error="Por favor seleccione el tipo de carroceria">
								            <option value="">Seleccione una opción</option>
								            <option value="Sedan">Sedan</option>
								            <option value="Station Wagon">Station Wagon</option>
								            <option value="Sport Utility Vehicle (SUV)">Sport Utility Vehicle (SUV)</option>
								            <option value="Hatchback">Hatchback</option>
								            <option value="Minivan">Minivan</option>
								            <option value="Coupe">Coupe</option>
								            <option value="Convertible">Convertible</option>
								            <option value="Deportivo">Deportivo</option>
								            <option value="Pickup">Pickup</option>
								            <option value="Van">Van</option>
								        </select>
							        </td>
								    <td class="hidden"><input type="hidden" value="" name="ad_detalles"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_rating"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_voters"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="ad_reports"/></td>
								    <td class="hidden"><input type="hidden" value="0" name="admin_verified"/></td>
							    </form>
							</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
				<div class="actions">
					<input type="submit" class="create secondaryButton" value="Publicar anuncios" disabled="disabled"/>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/page_model.js"></script>
	<script>
		PageModel.AdTableModel = <?php echo json_encode($table_headers); ?>;
		PageModel.ContactTableModel = <?php echo json_encode($contact_query); ?>;
		PageModel.AllMakesModel = 	<?php 
										$makes = array();
										foreach($car_makes as $allmakes_row){
                                			array_push($makes, $allmakes_row);
										}
										echo json_encode($makes);
									?>;
		PageModel.AllModelsModel = [];
		PageModel.MultipleListingValues = {};
		
	</script>
	<script type="text/javascript" src="/js/new_listing.js"></script>
	
	<?php $this->load->view('includes/footer'); ?>