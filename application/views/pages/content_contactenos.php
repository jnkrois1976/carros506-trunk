    <?php $this->load->view('includes/header'); ?>
        <section class="contact">
            <div class="centerContainer">
                <div class="mainContent">
                    <h1><?=$this->lang->line('pages_contact_header')?></h1><br />
                    <div class="leftWrapper">
                        <h5>Estamos para servirle.</h5><br />
                        Envienos su pregunta o comentario por medio del suguiente formulario:<br />
                        <form id="contactUsForm" method="" action="" novalidate="novalidate">
                        <fieldset>
                            <legend>Contacte al administrador</legend>
                            <table cellpadding="0" cellspacing="0" border="0" width="600">
                                <colgroup>
                                    <col width="30%"/>
                                    <col width="70%" />
                                </colgroup>
                                <tbody>
                                <?php if($contact_query): ?>
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
                                    <?php elseif($contact_query['contact_categoria'] == "PR"): ?>
                                        <tr style="display: none;">
                                        <td><label for="dealerName">Agencia:</label></td>
                                        <td>
                                            <input type="hidden" name="dealerName" id="dealerName" readonly="readonly" value="<?php echo $contact_query['dealer_name']; ?>" />
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td><label for="sellerEmail">Email:</label></td>
                                        <td>
                                            <input type="text" name="sellerEmail" id="sellerEmail" readonly="readonly" value="<?php echo $contact_query['contact_email']; ?>" />
                                        </td>
                                    </tr>
                                <?php elseif(!$contact_query): ?>
                                    <tr>
                                        <td><label for="sellerName" class="fieldRequired">Nombre:</label></td>
                                        <td style="position: relative;">
                                            <input 
                                                type="text" 
                                                name="sellerName" 
                                                id="sellerName" 
                                                value="" 
                                                required="true" 
                                                placeholder="Su nombre completo..."
                                                data-error="Por favor digite su nombre" 
                                                onclick="this.select();" 
                                                autocomplete="off" 
                                                data-validationtype="text" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sellerEmail" class="fieldRequired">Email:</label></td>
                                        <td style="position: relative;">
                                            <input 
                                                type="email" 
                                                name="sellerEmail" 
                                                id="sellerEmail" 
                                                value="" 
                                                required="true"
                                                placeholder="<?=$this->lang->line('placeholder_email')?>" 
                                                autocomplete="on" 
                                                data-validationtype="email" 
                                                data-error="<?=$this->lang->line('error_msg_email')?>" 
                                                onclick="this.select();"/>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                    <tr>
                                        <td><label for="asunto" class="fieldRequired">Asunto:</label></td>
                                        <td style="position: relative;">
                                            <select name="asunto" id="asunto" required="true" data-error="Por favor seleccione el asunto del mensaje">
                                                <option value="">Por favor seleccione una opci&oacute;n</option>
                                                <option value="anuncio">Con respecto a un anuncio</option>
                                                <option value="perfil">Con respecto a mi cuenta/perfil</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="ad_code_field">
                                        <td><label for="ad_code" class="fieldRequired">C&oacute;digo de anuncio:</label></td>
                                        <td style="position: relative;">
                                            <input 
                                                type="text" 
                                                name="ad_code" 
                                                id="ad_code" 
                                                value="" 
                                                required="false" 
                                                placeholder="C&oacute;digo de anuncio..."
                                                data-error="Por favor digite el c&oacute;digo del anuncio" 
                                                onclick="this.select();" 
                                                autocomplete="off" 
                                                data-validationtype="text" />
                                        </td>
                                    </tr>
                                    <tr id="seller_code_field">
                                        <td><label for="seller_code" class="fieldRequired">C&oacute;digo de vendedor:</label></td>
                                        <td style="position: relative;">
                                            <?php if($contact_query): ?>
                                                <input type="text" name="seller_code" id="seller_code" readonly="readonly" value="<?php echo $contact_query['contact_prefix'].$contact_query['contact_id']; ?>" />
                                            <?php elseif(!$contact_query): ?>
                                                <input 
                                                    type="text" 
                                                    name="seller_code" 
                                                    id="seller_code" 
                                                    value="" 
                                                    required="false" 
                                                    placeholder="C&oacute;digo de vendedor..."
                                                    data-error="Por favor digite su c&oacute;digo de vendedor" 
                                                    onclick="this.select();" 
                                                    autocomplete="off" 
                                                    data-validationtype="text" />
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="user_message" class="fieldRequired">Su mensaje o comentario:</label></td>
                                        <td style="position: relative;">
                                            <textarea name="user_message" id="user_message" placeholder="Su mensaje o comentario..." rows="20" cols="57" required="true" data-error="Por favor digite un mensaje o comentario" /></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td align="right">
                                            <div class="actions">
                                                <input type="submit" id="contactUs" class="secondaryButton" value="Enviar mensaje"/>
                                                <button type="reset" id="resetMsgForm" style="display: none;"></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                    <div id="emailToAdmin" style="display:none; text-align:center; width: 648px; height: 140px; padding: 20px;">
                        <img src="/images/checkmark_large.png" /><br />
                        <h2 style="border:none;">Su mensaje ha sido enviado!<br />Gracias</h2>
                    </div>
                </div>
                <?php $this->load->view('includes/advertisement'); ?>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="/js/common.js"></script>
    <?php $this->load->view('includes/footer'); ?>