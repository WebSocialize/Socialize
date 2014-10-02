<?php /* Smarty version 2.6.26, created on 2014-01-09 13:46:35
         compiled from registrato_main.tpl */ ?>
<script type="text/javascript" src="templates/template/js/validation.js"></script>
<div class="slider">

					<div class="title">
						I tre eventi in evidenza!
					</div>
					<img src="templates/template/images/<?php echo $this->_tpl_vars['evento0']['idimg']; ?>
"  class="left sliderimage">
					<div class="sfondoimmagine"> </div>
					<div class="items right">
						<div class="item opened yellow" id="0" onClick="consultaSezione(this.id)">
							<h3 id="ev0" name="<?php echo $this->_tpl_vars['evento0']['nome']; ?>
"><?php echo $this->_tpl_vars['evento0']['nome']; ?>
</h3>
							<p>Data: <?php echo $this->_tpl_vars['evento0']['data']; ?>
</p>
							<a id="0" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: <?php echo $this->_tpl_vars['evento0']['citta']; ?>
 </p>
							<p>Luogo: <?php echo $this->_tpl_vars['evento0']['luogo']; ?>
 </p>
							<p class="wordwrap">Descrizione: <?php echo $this->_tpl_vars['evento0']['descrizione']; ?>
 </p>
							<p class="clickable profile" id="00">Organizzatore: <?php echo $this->_tpl_vars['org0']['nome']; ?>
 <?php echo $this->_tpl_vars['org0']['cognome']; ?>
</p>
							<p>Partecipazioni: <?php echo $this->_tpl_vars['evento0']['numVisite']; ?>
 </p>
							
							
							<form method="post" id="gotoprof0">
   							 <input type="hidden" name="nomeevento" value="<?php echo $this->_tpl_vars['evento0']['nome']; ?>
" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>

   							<form method="post"  id="gotoprof00">
							<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['org0']['email']; ?>
" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>
							
							<img src="templates/template/images/<?php echo $this->_tpl_vars['evento0']['idimg']; ?>
" class="hide"> 
					
						</div>
					
						<div class="item closed orange" id="1" onClick="consultaSezione(this.id)">
							<h3 id="ev1" name="<?php echo $this->_tpl_vars['evento1']['nome']; ?>
"><?php echo $this->_tpl_vars['evento1']['nome']; ?>
</h3>				
							<p>Data: <?php echo $this->_tpl_vars['evento1']['data']; ?>
</p>
							<a id="1" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: <?php echo $this->_tpl_vars['evento1']['citta']; ?>
 </p>
							<p>Luogo: <?php echo $this->_tpl_vars['evento1']['luogo']; ?>
 </p>
							<p class="wordwrap">Descrizione: <?php echo $this->_tpl_vars['evento1']['descrizione']; ?>
 </p>
							<p class="clickable profile" id="11">Organizzatore: <?php echo $this->_tpl_vars['org1']['nome']; ?>
 <?php echo $this->_tpl_vars['org1']['cognome']; ?>
</p>
							<p>Partecipazioni: <?php echo $this->_tpl_vars['evento1']['numVisite']; ?>
 </p>
							
							<form method="post" id="gotoprof1">
							 <input type="hidden" name="nomeevento" value="<?php echo $this->_tpl_vars['evento1']['nome']; ?>
" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>
   							<form method="post"  id="gotoprof11">
							<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['org1']['email']; ?>
" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>
							<img src="templates/template/images/<?php echo $this->_tpl_vars['evento1']['idimg']; ?>
" class="hide">
				   </form>
						</div>

						<div class="item closed red" id="2" onClick="consultaSezione(this.id)">
							<h3 id="ev2" name="<?php echo $this->_tpl_vars['evento2']['nome']; ?>
"><?php echo $this->_tpl_vars['evento2']['nome']; ?>
</h3>
							<p>Data: <?php echo $this->_tpl_vars['evento2']['data']; ?>
</p>
							<a id="2" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: <?php echo $this->_tpl_vars['evento2']['citta']; ?>
 </p>
							<p>Luogo: <?php echo $this->_tpl_vars['evento2']['luogo']; ?>
 </p>
							<p class="wordwrap">Descrizione: <?php echo $this->_tpl_vars['evento2']['descrizione']; ?>
 </p>
							<p class="clickable profile" id="22">Organizzatore: <?php echo $this->_tpl_vars['org2']['nome']; ?>
 <?php echo $this->_tpl_vars['org2']['cognome']; ?>
</p>
							<p>Partecipazioni: <?php echo $this->_tpl_vars['evento2']['numVisite']; ?>
 </p>
							
							
							<form method="post" id="gotoprof2">
							<input type="hidden" name="nomeevento" value="<?php echo $this->_tpl_vars['evento2']['nome']; ?>
" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>

   							<form method="post"  id="gotoprof22">
							<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['org2']['email']; ?>
" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>

							<img src="templates/template/images/<?php echo $this->_tpl_vars['evento2']['idimg']; ?>
" class="hide">
						</div>
					</div>
					<div class="cb"></div>
				</div>