	<?php $this->load->view('includes/header'); ?>
	<section>
		<div id="toolTip" class="bubble">
			<span id="tooltipMessage"></span>
			<span class="arrow"></span>
		</div>
		<div class="centerContainer">
		<div class="mainContentPages">
			<div>
			<h2>Anuncios reportados: <?php echo $get_total_reported; ?></h2>
			</div>
			<div id="messagesCountPanel">
				<span id="commentsNew">
					<img src="/images/exclamation_red_large.png" /> 
					<span class="xlarge attention" id="newReportCount" data-count="<?php echo $count_new_reports; ?>"><?php echo $count_new_reports; ?></span>
					<span class="countText">Reportes<br />nuevos</span>
				</span>
				<span id="commentsPrivate">
					<img src="/images/user.png" /> 
					<span class="xlarge attention" id="userReviewedCount" data-count="<?php echo $count_new_reports; ?>"><?php echo $count_new_reports; ?></span>
					<span class="countText">Sin revisar<br />por usted</span>
				</span>
				<span id="commentsNoAnswer">
					<img src="/images/tools.png" /> 
					<span class="xlarge attention" id="reportAdminCount"><?php echo $count_admin_verified; ?></span>
					<span class="countText">Sin revisar por<br />el administrador</span>
				</span>
				<span id="messagesNew">
			</div>
			<script>
		        $(window).load(function(){
					$("#messagesCountPanel").sticky({ topSpacing: 50, className: 'floating' });
				});
		    </script>
			<?php if($reported_ads_query): ?>
				<div class="infoMessage">
			    	Por favor revise cada uno de los anuncios y las razones por las cuales fue reportado.<br /><br />
			    	En la mayor&iacute;a de los casos se puede solucionar el problema simplemente editando los detalles del anuncio.<br /><br />
			    	Caso contrario, el administrador le contactar&aacute; directamente para solucionar el problema.
			    </div>
				<?php foreach($reported_ads_query as $ads_query_row): ?>
					<?php 
						$img_folder = strtolower($ads_query_row->ad_idprefix).$ads_query_row->ad_id;
						$folder_path = 'cars/small_thumb/'.$img_folder.'/';
						$images = get_filenames($folder_path);
					?>
					<?php setlocale(LC_MONETARY, 'it_IT'); ?>
					<div class="carThumb <?php echo $condition = ($ads_query_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>" data-postId="<?php echo $ads_query_row->ad_fullid; ?>">
						<table cellpadding="0" cellspacing="0" border="0" width="100%" class="visible">
							<colgroup>
								<col width="22%" />
								<col width="30%" />
								<col width="28%" />
								<col width="20%" />
							</colgroup>
							<tbody>
								<tr>
									<td rowspan="7" valign="top">
										<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb" />
									</td>
									<td>
										Marca:
									</td>
									<td>
										<?php echo $ads_query_row->ad_marca; ?>
									</td>
									<td rowspan="7" valign="bottom">
										<a class="secondaryButton" href="/profile/ad_details/<?php echo $ads_query_row->ad_idprefix.$ads_query_row->ad_id; ?>">Ver/editar Detalles</a>
									</td>
								</tr>
								<tr>
									<td>
										Modelo:
									</td>
									<td>
										<?php echo $ads_query_row->ad_modelo; ?>
									</td>
								</tr>
								<tr>
									<td>
										Precio:
									</td>
									<td>
										 &#8353; <?php echo money_format('%!.0n', $ads_query_row->ad_precio); ?>
									</td>
								</tr>
								<tr>
									<td>
										C&oacute;digo:
									</td>
									<td>
										<?php echo $ads_query_row->ad_fullid; ?>
									</td>
								</tr>
								<tr>
									<td>Fecha de publicaci&oacute;n:</td>
									<td>
									 	<?php 
											$break_date_added = explode('-', $ads_query_row->ad_postedOn);
											setlocale(LC_TIME, "es_ES"); 
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_added[1], $break_date_added[2], $break_date_added[0]));
										?>
									</td>
								</tr>
								<tr>
									<td>Expira el: </td>
									<td class="attention">
										<?php 
											$break_date_exp = explode('-', $ads_query_row->ad_expires);
											echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_exp[1], $break_date_exp[2], $break_date_exp[0]));
										?>
									</td>
								</tr>
								<tr>
									<td>Reportes: </td>
									<td class="attention">
										<?php echo $ads_query_row->ad_reports; ?> 
									</td>
								</tr>
							</tbody>
							<?php $count = 1; ?>
							<?php foreach($get_all_reports as $report_row): ?>
								<?php if($ads_query_row->ad_fullid == $report_row->ad_fullid): ?>
									<tbody class="reportDetails">
										<tr>
											<td valign="middle">
												<h5 class="attention">Reporte #<?php echo $count++; ?></h5>
											</td>
											<td valign="middle">
												<?php if($report_row->report_verified == "0"):  ?>
												<a href="#" 
													class="expandReport plainBrightLink" 
													data-reportid="reportId_<?php echo $report_row->id; ?>" 
													data-adrowid="<?php echo $report_row->id; ?>" 
													data-adid="<?php echo $report_row->ad_fullid; ?>" 
													data-sellerid="<?php echo $report_row->seller_fullid; ?>"
													data-reporticon="reportId_<?php echo $report_row->id; ?>">
													Ver reporte &#9660;
												</a>
												<?php elseif($report_row->report_verified == "1"): ?>
													<a href="#" data-reportid="reportId_<?php echo $report_row->id; ?>" class="expandReport plainBrightLink">
														Ver reporte &#9660;
													</a>
												<?php endif; ?>
											</td>
											<td colspan="2" align="right" valign="middle">
												<?php if($report_row->admin_verified == "0"):  ?>
													<img src="/images/tools_small.png" class="tooltip" data-title="No ha sido revisado por el administrador."/>
												<?php elseif($report_row->admin_verified == "1"): ?>
													<img src="/images/checkmark_green_small.png" class="tooltip" data-title="Ya fue revisado por el administrador."/>
												<?php endif; ?>
												<?php if($report_row->report_verified == "0"):  ?>
													<img src="/images/user_small.png" data-reporticon="reportId_<?php echo $report_row->id; ?>" class="tooltip" data-title="Usted no ha revisado este reporte!"/>
												<?php endif; ?>
												<?php if($report_row->report_verified == "0"):  ?>
													<img src="/images/exclamation_red.png" data-reporticon="reportId_<?php echo $report_row->id; ?>" class="tooltip" data-title="Este reporte es nuevo!" />
												<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<div class="reportDetails" id="reportId_<?php echo $report_row->id; ?>">
													<?php 
														$break_date_rep = explode('-', $report_row->report_date);
													?>
													Este anuncio fue reportado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_rep[1], $break_date_rep[2], $break_date_rep[0])); ?><br /><br />
													Detalles del reporte:<br /><br />
													<em><?php echo $report_row->report_message; ?></em>
												</div>
											</td>
										</tr>
									</tbody>
								<?php endif; ?>
							<?php endforeach; ?>
						</table>
					</div>
				<?php endforeach; ?>
				<?php elseif (!$reported_ads_query): ?>
					<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="90%" valign="center" align="center">
									<h5>Ninguno de sus anuncios ha sido reportado</h5>
								</td>
								<td width="10%" valign="center" align="left">
									<img src="/images/exclamation.png" />
								</td>
							</tr>
						</table>
					</div>
				<?php endif; ?>
			<?php echo $this->pagination->create_links(); ?>
		</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>