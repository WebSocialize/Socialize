<script type="text/javascript" src="templates/template/js/validation.js"></script>
<div class="slider">

					<div class="title">
						I tre eventi in evidenza!
					</div>
					<img src="templates/template/images/{$evento0.idimg}"  class="left sliderimage">
					<div class="sfondoimmagine"> </div>
					<div class="items right">
						<div class="item opened yellow" id="0" onClick="consultaSezione(this.id)">
							<h3 id="ev0" name="{$evento0.nome}">{$evento0.nome}</h3>
							<p>Data: {$evento0.data}</p>
							<a id="0" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: {$evento0.citta} </p>
							<p>Luogo: {$evento0.luogo} </p>
							<p class="wordwrap">Descrizione: {$evento0.descrizione} </p>
							<p class="clickable profile" id="00">Organizzatore: {$org0.nome} {$org0.cognome}</p>
							<p>Partecipazioni: {$evento0.numVisite} </p>
							
							
							<form method="post" id="gotoprof0">
   							 <input type="hidden" name="nomeevento" value="{$evento0.nome}" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>

   							<form method="post"  id="gotoprof00">
							<input type="hidden" name="email" value="{$org0.email}" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>
							
							<img src="templates/template/images/{$evento0.idimg}" class="hide"> 
					
						</div>
					
						<div class="item closed orange" id="1" onClick="consultaSezione(this.id)">
							<h3 id="ev1" name="{$evento1.nome}">{$evento1.nome}</h3>				
							<p>Data: {$evento1.data}</p>
							<a id="1" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: {$evento1.citta} </p>
							<p>Luogo: {$evento1.luogo} </p>
							<p class="wordwrap">Descrizione: {$evento1.descrizione} </p>
							<p class="clickable profile" id="11">Organizzatore: {$org1.nome} {$org1.cognome}</p>
							<p>Partecipazioni: {$evento1.numVisite} </p>
							
							<form method="post" id="gotoprof1">
							 <input type="hidden" name="nomeevento" value="{$evento1.nome}" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>
   							<form method="post"  id="gotoprof11">
							<input type="hidden" name="email" value="{$org1.email}" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>
							<img src="templates/template/images/{$evento1.idimg}" class="hide">
				   </form>
						</div>

						<div class="item closed red" id="2" onClick="consultaSezione(this.id)">
							<h3 id="ev2" name="{$evento2.nome}">{$evento2.nome}</h3>
							<p>Data: {$evento2.data}</p>
							<a id="2" class="right profile">CLICCA QUI PER I DETTAGLI</a>
							<p>Città: {$evento2.citta} </p>
							<p>Luogo: {$evento2.luogo} </p>
							<p class="wordwrap">Descrizione: {$evento2.descrizione} </p>
							<p class="clickable profile" id="22">Organizzatore: {$org2.nome} {$org2.cognome}</p>
							<p>Partecipazioni: {$evento2.numVisite} </p>
							
							
							<form method="post" id="gotoprof2">
							<input type="hidden" name="nomeevento" value="{$evento2.nome}" />
   							 <input type="hidden" name="task" value="profilo_evento" />
   							</form>

   							<form method="post"  id="gotoprof22">
							<input type="hidden" name="email" value="{$org2.email}" />
						    <input type="hidden" name="task" value="profilo_utente" />
						    </form>

							<img src="templates/template/images/{$evento2.idimg}" class="hide">
						</div>
					</div>
					<div class="cb"></div>
				</div>