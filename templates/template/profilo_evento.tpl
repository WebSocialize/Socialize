<script type="text/javascript" src="templates/template/js/validation.js"></script>
<script type="text/javascript" src="templates/template/js/datepicker.js"></script>
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script> 
<script type="text/javascript" src="templates/template/js/CModificaEvento.js"></script> 
<div class="slider">
					
					          <img src="templates/template/images/{$Informazioni.idimg}" class="left sliderimage">			
					          <div class="items right">
                       
						            <div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">

                          {if $amministratore}<button class="right admin" id="del_evento">Elimina Evento</button>
                                  <div id="dialog-delevento" title="ELIMINA EVENTO" style="display:none">
                                  <form id="form_delevento">
                                  <p> Eliminare questo evento? </p>
                                   <input type="hidden" name="nomeevento" value="{$Informazioni.nome}" />
                                   </form>
                                  </div>


                             {/if}

                          {if $mioevento}<button class="right" id="mod_evento">Modifica Evento</button>
                                
                                <div id="dialog-modevento" title="MODIFICA EVENTO" style="display:none">
                              <p class="under">Tutti i campi sono richiesti</p><br>
                             <form id="form_modevento" enctype="multipart/form-data" >
                              <p>Luogo<br><input type="text" name="luogo" value="{$Informazioni.luogo}" id="event_luogo"/>

                              <p>Data<br><input type="text" name="data" value="{$Informazioni.data}" id="datepicker2" /></p>
                              <p>Descrizione<br><textarea name="descrizione" id="event_desc" cols=40 rows=4 maxlength=150>{$Informazioni.data}</textarea>
                              
                              <div id="immagevento">
                                  <p id="result"></p>
                                  Foto: <input name="fileToUpload3" type="file" id="fileToUpload3" />


                               </div>
                            <input type="hidden" name="task" value="modificaevento"/>
                            <input type="hidden" name="controller" value="modifica_evento"/>
                            <input type="hidden" name="nome" value="{$Informazioni.nome}"/>
                                             
                            </form>
                            </div>
                            {/if}
                         

							              <h3>INFORMAZIONI</h3>
								            <p>Nome: {$Informazioni.nome}</p>
                            <p class="clickable profile" id="org">Organizzatore: {$org.nome} {$org.cognome}</p>
                            <form method="post"  id="gotoproforg">
                            <input type="hidden" name="email" value="{$org.email}" />
                            <input type="hidden" name="task" value="profilo_utente" />
                            </form>

							             	<p>Luogo:{$Informazioni.luogo}</p>
								            <p>Data: {$Informazioni.data}</p>
								            <p>Categoria: {$Informazioni.categoria}</p>
								            <p class="wordwrap">Descrizione: {$Informazioni.descrizione}</p>

                            

                            <img src="templates/template/images/{$Informazioni.idimg}" class="hide">
                        </div>
                        <div class="item closed orange" id="orange" onClick="consultaSezione(this.id)">
                            <h3>PARTECIPAZIONI</h3>
                      {if $amministratore != true}
                      <a id="partecipazione">{$take_part}</a>
                      {/if}
                      <p>Numero partecipanti <div><a id="num_visite">{$Informazioni.numVisite}</a></div></p>

                           <form id="ins_partecipazione">
                            	   <input type="hidden" name="nome_evento" value="{$Informazioni.nome}"/>
                           			 <input type="hidden" name="task" value="add_partec" />
                          			 <input type="hidden" name="controller" value="modifica_evento" />
                               </form>

                         <div id="dialog_partec" title="Partecipanti" style="display: none">
                                  <p class="under">Elenco dei Partecipanti</p><br>
                                  {foreach from=$partecipanti item=j name=foo}
                                  
                                  <a id="part{$smarty.foreach.foo.iteration}" class="clickable profile">{$j.nome} {$j.cognome}</a><br>
                                  <form id="gotoprofpart{$smarty.foreach.foo.iteration}">
                                  <input type="hidden" name="email" value="{$j.email}" />
                                  <input type="hidden" name="task" value="profilo_utente" />
                                  </form>
                                  {/foreach}    
                          </div>
						                 <img src="templates/template/images/{$Informazioni.idimg}" class="hide">
						            </div>
                        
                           
                  </div>
                  <div class="comments red">
                       <h3>COMMENTI</h3>                   
                            
                              {if $amministratore != true}
                              <form id="ins_commento">
                                 <textarea cols=40 rows=4 name="comment" id ="val_comm" maxlength=500></textarea>
                              
                                 <input type="hidden" name="nome_evento" value="{$Informazioni.nome}"/>
                                 <input type="hidden" name="controller" value="modifica_evento" />
                                 <input type="hidden" name="task" value="inserisci" />                      
                             </form>
                                 <br><button id="commenta"> Commenta </button>
                                {/if}
                            {foreach from=$commenti item=k}
                            <h4>{$k.commentante.nome} {$k.commentante.cognome}</h4>
                            {if $amministratore}
                            <button class="right" id="{$k.id}" onClick="deleteCommento(this.id)">ELIMINA</button>
                            <div id="dialog-delcommento{$k.id}" title="ELIMINA COMMENTO" style="display:none">
                               <p> Eliminare questo commento? </p>
                                  <form id="form_delcommento{$k.id}">
                                   <input type="hidden" name="idcomm" value="{$k.id}" />
                                   </form>
                                  </div>
                                {/if}
                            
                            <p class="wordwrap">{$k.commento}</p><br>
                          
                            {/foreach}                            
					<div class="cb"></div>
        </div>
</div>