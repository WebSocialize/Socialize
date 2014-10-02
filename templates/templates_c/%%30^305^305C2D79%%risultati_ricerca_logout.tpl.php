<?php /* Smarty version 2.6.26, created on 2014-01-09 16:06:08
         compiled from risultati_ricerca_logout.tpl */ ?>
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>
<div id="ricerca_ris">
<p>
	<form method="post" id=<?php echo $this->_tpl_vars['classe']; ?>
>
	<h2 id=<?php echo $this->_tpl_vars['i']; ?>
 class="profile"><?php echo $this->_tpl_vars['risultati']['nome']; ?>
</h2>

	<input type="hidden" name="nomeevento" value="<?php echo $this->_tpl_vars['risultati']['nome']; ?>
" />
        <input type="hidden" name="task" value="profilo_evento" />
    
	</form>

	<p> Città: <?php echo $this->_tpl_vars['risultati']['citta']; ?>
 </p>	
    <p> Luogo: <?php echo $this->_tpl_vars['risultati']['luogo']; ?>
 </p>
	<p> Descrizione:</p>
	<p class="wordwrap"> <?php echo $this->_tpl_vars['risultati']['descrizione']; ?>
 </p>
	<p> Categoria : <?php echo $this->_tpl_vars['risultati']['categoria']; ?>
 </p>
	<p> Partecipanti: <?php echo $this->_tpl_vars['risultati']['numVisite']; ?>
 </p>


</p>