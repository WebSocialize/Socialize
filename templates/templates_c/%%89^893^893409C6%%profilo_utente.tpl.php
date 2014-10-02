<?php /* Smarty version 2.6.26, created on 2014-01-09 17:14:33
         compiled from profilo_utente.tpl */ ?>
<script type="text/javascript" src="templates/template/js/validation.js"></script>  
<script type="text/javascript" src="templates/template/js/datepicker.js"></script>
<script type="text/javascript" src="templates/template/js/CComunicazione.js"></script>
<script type="text/javascript" src="templates/template/js/CRegistrazione.js"></script>

<div class="slider">
					
					<img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['immprofilo']; ?>
" class="left sliderimage">
				
					<div class="items right">
						
						<div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">

							<?php if ($this->_tpl_vars['amministratore']): ?><button class="right" id="del_profilo" >Elimina utente</button>
                                  <div id="dialog-delprofilo" title="ELIMINA PROFILO" style="display:none">
                                  <form id="form_delprofilo">
                                  <p> Eliminare Questo profilo? </p>
                                   <input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['Informazioni']['email']; ?>
" />
                                   </form>
                                  </div>


						<?php endif; ?>
						<?php if ($this->_tpl_vars['mioprofilo']): ?>
                     <button class="right" id="mod_profilo">Modifica dati</button>
						           
						           <div id="dialog-modprofilo" title="MODIFICA PROFILO" style="display:none">
									<p class="under">Tutti i campi sono richiesti</p><br>
									<form id="form_modprofilo" enctype="multipart/form-data" >
										<p>Città<br><select name="citta" id="user_citta"></select></p>

			       					 <p>Data<br><input type="text" name="data" value="<?php echo $this->_tpl_vars['Informazioni']['data']; ?>
" id="datepicker2" /></p>
								     
								     <p>Interessi<br><div id="user_int"> </div>
										<div id="immagprof">
			                            <p id="result"></p>
			                            Foto: <input name="fileToUpload2" type="file" id="fileToUpload2" />


			                         </div>
								     <input type="hidden" name="task" value="modificaUtente"/>
                                             
									</form>
									</div>

                     <button class="right" id="mod_password">Cambia password</button>
						           
						           <div id="dialog-modpassword" title="MODIFICA PASSWORD" style="display:none">
									<p class="under">Tutti i campi sono richiesti</p><br>
									
									<form id="form_modpassword">
									<p>Vecchia password<br>
                                    <input type="password" name="old_password" id="old_pwd" /></p>  
								    <p>Nuova password<br>
                                 	<input type="password" name="new_password" id="new_pwd"/> </p>
                               		<p> Conferma nuova password<br>
                                	<input type="password" name="new_password_conf" id="new_pwd_conf"/> </p>
								     <input type="hidden" name="task" value="modifica_password"/>
									</form>

									</div>
					   <?php else: ?>
					  <button class="right" id="invioemail">Invia email</button>
					     <div id="dialog-invioemail" title="CONTATTA <?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
 <?php echo $this->_tpl_vars['Informazioni']['cognome']; ?>
" style="display:none">
									<p class="under">Tutti i campi sono richiesti</p><br>
									<form id="form_invioemail">

			       					 <p>Oggetto<br><input type="text" name="oggetto" id="oggetto" /></p>
			       					  <p>Messaggio</p>
			       	   <textarea cols=60 rows=20 name="messaggio" id ="messaggio" maxlength=1000 placeholder="Inserisci qui il tuo messaggio..."></textarea>
                                   <input type="hidden" name="destinatario" value="<?php echo $this->_tpl_vars['Informazioni']['email']; ?>
"/>
								    <input type="hidden" name="controller" value="comunicazione"/>
                                    <input type="hidden" name="task" value="messaggio_email"/>
			                         </form>
			                         </div>


						<?php endif; ?>
							<h3>Informazioni</h3>

 									<p>Nome: <?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
</p>
									<p>Cognome: <?php echo $this->_tpl_vars['Informazioni']['cognome']; ?>
</p>
									<p>Email: <?php echo $this->_tpl_vars['Informazioni']['email']; ?>
</p>
                                 	<p>Data di Nascita: <?php echo $this->_tpl_vars['Informazioni']['data']; ?>
</p>
								  	<p>Città: <?php echo $this->_tpl_vars['Informazioni']['citta']; ?>
</p>
						</div>
						<div class="item closed orange" id="orange" onClick="consultaSezione(this.id)">
							<h3>Interessi</h3>
								<?php $_from = $this->_tpl_vars['interessi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['interests'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['interests']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['interests']['iteration']++;
?>
								<?php if (( $this->_foreach['interests']['iteration']%3 ) == 0): ?>
								<st>- <?php echo $this->_tpl_vars['i']; ?>
</st><br><br>
								<?php else: ?><st>- <?php echo $this->_tpl_vars['i']; ?>
</st>
								<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
								
						</div>
						<div class="item closed red" id="red" onClick="consultaSezione(this.id)">
							<h3>Stato personale</h3>
						<?php if ($this->_tpl_vars['mioprofilo']): ?>
                     
                     <form id="cambia_stato">
	                  
	                  <textarea cols=40 rows=4 name="status" id ="stato" maxlength=150 placeholder="Inserisci il tuo stato personale..."><?php echo $this->_tpl_vars['Informazioni']['status']; ?>
</textarea>
					 <input type="hidden" name="task" value="cambiaStato"/>
					 <input type="hidden" name="email" value="<?php echo $this->_tpl_vars['Informazioni']['email']; ?>
" />
                      </form>
                       <button id ="invia_stato">Salva</button>
						
						<?php else: ?>
                        <p><?php echo $this->_tpl_vars['Informazioni']['status']; ?>
</p>
						<?php endif; ?>

						</div>
					</div>
					<div class="cb"></div>
				</div>