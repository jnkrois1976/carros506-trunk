	<?php $this->load->view('includes/header'); ?>
	<section>
		<div id="toolTip" class="bubble">
			<span id="tooltipMessage"></span>
			<span class="arrow"></span>
		</div>
		<div class="centerContainer">
			<div class="mainContentPages">
				<div class="commentsTitle">
					<h2>Mensajes y comentarios</h2><br />
				</div>
				<div id="messagesCountPanel">
					<span id="commentsNew">
						<img src="/svg/new_comment_large.svg" /> 
						<span class="xlarge" id="newCommentCount"><?php echo $count_new_comments; ?></span>
						<span class="countText">Comentarios<br />nuevos</span>
					</span>
					<span id="commentsPrivate">
						<img src="/images/lock_large.png" /> 
						<span class="xlarge attention" id="commentPrivateCount"><?php echo $count_private_comments; ?></span>
						<span class="countText">Comentarios<br />sin publicar</span>
					</span>
					<span id="commentsNoAnswer">
						<img src="/svg/warning_yellow_large.svg" /> 
						<span class="xlarge" id="commentNoAnswerCount"><?php echo $count_unanswered_comments; ?></span>
						<span class="countText">Comentarios<br />sin contestar</span>
					</span>
					<span id="messagesNew">
						<img src="/svg/new_comment_large.svg" /> 
						<span class="xlarge" id="newMessageCount"><?php echo $count_new_messages; ?></span>
						<span class="countText">Mensajes<br />nuevos</span>
					</span>
					<span id="messagesNoAnswer">
						<img src="/svg/warning_yellow_large.svg" /> 
						<span class="xlarge"><?php echo $count_unanswered_messages; ?></span>
						<span class="countText">Mensajes<br />sin contestar</span>
					</span>
				</div>
				<script>
			        $(window).load(function(){
						$("#messagesCountPanel").sticky({ topSpacing: 50, className: 'floating' });
					});
			    </script>
				<?php if($get_post_messages): ?>
					<div class="carThumbWrapper">
						<?php foreach($get_post_messages as $post_row): ?>
							<?php 
								$img_folder = strtolower($post_row->ad_idprefix).$post_row->ad_id;
								$folder_path = 'cars/large_thumb/'.$img_folder.'/';
								$images = get_filenames($folder_path);
							?>
							<div class="carThumb <?php echo $condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>" data-postId="<?php echo $post_row->ad_fullid; ?>">
								<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
									<colgroup>
										<col width="22%"/>
										<col width="39%"/>
										<col width="39%" />
									</colgroup>
									<tbody>
										<tr>
											<td valign="top">
												<h5 class="postTitle"><?php echo $post_row->ad_marca." ".$post_row->ad_modelo." - ".$post_row->ad_year; ?></h5>
											</td>
											<td valign="top">
												<h6>Comentarios para este anuncio: <?php echo $post_row->ad_comments; ?></h6>
											</td>
											<td valign="top">
												<h6>Mensajes para este anuncio: <?php echo $post_row->ad_messages; ?></h6>
											</td>
										</tr>
										<tr>
											<td valign="top">
												<a href="/resultados/anuncio/<?php echo $post_row->ad_fullid; ?>">
													<img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
												</a>
											</td>
											<td valign="top">
												<div class="commentsWrap">
													<?php if ($post_row->ad_comments > "0"): ?>
														<?php foreach ($all_posts_comments as $comment_row): ?>
															<?php if($post_row->ad_fullid == $comment_row->ad_fullid): ?>
																<table cellpadding="0" cellspacing="0" border="0" width="100%">
																	<colgroup>
																		<col width="70%" />
																		<col width="30%" />
																	</colgroup>
																	<thead>
																		<tr>
																			<?php 
																				$break_date_comment = explode('-', $comment_row->comment_date);
																				setlocale(LC_TIME, "es_ES"); 
																			?>
																			<th>Agregado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_comment[1], $break_date_comment[2], $break_date_comment[0])); ?></th>
																			<th align="right">
																				<?php if($comment_row->seller_reply == ""): ?>
																					<img id="replyIcon_<?php echo $comment_row->id; ?>" src="/svg/warning_yellow.svg" class="tooltip" data-title="No has respondido a este comentario!"/>
																				<?php endif; ?>
																				<?php if($comment_row->public == "0"): ?>
																					<img src="/images/lock.png" id="notPublic_<?php echo $comment_row->id; ?>" class="tooltip" data-title="Este comentario no es p&uacute;blico!"/>
																				<?php endif; ?>
																				<?php if($comment_row->reviewed == "0"): ?>
																					<img src="/svg/new_comment.svg" id="newComment_<?php echo $comment_row->id; ?>" class="tooltip" data-title="Este comentario no ha sido le&iacute;do!" />
																				<?php endif; ?>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																	<tr>
																		<td colspan="2">Hecho por: <strong><em><?php echo $comment_row->buyer_name; ?></em></strong></td>
																	</tr>
																	<tr>
																		<td>Contenido del comentario:</td>
																		<td>
																			<?php if($comment_row->reviewed == "1"): ?>
																				<a href="#" class="expandComment plainDarkLink">Ver el resto &#9660;</a>
																			<?php elseif ($comment_row->reviewed == "0"): ?> 
																				<a href="#" class="expandComment plainDarkLink" data-commentid="<?php echo $comment_row->id; ?>" data-adfullid="<?php echo $comment_row->ad_fullid; ?>" data-read="newComment_<?php echo $comment_row->id; ?>">Ver el resto &#9660;</a>
																			<?php endif; ?>
																		</td>
																	</tr>
																	</tbody>
																	<tbody class="expand">
																	<tr>
																		<td colspan="2"><strong><em><?php echo $comment_row->buyer_comment; ?></td>
																	</tr>
																	<?php if($comment_row->seller_reply == ""): ?>
																		<tr>
																			<td colspan="2">
																				<?php if($comment_row->seller_reply == "" && $comment_row->public == "1"): ?>
																					<button type="button" class="replyToComment edit" value="Responder">Responder</button>
																				<?php elseif($comment_row->seller_reply == "" && $comment_row->public == "0"): ?>
																					<button type="button" class="replyToComment edit" value="Responder">Responder y publicar</button>
																				<?php endif; ?>
																				<form action="" method="post" class="commentReply" id="commentReply_<?php echo $comment_row->id; ?>">
																					<fieldset>
																						<input type="hidden" value="<?php echo $comment_row->id; ?>" name="commentId" id="commentId_<?php echo $comment_row->id; ?>" />
																						<input type="hidden" value="<?php echo $comment_row->ad_fullid; ?>" name="adFullId" id="adFullId_<?php echo $comment_row->id; ?>" />
																						<input type="hidden" value="replyIcon_<?php echo $comment_row->id; ?>" name="replyIconId" id="replyRemoveIcon<?php echo $comment_row->id; ?>" />
																						<textarea cols="41" rows="5" name="sellerCommentReply" id="sellerCommentReply_<?php echo $comment_row->id; ?>"></textarea><br /><br />
																						<input type="submit" name="sendSellerReply" data-formid="commentReply_<?php echo $comment_row->id; ?>" id="sendSellerReply_<?php echo $comment_row->id; ?>" value="Responder" class="submitCommentReply"/>
																						<button type="reset" class="cancelCommentReply" value="Cancelar" data-formid="commentReply_<?php echo $comment_row->id; ?>">Cancelar</button>
																					</fieldset>
																				</form>
																			</td>
																		</tr>
																	<?php endif; ?>
																	<?php if($comment_row->seller_reply != ""): ?>
																		<tr>
																			<td colspan="2"><hr /></td>
																		</tr>
																		<tr>
																			<td colspan="2">Respuesta:</td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<strong><em><?php echo $comment_row->seller_reply; ?></em></strong>
																			</td>
																		</tr>
																		<?php if($comment_row->public == "0"): ?>
																			<tr>
																				<td colspan="2">
																					<button type="button" data-publicicon="notPublic_<?php echo $comment_row->id; ?>" data-commentid="<?php echo $comment_row->id; ?>" data-adfullid="<?php echo $comment_row->ad_fullid; ?>" class="makePublic" value="Publicar">Publicar</button>
																				</td>
																			</tr>
																		<?php elseif($comment_row->public == "1"): ?>
																			<tr>
																				<td colspan="2">
																					<button type="button" data-publicicon="public_<?php echo $comment_row->id; ?>" data-commentid="<?php echo $comment_row->id; ?>" data-adfullid="<?php echo $comment_row->ad_fullid; ?>" class="makePrivate" value="Privado">Privado</button>
																				</td>
																			</tr>
																		<?php endif; ?>
																	<?php elseif($comment_row->public == "1"): ?>
																		<tr>
																			<td colspan="2">
																				<button type="button" data-publicicon="public_<?php echo $comment_row->id; ?>" data-commentid="<?php echo $comment_row->id; ?>" data-adfullid="<?php echo $comment_row->ad_fullid; ?>" class="makePrivate" value="Privado">Privado</button>
																			</td>
																		</tr>
																	<?php endif; ?>
																	</tbody>
																</table>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php elseif ($post_row->ad_comments == "0"): ?>
														<span>Este anuncio no tiene comentarios todav&iacute;a.</span>
													<?php endif; ?>
												</div>
											</td>
											<td valign="top">
												<div class="messagesWrap">
													<?php if ($post_row->ad_messages > "0"): ?>
														<?php foreach ($all_posts_messages as $message_row): ?>
															<?php if($post_row->ad_fullid == $message_row->ad_fullid): ?>
																<table cellpadding="0" cellspacing="0" border="0" width="100%">
																	<colgroup>
																		<col width="70%" />
																		<col width="30%" />
																	</colgroup>
																	<thead>
																		<tr>
																			<?php 
																				$break_date_msg = explode('-', $message_row->message_date);
																				setlocale(LC_TIME, "es_ES"); 
																			?>
																			<th>
																				Recibido el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_msg[1], $break_date_msg[2], $break_date_msg[0])); ?>
																			</th>
																			<th align="right">
																				<?php if($message_row->seller_reply == ""): ?>
																					<img src="/svg/warning_yellow.svg" class="tooltip" data-title="No has respondido a este mensaje!"/>
																				<?php endif; ?>
																				<?php if($message_row->reviewed == "0"): ?>
																					<img src="/svg/new_comment.svg" id="newMessage_<?php echo $message_row->id; ?>" class="tooltip" data-title="Este mensaje no ha sido le&iacute;do!" />
																				<?php endif; ?>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																	<tr>
																		<td colspan="2">Enviado por: <strong><em><?php echo $message_row->buyer_name; ?></em></strong></td>
																	</tr>
																	<tr>
																		<td>Contenido del mensaje:</td>
																		<td>
																			<?php if($message_row->reviewed == "1"): ?>
																				<a href="#" class="expandMessage plainDarkLink">Ver el resto &#9660;</a>
																			<?php elseif ($message_row->reviewed == "0"): ?> 
																				<a href="#" class="expandMessage plainDarkLink" data-messageid="<?php echo $message_row->id; ?>" data-adfullid="<?php echo $message_row->ad_fullid; ?>" data-read="newMessage_<?php echo $message_row->id; ?>">Ver el resto &#9660;</a>
																			<?php endif; ?>
																		</td>
																	</tr>
																	</tbody>
																	<tbody class="expand">
																	<tr>
																		<td colspan="2"><strong><em><?php echo $message_row->buyer_message; ?></em></strong></td>
																	</tr>
																	<?php if($message_row->seller_reply == ""): ?>
																		<tr>
																			<td colspan="2">
																				<button type="button" data-messageid="<?php echo $message_row->id; ?>" data-adfullid="<?php echo $message_row->ad_fullid; ?>" class="replyToMessage edit" value="Responder">Responder</button>
																				<form action="" method="post" class="messageReply" id="messageReply_<?php echo $message_row->id; ?>">
																					<fieldset>
																						<input type="hidden" value="<?php echo $message_row->id; ?>" name="messageId" id="messageId_<?php echo $message_row->id; ?>" />
																						<input type="hidden" value="<?php echo $message_row->ad_fullid; ?>" name="adFullId" id="adFullId_<?php echo $message_row->id; ?>" />
																						<input type="hidden" value="replyIcon_<?php echo $message_row->id; ?>" name="replyIconId" id="replyRemoveIcon<?php echo $message_row->id; ?>" />
																						<textarea cols="41" rows="5" name="sellerMessageReply" id="sellerMessageReply_<?php echo $message_row->id; ?>"></textarea><br /><br />
																						<input type="hidden" value="<?php echo $message_row->buyer_email; ?>" name="buyerEmail" id="buyerEmail_<?php echo $message_row->id; ?>" />
																						<input type="submit" name="sendMessageReply" data-formid="messageReply_<?php echo $message_row->id; ?>" id="sendMessageReply_<?php echo $message_row->id; ?>" value="Enviar respuesta" class="submitMessageReply"/>
																						<button type="reset" class="cancelMessageReply" value="Cancelar" data-formid="sellerMessageReply_<?php echo $message_row->id; ?>">Cancelar</button>
																					</fieldset>
																				</form>
																			</td>
																		</tr>
																	<? endif; ?>
																	<?php if($message_row->seller_reply != ""): ?>
																		<tr>
																			<td colspan="2"><hr /></td>
																		</tr>
																		<tr>
																			<td colspan="2"><strong>Respondido el: <?php echo date( 'd/m/Y', strtotime($message_row->reply_date)); ?></strong></td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<strong><em><?php echo $message_row->seller_reply; ?></em></strong>
																			</td>
																		</tr>
																	<? endif; ?>
																	</tbody>
																</table>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php elseif ($post_row->ad_messages == "0"): ?>
														<span>Este anuncio no ha recibido mensajes todav&iacute;a.</span>
													<?php endif; ?>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						<?php endforeach; ?>
						<?php echo $this->pagination->create_links(); ?>
					</div>
				<?php elseif(!$get_post_messages): ?>
					<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="90%" valign="center" align="center">
									<h5>Ninguno de sus anuncios ha recibido mensajes o comentarios</h5>
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