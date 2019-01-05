	<?php $this->load->view('includes/header'); ?>
	<section class="consejos">
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pages_advise_header')?></h1>
				<div class="leftWrapper">
                    <h5>Detalles importantes antes de comprar un carro usado</h5>
                    <ul>
                        <li>Decidir qué marca y modelo.</li>
                        <li>Investigue el precio de venta con <a href="#" onclick="window.open('http://www.hacienda.go.cr/autohacienda/Autovalor.aspx')" class="plainDarkLink">Autovalor</a></li>
                        <li>Averigüe cuánto le costaría a la financiación del vehículo.</li>
                        <li>Averigüe cuánto costaría asegurar el vehículo.</li>
                        <li>Investigue el historial del vehículo prospectivo utilizando los recursos en línea e impresos.</li>
                        <li>Entrevistar a los posibles vendedores antes de reunirse con ellos en persona.</li>
                        <li>Fije una cita durante el día.</li>
                        <li>Antes de la prueba de manejo, comprobar el chasis, motor y carrocería por corrosión o daños.</li>
                        <li>Revise el interior de la limpieza, la comodidad y el tamaño.</li>
                        <li>Inspeccione los neumáticos por desgaste.</li>
                        <li>Revise el aceite para el nivel adecuado y el color.</li>
                        <li>Revise el líquido refrigerante y el radiador de fugas o corrosión.</li>
                        <li>Conducir en la carretera para medir la aceleración y manejo.</li>
                        <li>Pruebe los frenos.</li>
                        <li>Comprobación de la dirección y alineación.</li>
                        <li>Practique parquearse para la maniobrabilidad y las líneas de visión.</li>
                        <li>Después de la prueba, inspeccione el motor en busca de fugas, olores o humo.</li>
                        <li>Solicitar y revisar los registros de servicio, recibos y el título.</li>
                        <li>Haga un especialista o un mecánico inspeccione el carro.</li>
                    </ul>
                    <hr />
                    <h5>Preguntas importantes para el vendedor</h5>
                    <ul>
                        <li>¿Por qué está vendiendo el carro? </li>
                        <li>¿Cuántas millas marca el odómetro? </li>
                        <li>¿Cuál es la condición del vehículo? </li>
                        <li>¿Tiene el carro alguna característica especial? </li>
                        <li>¿Es usted el propietario original? </li>
                        <li>¿Ha estado el carro implicado en un accidente? </li>
                        <li>¿Tiene registros de servicio? </li>
                    </ul>
                </div>
                <?php $this->load->view('includes/advertisement'); ?>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>