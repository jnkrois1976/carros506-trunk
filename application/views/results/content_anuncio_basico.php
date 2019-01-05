<?php $this->load->view('includes/header'); ?>
<?php $is_logged_in = $this->session->userdata('is_logged_in'); ?>
<section>
    <div class="centerContainer">
        <div class="mainContent">
            <?php if($posting): ?>
                <div class="postDetailsTitle">
                    <h2>
                        <?php
                            $today = date('Y-m-d');
                            $posted_date = date_create($posting['ad_postedOn']);
                            $posted_date_format = date_format($posted_date, 'Y-m-d');
                            $week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
                            $week_ahead_format = date_format($week_ahead, 'Y-m-d');  
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
                <?php if($posting['ad_status'] == 1): ?>
                    <div class="soldNotice">
                        Este carro ya se vendi&oacute;!
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="content">
                <?php if($posting): ?>
                    <div class="horizontalBlock second">
                        <div>
                            <div class="slideshowCar" style="position:relative;">
                                <?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
                                    <img src='/images/new_large_badge.png' class='newLargeBadge' data-today="<?php echo $today; ?>" data-posted="<?php echo $posted_date_format ?>" data-weekahead="<?php echo $week_ahead_format ?>"/>
                                <?php elseif($posting['ad_nuevo'] == "1"): ?>
                                    <img src='/images/estrenar_badge.png' class='newLargeBadge' />
                                <?php elseif($posting['ad_nuevo'] == "0"): ?>   
                                    <img src='/images/usado_badge.png' class='newLargeBadge' />
                                <?php endif; ?>
                                <div class="slider-wrapperCar theme-default">
                                    <div id="sliderCar" class="nivoSlider">
                                        <?php
                                            $img_folder = strtolower($posting['ad_idprefix']).$posting['ad_id'];
                                            $folder_path = 'cars/large_thumb/'.$img_folder.'/';
                                            $images = get_filenames($folder_path);
                                            $current_key = key($images);
                                            if($images){
                                                $i = 0;
                                                foreach ($images as $single_image) {
                                                    if($i == 0){
                                                        echo '<img id="largeThumb" src="/cars/large_thumb/'.$img_folder.'/'.$single_image.'" rel="/cars/small_thumb/'.$img_folder.'/'.$single_image.'"/>';
                                                        
                                                    }else{
                                                        echo '<img src="/cars/large_thumb/'.$img_folder.'/'.$single_image.'" rel="/cars/small_thumb/'.$img_folder.'/'.$single_image.'"/>';
                                                    }
                                                    $i = 1;
                                                }
                                            }else {
                                                echo "Este carro no tiene fotos!";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="socialSharing">
                        <table cellpadding="0" cellspacing="0" border="0" width="720px" class="socialIcons">
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
                    <div class="socialSharingWrapper">
                        <table cellpadding="5" cellspacing="0" border="0" width="100%" class="socialSharing">
                            <colgroup>
                                <col width="25%" />
                                <col width="25%" />
                                <col width="25%" />
                                <col width="25%" />
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td>
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
                                    <td>
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
                                                            echo "<span id='star".$c."' class='full' data-rated='false' data-points='".$c."'></span>";
                                                        }else{
                                                            echo "<span id='star".$c."' data-rated='false' data-points='".$c."'></span>";
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
                                    <td>
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
                                    <td>
                                        <div id="reportPost">
                                            <?php
                                                if($is_logged_in == TRUE){
                                                    if($is_reported == TRUE){
                                                        if($self_report == TRUE){
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
                    </div>
                    <div class="carDesc">
                        <table cellpadding="0" cellspacing="0" border="0" class="carDetails">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <?php echo $posting['ad_marca']." ".$posting['ad_modelo']." ".$posting['ad_year']; ?>
                                        &nbsp; - &nbsp;C&oacute;digo: <?php echo $posting['ad_idprefix'].$posting['ad_id']; ?>
                                    </th>
                                    <th>
                                        <?php 
                                            if ($posting['ad_nuevo'] == "1") {
                                                echo "Para estrenar";
                                            }elseif($posting['ad_nuevo'] == "0"){
                                                echo "Usado"; 
                                            } 
                                        ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <strong>
                                            <em>Informaci&oacute;n del veh&iacute;culo</em>
                                        </strong>
                                        <?php 
                                            if($is_logged_in == true){
                                                $seller = $posting['ad_sellerId'];
                                                $buyer = $email_name['contact_prefix'].$email_name['contact_id'];
                                                if($seller == $buyer){
                                                    echo '<a href="/profile/ad_details/'.$posting['ad_idprefix'].$posting['ad_id'].'" class="viewMore">Ver/Editar</a>';
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td colspan="2">
                                        <strong>
                                            <em>Informaci&oacute;n del vendedor</em>
                                        </strong>
                                        <?php 
                                            if($is_logged_in == true){
                                                $seller = $posting['ad_sellerId'];
                                                $buyer = $email_name['contact_prefix'].$email_name['contact_id'];
                                                if($seller == $buyer){
                                                    echo '<a href="/profile/member" class="viewMore">Ver/Editar</a>';
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marca:</td>
                                    <td><?php echo $posting['ad_marca']; ?></td>
                                    <td>Vendedor:</td>
                                    <td><?php echo $posting['ad_sellerCategory']; ?></td>
                                </tr>
                                <tr>
                                    <td>Modelo:</td>
                                    <td><?php echo $posting['ad_modelo']; ?></td>
                                    <td>Nombre:</td>
                                    <td>
                                        <?php if($posting['ad_idprefix'] == 'PR'): ?>
                                            <a href="/resultados/vendedor/<?php echo $posting['ad_sellerId']; ?>" class="plainDarkLink"><?php echo $posting['ad_sellerName']; ?></a>
                                        <?php elseif($posting['ad_idprefix'] == 'AG'): ?>
                                            <a href="/resultados/agencia/<?php echo $posting['ad_sellerId']; ?>" class="plainDarkLink"><?php echo $posting['ad_sellerName']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A&ntilde;o:</td>
                                    <td><?php echo $posting['ad_year']; ?></td>
                                    <td>Tel&eacute;fono:</td>
                                    <td><?php echo $posting['ad_sellerPhone']; ?></td>
                                </tr>
                                <tr>
                                    <td>Precio:</td>
                                    <td>
                                    <?php
                                        setlocale(LC_MONETARY, 'it_IT');
                                        echo "&#8353;".money_format('%!.0n', $posting['ad_precio']);
                                    ?>
                                    </td>
                                    <td>Email:</td>
                                    <td>
                                        <?php
                                            if($is_logged_in == true){
                                                $seller = $posting['ad_sellerId'];
                                                $buyer = $email_name['contact_prefix'].$email_name['contact_id'];
                                                if($seller == $buyer){
                                                    echo '<a href="#" id="notLoggedInMessage" data-error="No puede enviar mensajes a usted mismo!" class="action">Enviar Mensaje</a>';
                                                }elseif($seller != $buyer){
                                                    echo '<a href="#" id="quickMessage" class="action">Enviar Mensaje</a>';
                                                }
                                            }else{
                                                echo '<a href="#" id="notLoggedInMessage" data-error="Favor ingresar o registrarse para enviar mensajes!" class="action">Enviar Mensaje</a>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kilometraje:</td>
                                    <td><?php echo number_format($posting['ad_kilometraje'], 0, ',', '.'); ?></td>
                                    <td>
                                        Fecha de publicaci&oacute;n:
                                    </td>
                                    <td>
                                        <?php
                                            $break_post_date = explode('-', $posting['ad_postedOn']);
                                            setlocale(LC_TIME, "es_ES"); 
                                            echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_post_date[1], $break_post_date[2], $break_post_date[0]));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A la venta en:</td>
                                    <td>
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
                                                if($posting['ad_location'] == $province_option){
                                                    echo $key;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Estado legal</td>
                                    <td><?php echo $legal_status = ($posting['ad_legalstatus'] == '1') ? 'Registrado': 'En aduanas'; ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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
                <?php if($similar_posting): ?>
                    <div class="carThumbWrapper">
                        <br />
                        <hr />
                        <br />
                        <h1 id="resultCounter">Resultados similares &nbsp;<img src="/images/load_bar.png" id="loaderBar" alt="Actualizando" /></h1>
                        <div class="filter">
                            <span>Filtro:</span>
                            <span>
                                <button id="newCars" type="button">Para estrenar</button>
                                <button id="usedCars" type="button">Usados</button>
                                <button id="allCars" type="button">Todos</button>
                            </span>
                        </div>
                        <hr />
                        <?php foreach($similar_posting as $similar_post_row): ?>
                            <?php
                                $today = date('Y-m-d');
                                $posted_date = date_create($similar_post_row->ad_postedOn);
                                $posted_date_format = date_format($posted_date, 'Y-m-d');
                                $week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
                                $week_ahead_format = date_format($week_ahead, 'Y-m-d');
                                $img_folder = strtolower($similar_post_row->ad_idprefix).$similar_post_row->ad_id;
                                $folder_path = 'cars/large_thumb/'.$img_folder.'/';
                                $images = get_filenames($folder_path);
                            ?>
                            <?php if($similar_post_row->ad_categoria == "A"): ?>
                                <div class="carThumb <?php echo $condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
                                    <table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
                                        <colgroup>
                                            <col width="35%" />
                                            <col width="30%" />
                                            <col width="35%" />
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td valign="top"><h5 class="postTitle"><?php echo $similar_post_row->ad_marca . " " . $similar_post_row->ad_modelo . " - " . $similar_post_row->ad_year; ?></h5></td>
                                                <td valign="top"><h6>Comentarios: <?php echo $similar_post_row->ad_publicComments; ?></h6></td>
                                                <td valign="top" align="right"><h6>Visitas: <?php echo $similar_post_row->ad_visits; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <td style="position: relative;">
                                                    <?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
                                                        <img src='/images/new_large_badge.png' class='newBadge' width="75"/>
                                                    <?php elseif($posting['ad_nuevo'] == "1"): ?>
                                                        <img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
                                                    <?php elseif($posting['ad_nuevo'] == "0"): ?>   
                                                        <img src='/images/usado_badge.png' class='newLargeBadge' width="75"/>
                                                    <?php endif; ?>
                                                    <a href="/resultados/anuncio/<?php echo $similar_post_row->ad_idprefix . $similar_post_row->ad_id; ?>">
                                                        <img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
                                                    </a><br />
                                                    <a class="viewAdLink" href="/resultados/anuncio/<?php echo $similar_post_row->ad_idprefix . $similar_post_row->ad_id; ?>">Ver detalles</a>
                                                </td>
                                                <td>
                                                    <ul class="listedDetails">
                                                        <li>
                                                            <?php echo $similar_post_row->ad_marca; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_modelo; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_year; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_motor; ?>
                                                            Cilindros
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_transmision; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo number_format($similar_post_row->ad_kilometraje, 0, ',', '.'); ?>
                                                            Km
                                                        </li>
                                                        <li>
                                                            &#8353; <?php
                                                            setlocale(LC_MONETARY, 'it_IT');
                                                            echo money_format('%!.0n', $similar_post_row->ad_precio);
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="listedDetails">
                                                        <li>
                                                            <?php echo $similar_post_row->ad_estado; ?>
                                                            estado
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_color; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_combustible; ?>
                                                        </li>
                                                        <li>
                                                            Motor <?php echo $similar_post_row->ad_centimetros; ?>
                                                            CC
                                                        </li>
                                                        <li>
                                                            Tracci&oacute;n <?php echo $similar_post_row->ad_traccion; ?>
                                                        </li>
                                                        <li>
                                                            Vendedor: <?php echo $similar_post_row->ad_sellerCategory; ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                $break_post_date_a = explode('-', $similar_post_row->ad_postedOn);
                                                                setlocale(LC_TIME, "es_ES"); 
                                                            ?>
                                                            Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_post_date_a[1], $break_post_date_a[2], $break_post_date_a[0])); ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif($similar_post_row->ad_categoria == "B"): ?>
                                <div class="carThumb <?php echo $condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
                                    <table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
                                        <colgroup>
                                            <col width="35%" />
                                            <col width="30%" />
                                            <col width="35%" />
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td valign="top"><h5 class="postTitle"><?php echo $similar_post_row->ad_marca . " " . $similar_post_row->ad_modelo . " - " . $similar_post_row->ad_year; ?></h5></td>
                                                <td valign="top"><h6>Comentarios: <?php  echo $similar_post_row->ad_publicComments; ?></h6></td>
                                                <td valign="top" align="right"><h6>Visitas: <?php echo $similar_post_row->ad_visits; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <td style="position: relative;">
                                                    <?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
                                                        <img src='/images/new_large_badge.png' class='newBadge' width="75"/>
                                                    <?php elseif($posting['ad_nuevo'] == "1"): ?>
                                                        <img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
                                                    <?php elseif($posting['ad_nuevo'] == "0"): ?>   
                                                        <img src='/images/usado_badge.png' class='newLargeBadge' width="75" />
                                                    <?php endif; ?>
                                                    <a href="/resultados/anuncio_medio/<?php echo $similar_post_row->ad_idprefix . $similar_post_row->ad_id; ?>">
                                                        <img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb"/>
                                                    </a><br />
                                                    <a class="viewAdLink" href="/resultados/anuncio_medio/<?php echo $similar_post_row->ad_idprefix . $similar_post_row->ad_id; ?>">Ver detalles</a>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <ul class="listedDetails">
                                                        <li>
                                                            <?php echo $similar_post_row->ad_marca; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_modelo; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_year; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_motor; ?>
                                                            Cilindros
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_transmision; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo number_format($similar_post_row->ad_kilometraje, 0, ',', '.'); ?>
                                                            Km
                                                        </li>
                                                        <li>
                                                            &#8353; <?php
                                                            setlocale(LC_MONETARY, 'it_IT');
                                                            echo money_format('%!.0n', $similar_post_row->ad_precio);
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <ul class="listedDetails">
                                                        <li>
                                                            <?php echo $similar_post_row->ad_combustible; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_carroceria; ?>
                                                        </li>
                                                        <li>
                                                            Vendedor: <?php echo $similar_post_row->ad_sellerCategory; ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                $break_post_date_b = explode('-', $similar_post_row->ad_postedOn);
                                                                setlocale(LC_TIME, "es_ES"); 
                                                            ?>
                                                            Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_post_date_b[1], $break_post_date_b[2], $break_post_date_b[0])); ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif($similar_post_row->ad_categoria == "C"): ?>
                                <div class="carThumb <?php echo $condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado"); ?>">
                                    <table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
                                        <colgroup>
                                            <col width="35%" />
                                            <col width="35%" />
                                            <col width="30%" />
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td valign="top"><h5 class="postTitle"><?php echo $similar_post_row->ad_marca . " " . $similar_post_row->ad_modelo . " - " . $similar_post_row->ad_year; ?></h5></td>
                                                <td valign="top"><h5>Visitas: <?php echo $similar_post_row->ad_visits; ?></h5></td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="position: relative;">
                                                    <?php if($today >= $posted_date_format && $today <= $week_ahead_format): ?>
                                                        <img src='/images/new_large_badge.png' class='newBadge' width="75" />
                                                    <?php elseif($posting['ad_nuevo'] == "1"): ?>
                                                        <img src='/images/estrenar_badge.png' class='newLargeBadge' width="75" />
                                                    <?php elseif($posting['ad_nuevo'] == "0"): ?>   
                                                        <img src='/images/usado_badge.png' class='newLargeBadge' width="75" />
                                                    <?php endif; ?>
                                                    <a href="/resultados/anuncio_basico/<?php echo $similar_post_row->ad_idprefix.$similar_post_row->ad_id; ?>">
                                                        <img src="/cars/large_thumb/<?php echo $img_folder.'/'.$images[0]; ?>" class="postThumb zoom"/>
                                                    </a>
                                                    <br />
                                                    <a class="viewAdLink" href="/resultados/anuncio_basico/<?php echo $similar_post_row->ad_idprefix.$similar_post_row->ad_id; ?>">Ver detalles</a>
                                                </td>
                                                <td style="vertical-align:top;" colspan="2">
                                                    <ul class="listedDetails">
                                                        <li>
                                                            <?php echo $similar_post_row->ad_marca; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_modelo; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $similar_post_row->ad_year; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo number_format($similar_post_row->ad_kilometraje, 0, ',', '.'); ?>
                                                            Km
                                                        </li>
                                                        <li>
                                                            &#8353; <?php
                                                            setlocale(LC_MONETARY, 'it_IT');
                                                            echo money_format('%!.0n', $similar_post_row->ad_precio);
                                                            ?>
                                                        </li>
                                                        <li>
                                                            Vendedor: <?php echo $similar_post_row->ad_sellerCategory; ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                $break_post_date_c = explode('-', $similar_post_row->ad_postedOn);
                                                                setlocale(LC_TIME, "es_ES"); 
                                                            ?>
                                                            Publicado el <?php echo strftime("%e de %B, %Y", mktime(0, 0, 0, $break_post_date_c[1], $break_post_date_c[2], $break_post_date_c[0])); ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php echo $this->pagination->create_links(); ?>
                <?php endif; ?>
            </div>
            <?php $this->load->view('includes/advertisement'); ?>
        </div>
    </div>
    <?php if($is_logged_in == TRUE && $posting == TRUE): ?>
        <div id="dialogQuickMessage" title="Mensaje r&aacute;pido al vendedor" style="display: none;">
            <form method="post" action="" id="quickMessageForm">
                <fieldset>
                    <input id="buyer_name" type="hidden" name="buyer_name" value="<?php echo $email_name['contact_fullname']; ?>" />
                    <input id="buyer_email" type="hidden" name="buyer_email" value="<?php echo $email_name['contact_email']; ?>" />
                    <input id="buyer_id" type="hidden" name="buyer_id" value="<?php echo $email_name['contact_prefix'].$email_name['contact_id']; ?>" />
                    <input id="seller_id" type="hidden" name="seller_id" value="<?php echo $posting['ad_sellerId']; ?>" />
                    <input id="ad_fullid" type="hidden" name="ad_fullid" value="<?php echo $posting['ad_fullid']; ?>" />
                    <input id="ad_expires" type="hidden" name="ad_expires" value="<?php echo $posting['ad_expires']; ?>" />
                    <input type="hidden" value="anuncios" name="donde" id="donde" />
                    <label for="name">Para: <?php echo $posting['ad_sellerName']; ?></label>
                    <br /><br />
                    <label for="email">De: <?php echo $email_name['contact_fullname']; ?></label>
                    <br /><br />
                    <label for="question">Su mensaje:</label><br />
                    <textarea id="buyer_message" name="buyer_message" cols="40" rows="10"></textarea><br /><br />
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
        <div id="dialogEmailToFriend" title="Enviar a un amigo" style="display: none;">
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
</section>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/slideshow.js"></script>
<script type="text/javascript" src="/js/jquery_slider.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<?php $this->load->view('includes/footer'); ?>
