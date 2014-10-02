<?php /* Smarty version 2.6.26, created on 2014-01-09 13:09:02
         compiled from risultati_ricerca.tpl */ ?>
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>
<div id="ricerca_ris">
<?php if ($this->_tpl_vars['tipo'] == Evento): ?>
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

	<p> Data: <?php echo $this->_tpl_vars['risultati']['data']; ?>
 </p>
	<p> Città: <?php echo $this->_tpl_vars['risultati']['citta']; ?>
 </p>	
    <p> Luogo: <?php echo $this->_tpl_vars['risultati']['luogo']; ?>
 </p>
	<p> Descrizione:</p>
	<p class="wordwrap"> <?php echo $this->_tpl_vars['risultati']['descrizione']; ?>
 </p>
	<p> Categoria : <?php echo $this->_tpl_vars['risultati']['categoria']; ?>
 </p>

	<p class="clickable profile" id="<?php echo $this->_tpl_vars['i']; ?>
<?php echo $this->_tpl_vars['i']; ?>
"> Organizzatore : <?php echo $this->_tpl_vars['organizzatore']['nome']; ?>
 <?php echo $this->_tpl_vars['organizzatore']['cognome']; ?>
 </p>

	<form method="post"  id="<?php echo $this->_tpl_vars['classe']; ?>
<?php echo $this->_tpl_vars['i']; ?>
">
	<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['organizzatore']['email']; ?>
" />
    <input type="hidden" name="task" value="profilo_utente" />
    </form>

	<p> Partecipanti: <?php echo $this->_tpl_vars['risultati']['numVisite']; ?>
 </p>


</p>
<?php else: ?>
<p>
	<h2 id=<?php echo $this->_tpl_vars['i']; ?>
 class="profile"><?php echo $this->_tpl_vars['risultati']['nome']; ?>
 <?php echo $this->_tpl_vars['risultati']['cognome']; ?>
</h2>
	<p> Email: <?php echo $this->_tpl_vars['risultati']['email']; ?>
 </p>	
	<p> Città : <?php echo $this->_tpl_vars['risultati']['citta']; ?>
 </p>
</p>

<form method="post"  id=<?php echo $this->_tpl_vars['classe']; ?>
>
	<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['risultati']['email']; ?>
" />
    <input type="hidden" name="task" value="profilo_utente" />
</form>	
<?php endif; ?>
</div>