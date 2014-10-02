<div class="slider">
					
					    <img src="templates/template/images/{$Informazioni.idimg}" class="left sliderimage">			
					    <div class="items right">
						    <div class="item opened yellow" id="yellow" onClick="consultaSezione(this.id)">
							    <h3>INFORMAZIONI</h3>
							    <p>Nome: {$Informazioni.nome}</p>
							   	<p>Luogo:{$Informazioni.luogo}</p>
							    <p>Data: {$Informazioni.data}</p>
							    <p>Categoria: {$Informazioni.categoria}</p>
							    <p class="wordwrap">Descrizione: {$Informazioni.descrizione}</p>
								<img src="templates/template/images/{$Informazioni.idimg}" class="hide">
                        	</div>
                        	<div class="item closed orange" id="orange" onClick="consultaSezione(this.id)">
                            	<h3>PARTECIPAZIONI</h3>
                             	<p>Numero partecipanti: {$Informazioni.numVisite}</p>
                              	<img src="templates/template/images/{$Informazioni.idimg}" class="hide">
							</div>
							<div class="comments red">
                            	<h3>COMMENTI</h3>
                            	<p>Devi accedere per visualizzare o inserire commenti</p>
                            </div>
                  		</div>
					<div class="cb"></div>
</div>