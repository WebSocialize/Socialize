<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>
<div id="ricerca_ris">
<p>
	<form method="post" id={$classe}>
	<h2 id={$i} class="profile">{$risultati.nome}</h2>

	<input type="hidden" name="nomeevento" value="{$risultati.nome}" />
        <input type="hidden" name="task" value="profilo_evento" />
    
	</form>

	<p> Città: {$risultati.citta} </p>	
    <p> Luogo: {$risultati.luogo} </p>
	<p> Descrizione:</p>
	<p class="wordwrap"> {$risultati.descrizione} </p>
	<p> Categoria : {$risultati.categoria} </p>
	<p> Partecipanti: {$risultati.numVisite} </p>


</p>