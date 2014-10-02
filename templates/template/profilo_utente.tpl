<script type="text/javascript" src="templates/template/js/validation.js"></script>  
<script type="text/javascript" src="templates/template/js/datepicker.js"></script>
<script type="text/javascript" src="templates/template/js/CComunicazione.js"></script>
<script type="text/javascript" src="templates/template/js/CRegistrazione.js"></script>

<div class="slider">
					
					<img src="templates/template/images/{$Informazioni.immprofilo}" class="left sliderimage">
				
					<div class="items right">
						
						<div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">

							{if $amministratore}<button class="right" id="del_profilo" >Elimina utente</button>
                                  <div id="dialog-delprofilo" title="ELIMINA PROFILO" style="display:none">
                                  <form id="form_delprofilo">
                                  <p> Eliminare Questo profilo? </p>
                                   <input type="hidden" name="mail" value="{$Informazioni.email}" />
                                   </form>
                                  </div>


						{/if}
						{if $mioprofilo}
                     <button class="right" id="mod_profilo">Modifica dati</button>
						           
						           <div id="dialog-modprofilo" title="MODIFICA PROFILO" style="display:none">
									<p class="under">Tutti i campi sono richiesti</p><br>
									<form id="form_modprofilo" enctype="multipart/form-data" >
										<p>Città<br><select name="citta" id="user_citta"></select></p>

			       					 <p>Data<br><input type="text" name="data" value="{$Informazioni.data}" id="datepicker2" /></p>
								     
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
					   {else}
					  <button class="right" id="invioemail">Invia email</button>
					     <div id="dialog-invioemail" title="CONTATTA {$Informazioni.nome} {$Informazioni.cognome}" style="display:none">
									<p class="under">Tutti i campi sono richiesti</p><br>
									<form id="form_invioemail">

			       					 <p>Oggetto<br><input type="text" name="oggetto" id="oggetto" /></p>
			       					  <p>Messaggio</p>
			       	   <textarea cols=60 rows=20 name="messaggio" id ="messaggio" maxlength=1000 placeholder="Inserisci qui il tuo messaggio..."></textarea>
                                   <input type="hidden" name="destinatario" value="{$Informazioni.email}"/>
								    <input type="hidden" name="controller" value="comunicazione"/>
                                    <input type="hidden" name="task" value="messaggio_email"/>
			                         </form>
			                         </div>


						{/if}
							<h3>Informazioni</h3>

 									<p>Nome: {$Informazioni.nome}</p>
									<p>Cognome: {$Informazioni.cognome}</p>
									<p>Email: {$Informazioni.email}</p>
                                 	<p>Data di Nascita: {$Informazioni.data}</p>
								  	<p>Città: {$Informazioni.citta}</p>
						</div>
						<div class="item closed orange" id="orange" onClick="consultaSezione(this.id)">
							<h3>Interessi</h3>
								{foreach from=$interessi item=i name=interests}
								{if ($smarty.foreach.interests.iteration%3) == 0}
								<st>- {$i}</st><br><br>
								{else}<st>- {$i}</st>
								{/if}
								{/foreach}
								
						</div>
						<div class="item closed red" id="red" onClick="consultaSezione(this.id)">
							<h3>Stato personale</h3>
						{if $mioprofilo}
                     
                     <form id="cambia_stato">
	                  
	                  <textarea cols=40 rows=4 name="status" id ="stato" maxlength=150 placeholder="Inserisci il tuo stato personale...">{$Informazioni.status}</textarea>
					 <input type="hidden" name="task" value="cambiaStato"/>
					 <input type="hidden" name="email" value="{$Informazioni.email}" />
                      </form>
                       <button id ="invia_stato">Salva</button>
						
						{else}
                        <p>{$Informazioni.status}</p>
						{/if}

						</div>
					</div>
					<div class="cb"></div>
				</div>