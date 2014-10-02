<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>
<div id="ricerca_ris">
{if $tipo == Evento}
<p>
	<form method="post" id={$classe}>
	<h2 id={$i} class="profile">{$risultati.nome}</h2>

	<input type="hidden" name="nomeevento" value="{$risultati.nome}" />
    <input type="hidden" name="task" value="profilo_evento" />
    
	</form>

	<p> Data: {$risultati.data} </p>
	<p> Città: {$risultati.citta} </p>	
    <p> Luogo: {$risultati.luogo} </p>
	<p> Descrizione:</p>
	<p class="wordwrap"> {$risultati.descrizione} </p>
	<p> Categoria : {$risultati.categoria} </p>

	<p class="clickable profile" id="{$i}{$i}"> Organizzatore : {$organizzatore.nome} {$organizzatore.cognome} </p>

	<form method="post"  id="{$classe}{$i}">
	<input type="hidden" name="email" value="{$organizzatore.email}" />
    <input type="hidden" name="task" value="profilo_utente" />
    </form>

	<p> Partecipanti: {$risultati.numVisite} </p>


</p>
{else}
<p>
	<h2 id={$i} class="profile">{$risultati.nome} {$risultati.cognome}</h2>
	<p> Email: {$risultati.email} </p>	
	<p> Città : {$risultati.citta} </p>
</p>

<form method="post"  id={$classe}>
	<input type="hidden" name="email" value="{$risultati.email}" />
    <input type="hidden" name="task" value="profilo_utente" />
</form>	
{/if}
</div>
