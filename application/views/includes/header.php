<?php $is_logged_in = $this->session->userdata('is_logged_in'); ?>
<?php
    error_reporting(0);
/*include 'ChromePhp.php';
ChromePhp::log('hello world');
ChromePhp::log($_SERVER);

// using labels
foreach ($_SERVER as $key => $value) {
    ChromePhp::log($key, $value);
}

// warnings and errors
ChromePhp::warn('this is a warning');
ChromePhp::error('this is an error');
 * 
 */
    $whichpages = $this->uri->uri_string();
    $threesegments = $this->uri->total_segments();
    $segment2 = $this->uri->segment(2, 0);
    $thumb_path = ($segment2 == 'anuncio_premier'? 'large_premier': 'large_thumb');
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="<?=$this->lang->line('header_meta_desc')?>">
    <meta name="keywords" content="<?=$this->lang->line('header_meta_keywords')?>" />
    <meta name="author" content="<?=$this->lang->line('head_author')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="dS9XK3YzpisPF3MWtMN2s52Oj8y4w5EAiIaDx72x1HM" />
    <?php 
        if($posting){
            $listing_title = $posting['ad_marca'].' '.$posting['ad_modelo'].' - '.$posting['ad_year'];
        }
    ?>
    <?php if($posting): ?>
    <title><?=$this->lang->line('head_title')?> - <?=$listing_title?></title>
    <meta property="og:title" content="Carros506.com - <?=$listing_title?>" /> 
    <meta property="og:image" content="<?=base_url()?>cars/<?=$thumb_path?>/<?=strtolower($posting['ad_fullid'])?>/<?=strtolower($posting['ad_fullid'])?>_1.jpg" /> 
    <meta property="og:description" content="" />
    <meta property="og:type" content="Anuncio">
    <?php elseif(!$posting): ?>
    <title><?=$this->lang->line('head_title')?></title>
    <meta property="og:title" content="<?=$this->lang->line('head_title')?>" /> 
    <meta property="og:image" content="<?=base_url()?>images/carros506.jpg" /> 
    <meta property="og:description" content="<?=$this->lang->line('header_meta_desc')?>" />
    <?php endif; ?>
    <meta property="og:url" content="<?=current_url()?>">
    <meta property="og:locale" content="es_CR">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link media="screen" rel="stylesheet" href="/css/normalize.css" />
    <link media="screen" rel="stylesheet" href="/css/responsive.css" />
    <link media="screen" rel="stylesheet" href="/css/frame.css" />
    <link media="screen" rel="stylesheet" href="/css/format.css" />
    <link media="screen" rel="stylesheet" href="/css/common.css" />
    <?php
        
    ?>
    <?php   
        if(
                $whichpages == "site/index" ||
                $whichpages == FALSE ||
                $whichpages == "resultados/anuncios" ||
                $whichpages == "resultados/categorias" ||
                $whichpages == "resultados/agencia" ||
                $threesegments == 3 ||
                $threesegments == 4
        ): ?>
    <link media="screen" rel="stylesheet" href="/css/search_widget.css" />
    <?php endif; ?>
    <link media="screen" rel="stylesheet" href="/css/forms.css" />
    <link media="screen" rel="stylesheet" href="/css/<?php
        $load_page = $this->uri->segment(2, 0);
        if($load_page === 0){
            echo "index";
        }else{
            echo $load_page;
        }
    ?>.css" />
    <link media="screen" rel="stylesheet" href="/css/flick/jquery-ui-1.8.14.custom.css" />
    <link media="screen" rel="stylesheet" href="/css/slider/default/default.css" />
    <link media="screen" rel="stylesheet" href="/css/slider/nivo-slider.css" />
    <script src="/js/modernizr.js"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery_ui.js"></script>
    <script src="/js/jquery.sticky.js"></script>
    <?php
        if($whichpages == "site/index" || $whichpages == FALSE){
            $min_price_valid = ($minprice['ad_precio'] != "" ? $minprice['ad_precio'] : 100000 );
            $max_price_valid = ($maxprice['ad_precio'] != "" ? $maxprice['ad_precio'] : 1000000 );
            $min_year_valid = ($minyear['ad_year'] != "" ? $minyear['ad_year']: 1950);
            echo "<script>";
            echo "var requested = 'index';\n";
            echo "var minCarValue = ".$min_price_valid.";\n";
            echo "var maxCarValue = ".$max_price_valid.";\n";
            echo "var minyear = ".$min_year_valid.";\n";
            echo "var maxyear = ".date("Y").";\n";
            echo "</script>";
        }elseif($segment2 == "anuncios"){
            echo "<script>";
            echo "var requested = 'results';\n";
            if($this->input->post('minamount')){
                echo "var minCarValueReq = ".$this->input->post('minamount').";\n";
                echo "var maxCarValueReq = ".$this->input->post('maxamount').";\n";
                echo "var minyearReq = ".$this->input->post('yearstart').";\n";
                echo "var maxyearReq = ".$this->input->post('yearend').";\n";
            }elseif(!$this->input->post('minamount')){
                echo "var minCarValueReq = ".$_COOKIE['valueminamount'].";\n";
                echo "var maxCarValueReq = ".$_COOKIE['valuemaxamount'].";\n";
                echo "var minyearReq = ".$_COOKIE['valueyearstart'].";\n";
                echo "var maxyearReq = ".$_COOKIE['valueyearend'].";\n";
            }
            echo "var minCarValue = ".$minprice['ad_precio'].";\n";
            echo "var maxCarValue = ".$maxprice['ad_precio'].";\n";
            echo "var minyear = ".$minyear['ad_year'].";\n";
            echo "var maxyear = ".date("Y").";\n";
            echo "</script>";
        }elseif(
            $threesegments == 3 && $segment2 == "categorias" ||
            $segment2 == "vendedor" || $segment2 == "agencia" ||
            $threesegments == 4
            ){
            echo "<script>";
            echo "var requested = 'bycat';\n";
            echo "var minCarValue = ".$minprice['ad_precio'].";\n";
            echo "var maxCarValue = ".$maxprice['ad_precio'].";\n";
            echo "var minyear = ".$minyear['ad_year'].";\n";
            echo "var maxyear = ".date("Y").";\n";
            echo "</script>";
        }
    ?>
    <script src="/js/screen.js"></script>
    <script>
        var nativeScreenHeight = window.innerHeight;
        var whatDevice = handleOrientation();
            if(whatDevice.desktop){
                $(window).load(function(){
                    $(".mainNav").sticky({ topSpacing: 0, className: 'darkNav' });
                });
            }
    </script>
