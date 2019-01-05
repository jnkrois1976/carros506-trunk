<footer>
		<div class="innerFooter">
			<div class="resources">
				<div class="footerBox">
                    <h4><?=$this->lang->line('footer_resources')?></h4>
                    <ul>
                        <li><a href="#" onclick="window.open('http://www.hacienda.go.cr/autohacienda/AutoConsulta.aspx');" class="plainLink"><?=$this->lang->line('footer_link_transfers')?></a><img src="/images/new_window.png" /></li>
                        <li><a href="#" onclick="window.open('http://www.rtv.co.cr/');" class="plainLink"><?=$this->lang->line('footer_link_riteve')?></a><img src="/images/new_window.png" /></li>
                        <li><a href="#" onclick="window.open('http://portal.ins-cr.com/marchamo/Marchamo/frmConsultaMarchamo.aspx')" class="plainLink"><?=$this->lang->line('footer_link_permit')?></a><img src="/images/new_window.png" /></li>
                        <li><a href="#" onclick="window.open('http://portal.ins-cr.com/portal.ins-cr.com/Personas/SegurosPa/VoluntarioAutomoviles/');" class="plainLink"><?=$this->lang->line('footer_link_insurance')?></a><img src="/images/new_window.png" /></li>
                        <li><a href="#" onclick="window.open('http://www.hacienda.go.cr/autohacienda/autovalor.aspx');" class="plainLink"><?=$this->lang->line('footer_link_taxes')?></a><img src="/images/new_window.png" /></li>
                    </ul>
                </div>
                <div class="footerBox">
                    <h4><?=$this->lang->line('footer_advise')?></h4>
                    <ul>
                        <li><a href="/pages/consejos" class="plainLink"><?=$this->lang->line('footer_link_buyused')?></a></li>
                        <li><a href="/pages/mecanicos" class="plainLink"><?=$this->lang->line('footer_link_ask')?></a></li>
                        <li><a href="/pages/compare" class="plainLink"><?=$this->lang->line('footer_link_newvsused')?></a></li>
                        <li><a href="/pages/mantenimiento" class="plainLink"><?=$this->lang->line('footer_link_maintenance')?></a></li>
                        <li><a href="/pages/taller" class="plainLink"><?=$this->lang->line('footer_link_taller')?></a></li>
                    </ul>
                </div>
                <div class="footerBox">
                    <h4><?=$this->lang->line('footer_about')?></h4>
                    <ul>
                        <li><a href="/pages/acerca" class="plainLink"><?=$this->lang->line('footer_link_who')?></a></li>
                        <li><a href="/pages/privacidad" class="plainLink"><?=$this->lang->line('footer_link_privacy')?></a></li>
                        <li><a href="/pages/terminos" class="plainLink"><?=$this->lang->line('footer_link_terms')?></a></li>
                        <li><a href="/pages/contactenos" class="plainLink"><?=$this->lang->line('footer_link_contact')?></a></li>
                        <li><a href="/pages/preguntas" class="plainLink"><?=$this->lang->line('footer_link_faq')?></a></li>
                    </ul>
                </div>
			</div>
			<div class="copy">
				<?=$this->lang->line('footer_copyright')?> 
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="/js/ajax.js"></script>
	<script>
	    var getContentHeight = document.getElementsByTagName('section')[0];
	    var contentHeight = getContentHeight.clientHeight;
	    var setContentheight = nativeScreenHeight - 372;
	    if(contentHeight < setContentheight){
	        getContentHeight.style.height = setContentheight + "px";
	    }
	</script>
</body>
</html>