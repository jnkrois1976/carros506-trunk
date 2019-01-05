	<?php $this->load->view('includes/header'); ?>
	<section class="mecanicos">
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pages_mechanic_header')?></h1>
				<div class="leftWrapper">
                    <p>
                        <h5>Este servicio todav&iacute;a no esta disponible.</h5> <br />
                         
                    </p>
                </div>
                <?php $this->load->view('includes/advertisement'); ?>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>