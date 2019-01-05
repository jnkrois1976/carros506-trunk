	<?php $this->load->view('includes/header'); ?>
	<section class="preguntas">
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pages_faq_header')?></h1>
				<div class="leftColumn">
    				<div class="leftWrapper">
    				    <h5>Envienos su pregunta</h5>
    				    <hr />
    				    <p>
    				    	Si desea enviarnos una pregunta, nada mas haga click en el boton <button class="action" id="postQuestion">Haga una pregunta!</button>
    				    </p>
    				    <form action="" method="" style="display: none;" id="postQuestionForm">
    				        <fieldset>
    				            <legend>Su pregunta</legend>
    				            <table cellpadding="0" cellspacing="0" border="0" width="600">
                                    <colgroup>
                                        <col width="40%"/>
                                        <col width="60%" />
                                    </colgroup>
                                    <tbody>
        				                <tr>
        				                    <td><label for="questionTopic">Cual es el tema de su pregunta?</label></td>
        				                    <td style="position: relative;">
        				                        <select name="questionTopic" id="questionTopic" required="true" data-error="Por favor seleccione el tema de su pregunta">
                                                    <option value="">Por favor seleccione una opci&oacute;n</option>
                                                    <option value="anuncios">Acerca de un anuncio</option>
                                                    <option value="perfil">Acerca de mi cuenta/perfil</option>
                                                    <option value="publicidad">Acerca de la publicidad</option>
                                                    <option value="comentarios">Acerca de los comentarios en mi anuncio</option>
                                                    <option value="mensajes">Acerca de mis mensajes recibidos</option>
                                                    <option value="generales">Preguntas generales</option>
                                                </select>
        				                    </td>
        				                </tr>
        				                <tr>
                                            <td><label for="userQuestion">Por favor digite su pregunta</label></td>
                                            <td style="position: relative;">
                                                <textarea name="userQuestion" id="userQuestion" placeholder="Su pregunta..." rows="10" cols="48" required="true" data-error="Por favor digite su pregunta" /></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td align="right">
                                                <div class="actions">
                                                    <input type="submit" id="userQuestionSubmit" class="secondaryButton" value="Envie su pregunta"/>
                                                    <button type="reset" id="resetQuestionForm" style="display: none;"></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="display: none;" id="userQuestionSuccess">
                                        	<td colspan="2">
                                        		<div style="text-align:center; width: 560px; height: 140px; padding: 20px;">
    						                        <img src="/images/checkmark_large.png" /><br />
    						                        <h2 style="border:none;">Su pregunta ha sido enviado!<br />Gracias</h2>
    						                    </div>
                                        	</td>
                                        </tr>
                                    </tbody>
    				            </table>
    				        </fieldset>
    				    </form>
				    </div>
				    
				    <div class="leftWrapper">
                        <a name="backToTop"><h5>Preguntas de usuarios</h5></a>
                        <hr />
                        <p>
                        	A continuaci&oacute;n puede ver las preguntas enviadas por los usuarios y sus respuestas ordenadas por tema.<br />
                        	<small> (click en cada tema para saltar a esa seccion)</small>
                        </p>
                        <ol>
    				        <li><a href="#anuncios" class="plainLink">Acerca de anuncios</a></li>
    				        <li><a href="#perfil" class="plainLink">Acerca de su cuenta/perfil</a></li>
    				        <li><a href="#publicidad" class="plainLink">Acerca de anuncios publicitarios</a></li>
    				        <li><a href="#comentarios" class="plainLink">Acerca de los comentarios en su anuncio</a></li>
    				        <li><a href="#mensajes" class="plainLink">Acerca de sus mensajes recibidos</a></li>
    				      	<li><a href="#generales" class="plainLink">Temas generales</a></li>
    				    </ol>
				    </div>
				    
    				    <?php 
    			    		$topic = array("Acerca de anuncios", "Acerca de su cuenta/perfil", "Acerca de anuncios publicitarios", "Acerca de los comentarios en su anuncio", "Acerca de sus mensajes recibidos", "Temas generales"); 
    			    		$topic_anchor = array("anuncios", "perfil", "publicidad", "comentarios", "mensajes", "generales");
    			    	?>
    			    	
			    	<div class="leftWrapper">
    				    <?php if($user_questions_anuncios): ?>
                            <a name="<?php echo $topic_anchor[0]; ?>"><h5><?php echo $topic[0]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
    				    	<?php foreach($user_questions_anuncios as $question_row): ?>
    						    <div class="questionWrapper">
    				    		<?php if($question_row->question_topic == "anuncios"): ?>
    				    		    <span class="questionLabel">Pregunta:</span>
    							    <span class="postedUserQuestion">
    							    	<?php echo $question_row->user_question; ?>
    							    </span>
    							    <br />
    							    <span class="answerLabel">Respuesta:</span>
    							    <span class="postedAdminResponse">
    							    	<?php echo $question_row->admin_answer; ?>
    							    </span>
    							    <br />
    		    				<?php endif; ?>
    		    				</div>
    			    		<?php endforeach; ?>
    			    	<?php elseif(!$user_questions_anuncios): ?>
    				    	No hay preguntas de usuarios
    			    	<?php endif; ?>
                    </div>
                    
                    <div class="leftWrapper">
                        <?php if($user_questions_perfil): ?>
                            <a name="<?php echo $topic_anchor[1]; ?>"><h5><?php echo $topic[1]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
                            <?php foreach($user_questions_perfil as $question_row): ?>
                                <div class="questionWrapper">
                                <?php if($question_row->question_topic == "perfil"): ?>
                                    <span class="questionLabel">Pregunta:</span>
                                    <span class="postedUserQuestion">
                                        <?php echo $question_row->user_question; ?>
                                    </span>
                                    <br />
                                    <span class="answerLabel">Respuesta:</span>
                                    <span class="postedAdminResponse">
                                        <?php echo $question_row->admin_answer; ?>
                                    </span>
                                    <br />
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif(!$user_questions_perfil): ?>
                            No hay preguntas de usuarios
                        <?php endif; ?>
                    </div>
                    
                    <div class="leftWrapper">
                        <?php if($user_questions_publicidad): ?>
                            <a name="<?php echo $topic_anchor[2]; ?>"><h5><?php echo $topic[2]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
                            <?php foreach($user_questions_publicidad as $question_row): ?>
                                <div class="questionWrapper">
                                <?php if($question_row->question_topic == "publicidad"): ?>
                                    <span class="questionLabel">Pregunta:</span>
                                    <span class="postedUserQuestion">
                                        <?php echo $question_row->user_question; ?>
                                    </span>
                                    <br />
                                    <span class="answerLabel">Respuesta:</span>
                                    <span class="postedAdminResponse">
                                        <?php echo $question_row->admin_answer; ?>
                                    </span>
                                    <br />
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif(!$user_questions_publicidad): ?>
                            No hay preguntas de usuarios
                        <?php endif; ?>
                    </div>
                    
                    <div class="leftWrapper">
                        <?php if($user_questions_comentarios): ?>
                            <a name="<?php echo $topic_anchor[3]; ?>"><h5><?php echo $topic[3]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
                            <?php foreach($user_questions_comentarios as $question_row): ?>
                                <div class="questionWrapper">
                                <?php if($question_row->question_topic == "comentarios"): ?>
                                    <span class="questionLabel">Pregunta:</span>
                                    <span class="postedUserQuestion">
                                        <?php echo $question_row->user_question; ?>
                                    </span>
                                    <br />
                                    <span class="answerLabel">Respuesta:</span>
                                    <span class="postedAdminResponse">
                                        <?php echo $question_row->admin_answer; ?>
                                    </span>
                                    <br />
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif(!$user_questions_comentarios): ?>
                            No hay preguntas de usuarios
                        <?php endif; ?>
                    </div>
                    
                    <div class="leftWrapper">
                        <?php if($user_questions_mensajes): ?>
                            <a name="<?php echo $topic_anchor[4]; ?>"><h5><?php echo $topic[4]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
                            <?php foreach($user_questions_mensajes as $question_row): ?>
                                <div class="questionWrapper">
                                <?php if($question_row->question_topic == "mensajes"): ?>
                                    <span class="questionLabel">Pregunta:</span>
                                    <span class="postedUserQuestion">
                                        <?php echo $question_row->user_question; ?>
                                    </span>
                                    <br />
                                    <span class="answerLabel">Respuesta:</span>
                                    <span class="postedAdminResponse">
                                        <?php echo $question_row->admin_answer; ?>
                                    </span>
                                    <br />
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif(!$user_questions_mensajes): ?>
                            No hay preguntas de usuarios
                        <?php endif; ?>
                    </div>
                    
                    <div class="leftWrapper">
                        <?php if($user_questions_generales): ?>
                            <a name="<?php echo $topic_anchor[5]; ?>"><h5><?php echo $topic[5]; ?></h5></a>
                            <a class="backToTop" href="#backToTop">Volver arriba</a>
                            <hr />
                            <?php foreach($user_questions_generales as $question_row): ?>
                                <div class="questionWrapper">
                                <?php if($question_row->question_topic == "generales"): ?>
                                    <span class="questionLabel">Pregunta:</span>
                                    <span class="postedUserQuestion">
                                        <?php echo $question_row->user_question; ?>
                                    </span>
                                    <br />
                                    <span class="answerLabel">Respuesta:</span>
                                    <span class="postedAdminResponse">
                                        <?php echo $question_row->admin_answer; ?>
                                    </span>
                                    <br />
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif(!$user_questions_generales): ?>
                            No hay preguntas de usuarios
                        <?php endif; ?>
                    </div>
				</div>
				<?php $this->load->view('includes/advertisement'); ?>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>