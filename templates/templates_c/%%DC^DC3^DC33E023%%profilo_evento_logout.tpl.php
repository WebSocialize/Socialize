<?php /* Smarty version 2.6.26, created on 2014-01-09 16:08:44
         compiled from profilo_evento_logout.tpl */ ?>
<div class="slider">
					
					    <img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['idimg']; ?>
" class="left sliderimage">			
					    <div class="items right">
						    <div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">
							    <h3>INFORMAZIONI</h3>
							    <p>Nome: <?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
</p>
							   	<p>Luogo:<?php echo $this->_tpl_vars['Informazioni']['luogo']; ?>
</p>
							    <p>Data: <?php echo $this->_tpl_vars['Informazioni']['data']; ?>
</p>
							    <p>Categoria: <?php echo $this->_tpl_vars['Informazioni']['categoria']; ?>
</p>
							    <p class="wordwrap">Descrizione: <?php echo $this->_tpl_vars['Informazioni']['descrizione']; ?>
</p>
								<img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['idimg']; ?>
" class="hide">
                        	</div>
                        	<div class="item closed orange" id="orange" onClick="consultaSezione(this.id)">
                            	<h3>PARTECIPAZIONI</h3>
                             	<p>Numero partecipanti: <?php echo $this->_tpl_vars['Informazioni']['numVisite']; ?>
</p>
                              	<img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['idimg']; ?>
" class="hide">
							</div>
							<div class="comments red">
                            	<h3>COMMENTI</h3>
                            	<p>Devi accedere per visualizzare o inserire commenti</p>
                            </div>
                  		</div>
					<div class="cb"></div>
</div>