</head>

<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div id="overlay">
        <div style="text-align:center; background-color: #ffffff; width: 200px; margin: auto; border: solid 1px #000000; border-radius: 5px; box-shadow: 0px 0px 5px #000000;">
            <h2 style="border:none;"><?=$this->lang->line('body_processing')?></h2>
            <h5><?=$this->lang->line('body_please_wait')?></h5><br />
            <img src="/images/load_bar.png" alt="<?=$this->lang->line('body_processing')?>" style="display:inline;" /><br /><br />
        </div>
    </div>
    <div id="validateBubbleHeader">
        <span id="errorMessageHeader"></span>
        <span class="validateArrowHeader"></span>
    </div>
    <div id="validateBubble">
        <span id="errorMessage"></span>
        <span class="validateArrow"></span>
    </div>
    <header>
        <div class="innerHeader">
            <div class="loginBox">
                <h4><?=$this->lang->line('body_login')?></h4>
                <form method="post" action="/login/validate" id="loginForm" novalidate="novalidate">
                    <fieldset>
                        <label for="email"><?=$this->lang->line('label_email')?></label>
                        <input type="email" name="email" id="emailLogin" value="" placeholder="<?=$this->lang->line('placeholder_email')?>" data-error="<?=$this->lang->line('error_msg_email')?>" onclick="this.select();"/>
                        <label for="password"><?=$this->lang->line('label_password')?></label>
                        <input type="password" name="password" id="passwordLogin" value="" placeholder="<?=$this->lang->line('placeholder_hidden_password')?>" data-error="<?=$this->lang->line('error_msg_password')?>" onclick="this.select();"/>
                        <input type="submit" value="<?=$this->lang->line('body_login')?>" name="login" id="login" /><span id="login_failed"></span>
                    </fieldset>
                </form>
                <div>
                    <a href="/misc/pwd_reset"><?=$this->lang->line('body_forgot_pwd')?></a>
                    <a href="#" id="closeLogin"><?=$this->lang->line('body_close')?></a>
                </div>
            </div>
            <div class="registerBox">
                <h4><?=$this->lang->line('body_register')?></h4>
                <form method="post" action="/account/create" id="registerForm" novalidate="novalidate">
                    <fieldset>
                        <input type="text" name="name" id="nameRegister" value="" placeholder="<?=$this->lang->line('placeholder_name')?>" autocomplete="off" data-errorChar="<?=$this->lang->line('error_letters_only')?>" data-errorEmpty="<?=$this->lang->line('error_full_name')?>" onclick="this.select();"/>
                        <input type="email" name="email" id="emailRegister" value="" placeholder="<?=$this->lang->line('placeholder_email')?>" autocomplete="off" data-errorChar="<?=$this->lang->line('error_valid_email')?>" data-errorEmpty="<?=$this->lang->line('error_empty_email')?>" data-errorExist="<?=$this->lang->line('error_email_exist')?>" onclick="this.select();"/>
                        <input type="password" name="password" id="passwordRegister" value="" placeholder="<?=$this->lang->line('placeholder_password')?>" autocomplete="off" data-errorEmpty="<?=$this->lang->line('error_pwd_empty')?>" onclick="this.select();"/>
                        <input type="password" name="confirmPassword" id="confirmPassword" value="" placeholder="<?=$this->lang->line('placeholder_confirm_password')?>" autocomplete="off" data-errorEmpty="<?=$this->lang->line('error_pwd_empty')?>" data-errorMatch="<?=$this->lang->line('error_pwd_mismatch')?>" onclick="this.select();"/>
                        <input type="submit" value="<?=$this->lang->line('body_register')?>" name="register" id="register" disabled="disabled"/>
                    </fieldset>
                </form>
                <div>
                    <a href="/pages/terminos"><?=$this->lang->line('body_accept_terms')?></a>
                    <a href="#" id="closeRegister"><?=$this->lang->line('body_close')?></a>
                </div>
            </div>
            <div class="topLinks">
                <nav class="loginRegister">
                    <ul id="memberLinks">
                        <?php
                            $this->load->view('includes/member_links');
                        ?>
                        <li>
                            <div class="fb-share-button" data-href="<?=base_url()?>" data-type="button_count"></div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="logoBar">
                <div class="logoWrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="108.275px" height="70px" viewBox="0 0 108.275 70">
                        <path fill="none" d="M57.043 28.703c-2.086 0-3.844 0.76-5.272 2.279c-1.429 1.52-2.598 3.391-3.504 5.6 c-0.908 2.223-1.565 4.559-1.973 7.008c-0.409 2.448-0.613 4.604-0.613 6.463c0 2.7 0.5 4.7 1.5 6.1 c0.975 1.3 2.4 2 4.3 1.971c1.361 0 2.584-0.363 3.673-1.089c1.09-0.726 2.041-1.678 2.857-2.858 c0.816-1.179 1.53-2.526 2.143-4.047c0.613-1.52 1.102-3.072 1.464-4.66s0.635-3.141 0.815-4.66 c0.183-1.521 0.272-2.893 0.272-4.116C62.622 31.4 60.8 28.7 57 28.703z"/>
                        <path fill="none" d="M82.788 10.989c1.231 0 2.149-0.43 2.758-1.292c0.608-0.862 0.913-2.039 0.913-3.532s-0.305-2.67-0.913-3.532 C84.939 1.8 84 1.3 82.8 1.34s-2.151 0.431-2.759 1.293c-0.608 0.862-0.912 2.04-0.912 3.5 c0 1.5 0.3 2.7 0.9 3.532C80.637 10.6 81.6 11 82.8 10.989z"/>
                        <path fill="none" d="M23.248 10.585c0.308 0.2 0.6 0.3 1 0.323c0.37 0.1 0.7 0.1 1.1 0.1 c0.477 0 0.923-0.023 1.338-0.069c0.416-0.046 0.824-0.107 1.224-0.185v-4.41h0.001c-0.262-0.03-0.588-0.065-0.981-0.104 c-0.392-0.038-0.766-0.058-1.12-0.058c-1.154 0-2.047 0.216-2.678 0.646c-0.631 0.431-0.947 1.047-0.947 1.8 c0 0.5 0.1 0.9 0.3 1.223C22.69 10.2 22.9 10.4 23.2 10.585z"/>
                        <path fill="none" d="M92.287 40.473c-1.452 0-2.712 0.318-3.776 0.952c-1.065 0.636-1.95 1.486-2.653 2.6 c-0.705 1.065-1.226 2.258-1.564 3.571c-0.34 1.315-0.51 2.653-0.51 4.015c0 2.2 0.5 3.8 1.4 4.9 c0.95 1.1 2.3 1.6 4 1.599c1.451 0 2.744-0.352 3.879-1.055s2.086-1.621 2.857-2.756c0.771-1.134 1.359-2.392 1.768-3.775 c0.408-1.383 0.613-2.756 0.613-4.115c0-2.088-0.545-3.584-1.633-4.491C95.62 40.9 94.1 40.5 92.3 40.473z"/>
                        <path fill="#FFFFFF" d="M5.887 12.329c0.601 0 1.146-0.046 1.64-0.139c0.492-0.093 0.931-0.208 1.315-0.346 c-0.031-0.17-0.08-0.385-0.15-0.647c-0.069-0.262-0.142-0.47-0.219-0.624c-0.339 0.124-0.72 0.224-1.142 0.3 c-0.424 0.077-0.866 0.115-1.328 0.115c-1.354 0-2.429-0.388-3.221-1.166C1.989 9 1.6 7.8 1.6 6.2 c0-0.708 0.085-1.354 0.254-1.939s0.427-1.093 0.774-1.524C2.967 2.3 3.4 1.9 3.9 1.696C4.43 1.5 5 1.3 5.7 1.3 c0.538 0 1 0 1.5 0.115c0.47 0.1 0.9 0.2 1.2 0.277c0.062-0.153 0.12-0.361 0.174-0.623 c0.054-0.262 0.081-0.492 0.081-0.693C8.35 0.3 7.9 0.2 7.4 0.127C6.868 0 6.3 0 5.7 0 C4.787 0 4 0.2 3.2 0.473c-0.716 0.315-1.312 0.75-1.789 1.304C0.977 2.3 0.6 3 0.4 3.7 C0.123 4.5 0 5.3 0 6.164c0 2 0.5 3.5 1.5 4.583C2.501 11.8 4 12.3 5.9 12.329z"/>
                        <path fill="#FFFFFF" d="M21.921 11.475c0.823 0.6 2 0.9 3.4 0.854c0.692 0 1.423-0.054 2.193-0.162 c0.769-0.108 1.423-0.216 1.962-0.323V4.063c0-1.4-0.362-2.428-1.085-3.082S26.542 0 25 0c-0.616 0-1.216 0.042-1.801 0.1 c-0.585 0.085-1.078 0.189-1.478 0.312c0 0.2 0 0.5 0.1 0.738c0.054 0.3 0.1 0.5 0.2 0.6 c0.401-0.123 0.855-0.227 1.362-0.311c0.509-0.085 1.07-0.127 1.686-0.127c0.938 0 1.6 0.2 2.1 0.7 c0.477 0.5 0.7 1.2 0.7 2.228h0.001v0.716c-0.262-0.03-0.593-0.065-0.993-0.104c-0.401-0.038-0.877-0.058-1.432-0.058 c-0.708 0-1.359 0.085-1.951 0.254c-0.592 0.169-1.1 0.42-1.523 0.751c-0.424 0.331-0.754 0.739-0.993 1.2 c-0.238 0.484-0.358 1.034-0.358 1.65C20.686 10 21.1 10.9 21.9 11.475z M23.156 6.809c0.631-0.43 1.524-0.646 2.678-0.646 c0.354 0 0.7 0 1.1 0.058c0.393 0 0.7 0.1 1 0.104h-0.001v4.41c-0.4 0.078-0.808 0.139-1.224 0.2 c-0.415 0.046-0.861 0.069-1.338 0.069c-0.369 0-0.738-0.027-1.108-0.081c-0.37-0.054-0.708-0.162-1.016-0.323 c-0.308-0.163-0.558-0.397-0.75-0.705c-0.193-0.307-0.289-0.716-0.289-1.223C22.209 7.9 22.5 7.2 23.2 6.809z"/>
                        <path fill="#FFFFFF" d="M43.748 12.097c0.092 0 0.219-0.004 0.381-0.011c0.161-0.008 0.288-0.02 0.38-0.035V6.003 c0-1.539 0.316-2.64 0.947-3.302c0.631-0.661 1.469-0.992 2.516-0.992c0.077 0 0.1 0 0.2 0c0.07 0 0.2 0 0.3 0 c0.046-0.231 0.069-0.47 0.069-0.716c0-0.231-0.023-0.477-0.069-0.739c-0.108-0.015-0.205-0.023-0.289-0.023 c-0.085 0-0.166 0-0.243 0c-0.909 0-1.639 0.196-2.193 0.589c-0.554 0.392-0.985 0.874-1.293 1.443c0-0.308-0.008-0.651-0.023-1.028 s-0.038-0.704-0.069-0.981c-0.123-0.015-0.239-0.027-0.346-0.035c-0.107-0.007-0.223-0.011-0.346-0.011 c-0.107 0-0.219 0.004-0.334 0.011c-0.116 0.009-0.235 0.02-0.358 0.035h-0.001v11.774c0.093 0 0.2 0 0.4 0 C43.548 12.1 43.7 12.1 43.7 12.097z"/>
                        <path fill="#FFFFFF" d="M61.523 12.097c0.093 0 0.22-0.004 0.381-0.011c0.162-0.008 0.289-0.02 0.382-0.035V6.003 c0-1.539 0.315-2.64 0.946-3.302c0.631-0.661 1.47-0.992 2.517-0.992c0.077 0 0.2 0 0.2 0c0.07 0 0.2 0 0.3 0 c0.046-0.231 0.07-0.47 0.07-0.716c0-0.231-0.024-0.477-0.07-0.739c-0.106-0.015-0.204-0.023-0.289-0.023c-0.084 0-0.165 0-0.241 0 c-0.908 0-1.639 0.196-2.192 0.589c-0.556 0.392-0.985 0.874-1.294 1.443c0-0.308-0.008-0.651-0.022-1.028s-0.038-0.704-0.069-0.981 c-0.123-0.015-0.238-0.027-0.347-0.035c-0.108-0.007-0.222-0.011-0.346-0.011c-0.108 0-0.22 0.004-0.335 0 c-0.115 0.009-0.234 0.02-0.357 0.035h-0.003v11.774c0.093 0 0.2 0 0.4 0 C61.324 12.1 61.4 12.1 61.5 12.097z"/>
                        <path fill="#FFFFFF" d="M78.828 10.55c0.439 0.6 1 1 1.6 1.304c0.662 0.3 1.4 0.5 2.3 0.5 c0.877 0 1.644-0.158 2.297-0.475c0.655-0.315 1.201-0.75 1.64-1.304c0.438-0.554 0.769-1.208 0.993-1.962 c0.224-0.754 0.334-1.562 0.334-2.424c0-0.862-0.11-1.67-0.334-2.424c-0.224-0.754-0.555-1.408-0.993-1.962 c-0.439-0.554-0.986-0.989-1.64-1.304S83.665 0 82.8 0c-0.878 0-1.647 0.159-2.31 0.474c-0.66 0.315-1.211 0.75-1.65 1.3 c-0.438 0.554-0.764 1.208-0.98 1.962c-0.216 0.754-0.322 1.562-0.322 2.424c0 0.9 0.1 1.7 0.3 2.4 C78.062 9.3 78.4 10 78.8 10.55z M80.029 2.633c0.607-0.862 1.527-1.293 2.759-1.293s2.151 0.4 2.8 1.3 c0.608 0.9 0.9 2 0.9 3.532s-0.305 2.67-0.913 3.532c-0.608 0.862-1.526 1.292-2.758 1.292s-2.151-0.43-2.759-1.292 c-0.608-0.862-0.912-2.039-0.912-3.532C79.117 4.7 79.4 3.5 80 2.633z"/>
                        <path fill="#FFFFFF" d="M105.873 10.33c-0.539 0.408-1.27 0.612-2.191 0.612c-0.494 0-1.01-0.049-1.549-0.15 c-0.537-0.099-0.977-0.219-1.314-0.357c-0.2 0.461-0.346 0.923-0.44 1.384c0.354 0.2 0.8 0.3 1.4 0.4 c0.578 0.1 1.2 0.1 2 0.139c0.661 0 1.271-0.085 1.824-0.254c0.554-0.169 1.032-0.411 1.431-0.727 c0.4-0.316 0.712-0.7 0.936-1.155c0.224-0.454 0.336-0.959 0.336-1.512c0-0.6-0.112-1.1-0.336-1.5 c-0.223-0.4-0.506-0.731-0.854-0.993c-0.346-0.261-0.73-0.473-1.152-0.635c-0.425-0.161-0.845-0.312-1.259-0.45 c-0.323-0.092-0.628-0.192-0.911-0.3c-0.287-0.108-0.539-0.235-0.765-0.381c-0.222-0.147-0.397-0.323-0.528-0.531 c-0.133-0.208-0.197-0.458-0.197-0.75c0-0.538 0.197-0.973 0.588-1.304c0.394-0.331 1.06-0.497 1.998-0.497 c0.539 0 1.1 0.1 1.6 0.162c0.499 0.1 0.9 0.2 1.2 0.323c0.139-0.43 0.246-0.869 0.324-1.316 c-0.311-0.122-0.744-0.238-1.306-0.346C106.109 0.1 105.5 0 104.9 0c-1.432 0-2.49 0.293-3.177 0.9 c-0.685 0.586-1.026 1.348-1.026 2.286c0 0.5 0.1 0.9 0.3 1.27c0.177 0.3 0.4 0.6 0.7 0.9 c0.293 0.2 0.6 0.4 1 0.588c0.377 0.2 0.8 0.3 1.1 0.416c0.354 0.1 0.7 0.2 1 0.4 c0.338 0.1 0.6 0.3 0.9 0.45s0.484 0.4 0.6 0.681s0.242 0.6 0.2 1.027C106.682 9.4 106.4 9.9 105.9 10.33z"/>
                        <path fill="#FFFFFF" d="M12.314 21.082l-5.58 26.331l1.021 1.021c1.451-0.635 2.766-1.099 3.946-1.396 c1.179-0.294 2.426-0.44 3.742-0.44c2.493 0 4.4 0.5 5.7 1.529c1.314 1 2 2.5 2 4.4 c0 1.588-0.352 2.949-1.055 4.082c-0.703 1.135-1.61 2.075-2.721 2.824c-1.112 0.748-2.359 1.293-3.742 1.6 c-1.384 0.34-2.733 0.51-4.048 0.51c-1.632 0-3.175-0.17-4.626-0.51c-1.452-0.34-2.971-0.806-4.558-1.396 c-0.636 1.36-1.135 2.745-1.497 4.149C0.521 65.2 0.2 66.6 0 67.891c1.949 0.8 3.9 1.3 5.9 1.6 C7.801 69.8 9.5 70 11 70c3.13 0 6.065-0.454 8.808-1.361c2.744-0.908 5.148-2.19 7.212-3.846 c2.064-1.654 3.685-3.662 4.865-6.021c1.179-2.357 1.769-4.988 1.769-7.892c0-1.677-0.306-3.243-0.918-4.694 c-0.612-1.451-1.463-2.709-2.551-3.775c-1.088-1.064-2.381-1.893-3.878-2.482s-3.153-0.885-4.966-0.885 c-0.772 0-1.406 0.034-1.905 0.102c-0.5 0.068-1.134 0.172-1.905 0.308l2.177-10.07h14.9c0.453-1.497 0.805-2.914 1.055-4.252 c0.249-1.337 0.374-2.687 0.374-4.048H12.314z"/>
                        <path fill="#FFFFFF" d="M69.085 24.89c-1.224-1.451-2.778-2.561-4.66-3.333c-1.883-0.771-4.094-1.157-6.633-1.157 c-2.586 0-4.912 0.443-6.975 1.327c-2.064 0.884-3.912 2.075-5.544 3.572c-1.633 1.497-3.04 3.231-4.219 5.2 c-1.179 1.974-2.166 4.049-2.959 6.227c-0.794 2.177-1.372 4.377-1.735 6.6c-0.363 2.223-0.544 4.354-0.544 6.4 c0 5.1 1.2 9.2 3.6 12.11c2.404 3 6.1 4.4 11.2 4.423c2.54 0 4.853-0.432 6.94-1.294 c2.087-0.86 3.946-2.028 5.58-3.503c1.633-1.475 3.05-3.188 4.252-5.137c1.201-1.95 2.188-4.004 2.959-6.158 c0.77-2.154 1.35-4.355 1.734-6.6c0.386-2.246 0.578-4.389 0.578-6.43c0-2.585-0.295-4.91-0.885-6.974 C71.217 28.1 70.3 26.3 69.1 24.89z M62.35 40.779c-0.181 1.52-0.453 3.072-0.815 4.66s-0.851 3.141-1.464 4.7 c-0.612 1.521-1.326 2.868-2.143 4.047c-0.816 1.181-1.768 2.133-2.857 2.858c-1.089 0.726-2.312 1.089-3.673 1.1 c-1.86 0-3.278-0.656-4.253-1.971c-0.976-1.316-1.463-3.334-1.463-6.057c0-1.859 0.204-4.015 0.613-6.463 c0.408-2.449 1.065-4.785 1.973-7.008c0.906-2.223 2.075-4.094 3.504-5.614c1.428-1.519 3.186-2.279 5.272-2.279 c3.719 0 5.6 2.7 5.6 7.96C62.622 37.9 62.5 39.3 62.4 40.779z"/>
                        <path fill="#FFFFFF" d="M104.838 35.643c-1.066-1.043-2.324-1.826-3.777-2.348c-1.449-0.521-3.016-0.783-4.693-0.783 c-2.494 0-4.536 0.42-6.123 1.258c-1.587 0.84-2.788 1.667-3.605 2.484c0.772-2.222 1.814-4.104 3.131-5.647 c1.314-1.541 2.834-2.789 4.559-3.742c1.722-0.952 3.617-1.643 5.681-2.075c2.063-0.43 4.252-0.646 6.565-0.646 c0.089-0.634 0.179-1.269 0.271-1.905c0.09-0.635 0.137-1.292 0.137-1.973c0-0.681-0.047-1.361-0.137-2.041 c-0.093-0.681-0.227-1.383-0.408-2.11v-0.001h-1.021c-4.989 0-9.446 0.999-13.368 2.994c-3.925 1.997-7.244 4.627-9.967 7.9 s-4.798 6.964-6.227 11.09c-1.43 4.128-2.144 8.323-2.144 12.587c0 5.2 1.2 9.1 3.6 11.7 c2.426 2.6 6 3.9 10.6 3.91c3.039 0 5.806-0.556 8.3-1.666c2.495-1.111 4.626-2.631 6.396-4.559 c1.768-1.928 3.14-4.174 4.115-6.736c0.977-2.562 1.463-5.273 1.463-8.131c0-2.13-0.306-3.99-0.918-5.578 C106.742 38 105.9 36.7 104.8 35.643z M97.729 50.439c-0.408 1.384-0.996 2.642-1.768 3.8 c-0.771 1.135-1.723 2.053-2.857 2.756s-2.428 1.055-3.879 1.055c-1.724 0-3.062-0.532-4.012-1.599 c-0.954-1.065-1.43-2.687-1.43-4.864c0-1.361 0.17-2.699 0.51-4.015c0.339-1.313 0.859-2.506 1.564-3.571 c0.703-1.065 1.588-1.916 2.653-2.552c1.064-0.634 2.324-0.952 3.776-0.952c1.859 0 3.3 0.5 4.4 1.4 c1.088 0.9 1.6 2.4 1.6 4.491C98.342 47.7 98.1 49.1 97.7 50.439z"/>
                    </svg>
                </div>
                <div class="postedAds">
                    <h6><?=$this->lang->line('body_posted_ads').$this->session->userdata('total_ads')?></h6>
                </div>
            </div>
        </div>
    </header>
    <nav class="mainNav">
        <div class="navWrapper">
        <ul class="mainNavLinks">
            <li>
                <a href="/site/index"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <polygon fill="none" points="4.5,6.3 4.5,13.5 7.5,13.5 7.5,10.5 9.5,10.5 9.5,13.5 12.5,13.5 12.5,6.3 8.5,3.5"/>
                        <path fill="#FFFFFF" d="M8 0L0 8h2v8h12V8h2L8 0z M12 14H9v-3H7v3H4V6.828L8 4l4 2.828V14z"/>
                    </svg> <?=$this->lang->line('nav_main_home')?></a>
            </li>
            <li id="searchBy" class="hidden-phone">
                <a href="/resultados/categorias">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g>
                            <path fill="#FFFFFF" d="M10.001 0C13.314 0 16 2.7 16 6c0 3.315-2.686 6-5.999 6C6.687 12 4 9.3 4 6C4 2.7 6.7 0 10 0 M10.001 2C7.795 2 6 3.8 6 6c0 2.2 1.8 4 4 4C12.206 10 14 8.2 14 6C14 3.8 12.2 2 10 2L10.001 2z"/>
                        </g>
                        <rect x="0.3" y="10" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -7.314 6.3437)" fill="#FFFFFF" width="7.3" height="4"/>
                    </svg>
                    <?=$this->lang->line('nav_main_category')?>
                    <span style="color:#3B6083;">&#9660;</span>
                </a>
                <ul class="subItem" id="subItemMenu">
                    <li class="subItemLink">
                        <a href="#"><?=$this->lang->line('nav_cat_make')?></a>
                        <?php if($allmakes): ?>
                            <ul class="subItemNested" id="nestedMake">
                                <?php foreach($allmakes as $allmakes_row): ?>
                                    <li class="nestedLink">
                                        <a href="/resultados/categorias/marca_<?php echo str_replace(" ", "_", $allmakes_row->ad_marca); ?>"><?php echo $allmakes_row->ad_marca; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <li class="subItemLink">
                        <a href="#"><?=$this->lang->line('nav_cat_body')?></a>
                        <ul class="subItemNested" id="nestedCarroceria">
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_sedan"><?=$this->lang->line('nav_body_sedan')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_station"><?=$this->lang->line('nav_body_sw')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_suv"><?=$this->lang->line('nav_body_suv')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_hatchback"><?=$this->lang->line('nav_body_hb')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_minivan"><?=$this->lang->line('nav_body_mv')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_coupe"><?=$this->lang->line('nav_body_coupe')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_convertible"><?=$this->lang->line('nav_body_convert')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_deportivo"><?=$this->lang->line('nav_body_sport')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_pickup"><?=$this->lang->line('nav_body_pickup')?></a>
                            </li>
                            
                            <li class="nestedLink">
                                <a href="/resultados/categorias/carroceria_van"><?=$this->lang->line('nav_body_van')?></a>
                            </li>
                        </ul>
                    </li>
                    <li class="subItemLink">
                        <a href="#"><?=$this->lang->line('nav_cat_engine')?></a>
                        <ul class="subItemNested" id="nestedMotor">
                            <li class="nestedLink">
                                <a href="/resultados/categorias/motor_4"><?=$this->lang->line('nav_engine_4')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/motor_6"><?=$this->lang->line('nav_engine_6')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/motor_8"><?=$this->lang->line('nav_engine_8')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/motor_10"><?=$this->lang->line('nav_engine_10')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/motor_12"><?=$this->lang->line('nav_engine_12')?></a>
                            </li>
                        </ul>
                    </li>
                    <li class="subItemLink">
                        <a href="#"><?=$this->lang->line('nav_cat_transmision')?></a>
                        <ul class="subItemNested" id="nestedTransmision">
                            <li class="nestedLink">
                                <a href="/resultados/categorias/transmision_manual"><?=$this->lang->line('nav_trans_manual')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/transmision_automatico"><?=$this->lang->line('nav_trans_aut')?></a>
                            </li>
                        </ul>
                    </li>
                    <li class="subItemLink">
                        <a href="#"><?=$this->lang->line('nav_cat_province')?></a>
                        <ul class="subItemNested" id="nestedProvincia">
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_sanjose"><?=$this->lang->line('nav_province_sanjose')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_alajuela"><?=$this->lang->line('nav_province_alajuela')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_heredia"><?=$this->lang->line('nav_province_heredia')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_cartago"><?=$this->lang->line('nav_province_cartago')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_puntarenas"><?=$this->lang->line('nav_province_puntarenas')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_limon"><?=$this->lang->line('nav_province_limon')?></a>
                            </li>
                            <li class="nestedLink">
                                <a href="/resultados/categorias/location_guanacaste"><?=$this->lang->line('nav_province_guanacaste')?></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="hidden-phone">
                <a href="/resultados/aduanas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="16px" viewBox="0 0 12 16"><g><path fill="#FFFFFF" d="M12 10.502c-0.364 1.48-1.021 2.625-1.969 3.432c-0.977 0.838-2.193 1.252-3.651 1.238H6.185L5.956 16H4.62 l0.269-0.973c-0.438-0.088-0.846-0.209-1.223-0.361L3.306 16H1.972l0.546-2.002C0.84 12.7 0 10.7 0 7.8 C0 5.8 0.5 4.1 1.6 2.821c1.112-1.334 2.621-2.033 4.529-2.097L6.352 0h1.334L7.462 0.8C7.87 0.9 8.3 1 8.7 1.1 L9 0h1.334l-0.49 1.792c0.921 0.7 1.6 1.7 1.9 3.002L10 5.223C9.815 4.6 9.6 4.1 9.3 3.737L6.629 13.6 c1.921-0.158 3.112-1.338 3.576-3.535L12 10.502z M5.713 2.344C4.399 2.5 3.4 3.1 2.7 4.2 c-0.592 0.947-0.889 2.163-0.889 3.65c0 1.8 0.4 3.3 1.2 4.277L5.713 2.344z M8.252 2.7 C7.906 2.5 7.5 2.4 7 2.354l-2.936 10.71c0.364 0.2 0.8 0.4 1.2 0.438L8.252 2.745z"/></g></svg>
                    <?=$this->lang->line('nav_main_customs')?>
                </a>
            </li>
            <!--<li class="hidden-phone">
                <a href="/resultados/subasta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16"><path fill="#FFFFFF" d="M16 6.639V0H9.361L0 9.359h6.639V16L16 6.639z M10.439 3.656c0-1.051 0.852-1.903 1.901-1.903 s1.902 0.9 1.9 1.903s-0.853 1.902-1.902 1.902S10.439 4.7 10.4 3.656z"/></svg>
                    <?=$this->lang->line('nav_main_auction')?>
                </a>
            </li>-->
            <li class="hidden-phone">
                <a href="/site/agencias">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <circle fill="none" cx="11" cy="5" r="1"/>
                        <path fill="#FFFFFF" d="M11 0C8.238 0 6 2.2 6 5c0 0.3 0 0.6 0.1 0.908L0 12v4h6v-2h2v-2h2v-2l0.092-0.092 C10.387 10 10.7 10 11 10c2.762 0 5-2.238 5-5S13.762 0 11 0z M11.004 6c-0.553 0-1-0.447-1-1s0.447-1 1-1s1 0.4 1 1 S11.557 6 11 6z"/>
                    </svg> 
                    <?=$this->lang->line('nav_main_dealers')?>
                </a>
            </li>
            <li class="hidden-phone">
                <a href="/site/anunciese">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <path fill="#FFFFFF" d="M16 4c0-2.208-1.793-4-4-4c-1.491 0-2.779 0.829-3.467 2.041C8.352 2 8.2 2 8 2 c-3.312 0-6 2.686-6 6c0 1.3 0.4 2.4 1.1 3.399L0 16l4.645-3.032c0.957 0.6 2.1 1 3.3 1.017c3.314 0 6-2.686 6-6 c0-0.173-0.034-0.334-0.051-0.504C15.16 6.8 16 5.5 16 4z M7.984 11.984c-2.206 0-4-1.795-4-4c0-2.206 1.794-4 4-4 c0.008 0 0 0 0 0.002c0-0.004 0.002-0.007 0.002-0.01C8.002 4 8 4 8 4c0 0.3 0.1 0.7 0.1 1 L6.555 6.586c-0.781 0.781-0.781 2 0 2.828c0.781 0.8 2 0.8 2.8 0l1.57-1.57c0.33 0.1 0.7 0.2 1 0.2 C11.977 10.2 10.2 12 8 11.984z M12 6c-1.102 0-2-0.897-2-2s0.898-2 2-2s2 0.9 2 2S13.102 6 12 6z"/>
                    </svg> 
                    <?=$this->lang->line('nav_main_ads')?>
                </a>
            </li>
            <li class="hidden-phone">
                <a href="/site/publicidad">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <path fill="#FFFFFF" d="M10.805 0H0v16l3.988-3.32L7.996 16L12 12.686L16 16V5.15L10.805 0z M9 7V2l5 5H9z"/>
                    </svg>
                    <?=$this->lang->line('nav_main_advertising')?>
                </a>
            </li>
            
        </ul>
        <ul class="myAccountWrapper">
            <li id="myAccount">
                <a href='/profile/dashboard'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="16px" viewBox="0 0 12 16"><path fill="#FFFFFF" d="M6 8c-3.312 0-6 2.686-6 6c0 1.1 0.9 2 2 2h8c1.105 0 2-0.896 2-2C12 10.7 9.3 8 6 8z"/><circle fill="#FFFFFF" cx="6" cy="3" r="3"/></svg> 
                    <?=$this->lang->line('nav_main_account')?>
                </a>
                <ul class="subItem" id="myAccountMenu">
                    <li class="subItemLink">
                        <a href="/profile/myads"><?=$this->lang->line('nav_account_myads')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/expired"><?=$this->lang->line('nav_account_expired')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/reported"><?=$this->lang->line('nav_account_reported')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/mymessages"><?=$this->lang->line('nav_account_mymsgs')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/favorites"><?=$this->lang->line('nav_account_myfavs')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/member"><?=$this->lang->line('nav_account_myprofile')?></a>
                    </li>
                    <li class="subItemLink">
                        <a href="/profile/choose_ad"><?=$this->lang->line('nav_account_newad')?></a>
                    </li>
                </ul>
            </li>
            <!--<li><a href="#">{elapsed_time}</a></li>-->
        </ul>
        </div>
    </nav>
