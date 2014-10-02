<?php /* Smarty version 2.6.26, created on 2014-01-09 16:14:02
         compiled from profilo_evento.tpl */ ?>
<script type="text/javascript" src="templates/template/js/validation.js"></script>
<script type="text/javascript" src="templates/template/js/datepicker.js"></script>
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script> 
<script type="text/javascript" src="templates/template/js/CModificaEvento.js"></script> 
<div class="slider">
					
					          <img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['idimg']; ?>
" class="left sliderimage">			
					          <div class="items right">
                       
						            <div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">

                          <?php if ($this->_tpl_vars['amministratore']): ?><button class="right admin" id="del_evento">Elimina Evento</button>
                                  <div id="dialog-delevento" title="ELIMINA EVENTO" style="display:none">
                                  <form id="form_delevento">
                                  <p> Eliminare questo evento? </p>
                                   <input type="hidden" name="nomeevento" value="<?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
" />
                                   </form>
                                  </div>


                             <?php endif; ?>

                          <?php if ($this->_tpl_vars['mioevento']): ?><button class="right" id="mod_evento">Modifica Evento</button>
                                
                                <div id="dialog-modevento" title="MODIFICA EVENTO" style="display:none">
                              <p class="under">Tutti i campi sono richiesti</p><br>
                             <form id="form_modevento" enctype="multipart/form-data" >
                              <p>Luogo<br><input type="text" name="luogo" value="<?php echo $this->_tpl_vars['Informazioni']['luogo']; ?>
" id="event_luogo"/>

                              <p>Data<br><input type="text" name="data" value="<?php echo $this->_tpl_vars['Informazioni']['data']; ?>
" id="datepicker2" /></p>
                              <p>Descrizione<br><textarea name="descrizione" id="event_desc" cols=40 rows=4 maxlength=150><?php echo $this->_tpl_vars['Informazioni']['data']; ?>
</textarea>
                              
                              <div id="immagevento">
                                  <p id="result"></p>
                                  Foto: <input name="fileToUpload3" type="file" id="fileToUpload3" />


                               </div>
                            <input type="hidden" name="task" value="modificaevento"/>
                            <input type="hidden" name="controller" value="modifica_evento"/>
                            <input type="hidden" name="nome" value="<?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
"/>
                                             
                            </form>
                            </div>
                            <?php endif; ?>
                         

							              <h3>INFORMAZIONI</h3>
								            <p>Nome: <?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
</p>
                            <p class="clickable profile" id="org">Organizzatore: <?php echo $this->_tpl_vars['org']['nome']; ?>
 <?php echo $this->_tpl_vars['org']['cognome']; ?>
</p>
                            <form method="post"  id="gotoproforg">
                            <input type="hidden" name="email" value="<?php echo $this->_tpl_vars['org']['email']; ?>
" />
                            <input type="hidden" name="task" value="profilo_utente" />
                            </form>

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
                      <?php if ($this->_tpl_vars['amministratore'] != true): ?>
                      <a id="partecipazione"><?php echo $this->_tpl_vars['take_part']; ?>
</a>
                      <?php endif; ?>
                      <p>Numero partecipanti <div><a id="num_visite"><?php echo $this->_tpl_vars['Informazioni']['numVisite']; ?>
</a></div></p>

                           <form id="ins_partecipazione">
                            	   <input type="hidden" name="nome_evento" value="<?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
"/>
                           			 <input type="hidden" name="task" value="add_partec" />
                          			 <input type="hidden" name="controller" value="modifica_evento" />
                               </form>

                         <div id="dialog_partec" title="Partecipanti" style="display: none">
                                  <p class="under">Elenco dei Partecipanti</p><br>
                                  <?php $_from = $this->_tpl_vars['partecipanti']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['j']):
        $this->_foreach['foo']['iteration']++;
?>
                                  
                                  <a id="part<?php echo $this->_foreach['foo']['iteration']; ?>
" class="clickable profile"><?php echo $this->_tpl_vars['j']['nome']; ?>
 <?php echo $this->_tpl_vars['j']['cognome']; ?>
</a><br>
                                  <form id="gotoprofpart<?php echo $this->_foreach['foo']['iteration']; ?>
">
                                  <input type="hidden" name="email" value="<?php echo $this->_tpl_vars['j']['email']; ?>
" />
                                  <input type="hidden" name="task" value="profilo_utente" />
                                  </form>
                                  <?php endforeach; endif; unset($_from); ?>    
                          </div>
						                 <img src="templates/template/images/<?php echo $this->_tpl_vars['Informazioni']['idimg']; ?>
" class="hide">
						            </div>
                        
                           
                  </div>
                  <div class="comments red">
                       <h3>COMMENTI</h3>                   
                            
                              <?php if ($this->_tpl_vars['amministratore'] != true): ?>
                              <form id="ins_commento">
                                 <textarea cols=40 rows=4 name="comment" id ="val_comm" maxlength=500></textarea>
                              
                                 <input type="hidden" name="nome_evento" value="<?php echo $this->_tpl_vars['Informazioni']['nome']; ?>
"/>
                                 <input type="hidden" name="controller" value="modifica_evento" />
                                 <input type="hidden" name="task" value="inserisci" />                      
                             </form>
                                 <br><button id="commenta"> Commenta </button>
                                <?php endif; ?>
                            <?php $_from = $this->_tpl_vars['commenti']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k']):
?>
                            <h4><?php echo $this->_tpl_vars['k']['commentante']['nome']; ?>
 <?php echo $this->_tpl_vars['k']['commentante']['cognome']; ?>
</h4>
                            <?php if ($this->_tpl_vars['amministratore']): ?>
                            <button class="right" id="<?php echo $this->_tpl_vars['k']['id']; ?>
" onClick="deleteCommento(this.id)">ELIMINA</button>
                            <div id="dialog-delcommento<?php echo $this->_tpl_vars['k']['id']; ?>
" title="ELIMINA COMMENTO" style="display:none">
                               <p> Eliminare questo commento? </p>
                                  <form id="form_delcommento<?php echo $this->_tpl_vars['k']['id']; ?>
">
                                   <input type="hidden" name="idcomm" value="<?php echo $this->_tpl_vars['k']['id']; ?>
" />
                                   </form>
                                  </div>
                                <?php endif; ?>
                            
                            <p class="wordwrap"><?php echo $this->_tpl_vars['k']['commento']; ?>
</p><br>
                          
                            <?php endforeach; endif; unset($_from); ?>                            
					<div class="cb"></div>
        </div>
</div>