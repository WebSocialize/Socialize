<?php /* Smarty version 2.6.26, created on 2013-12-19 12:45:21
         compiled from registrato_admin.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>

<meta charset="utf-8" />
<link rel="stylesheet" href="templates/template/css/jquery-ui.css" />
<script src="templates/template/js/jquery-1.9.1.js"></script>
<script src="templates/template/js/jquery-ui.js"></script>



 <!-- jquery validazioni //-->   
<script type="text/javascript" src="templates/template/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="templates/template/js/jquery.validate.js"></script>   
<script type="text/javascript" src="templates/template/js/validation.js"></script>  
<script type="text/javascript" src="templates/template/js/CHome.js"></script>  
<script type="text/javascript" src="templates/template/js/CRegistrazione.js"></script> 
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>   
<script type="text/javascript" src="templates/template/js/CPostaEvento.js"></script>  
<script type="text/javascript" src="templates/template/js/CModificaEvento.js"></script>  
<script type="text/javascript" src="templates/template/js/CComunicazione.js"></script>
<script type="text/javascript" src="templates/template/js/CAmministrazione.js"></script>


<!--<link rel="stylesheet" href="templates/template/css/stylevalid.css" type="text/css" /> //--> 


	<title>Socialize - Know your life</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="templates/template/css/fonts.css"  />
	<link rel="stylesheet" type="text/css" href="templates/template/css/style.css"  />
	
	
</head>
<body>
	<a href="index.php" id="logo"></a>
	<ul id="ldd_menu" class="ldd_menu">     
				<li>
					<a class="tasto" href="index.php?controller=registrazione&task=esci">LOGOUT</a>
				</li>
				<li>
					<span>EVENTI</span> 
					<div class="ldd_submenu">
					<form method="post" id="cercaevento" onsubmit="return false" >
						<ul>
							<li class="ldd_heading" id="ciao">Nome</li>
							<li><input type="text" name="nomeevento" class="enter"></li>
							<li class="ldd_heading">Città</li>
							<li> <select name="citta" >
									<option value="Qualsiasi">Qualsiasi</option> 
							       <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
							       <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
							       <?php endforeach; endif; unset($_from); ?>
							       </select>
							   </li>
							<li class="ldd_heading">Categoria</li>
							 <select name="categoria" > 
							 	   <option value="Qualsiasi">Qualsiasi</option>
							       <?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['j']):
?>
							       <option value="<?php echo $this->_tpl_vars['j']; ?>
"><?php echo $this->_tpl_vars['j']; ?>
</option>
							       <?php endforeach; endif; unset($_from); ?>
							       </select>
						</ul>
						<input type="hidden" name="controller" value="ricerca"/>
					    <input type="hidden" name="task" value="cerca_evento"/> 
					    
  
					</form>

		
						<a class="ldd_subfoot"></a>





					</div>
				</li>
				<li>
					<span>PERSONE</span><!-- Increases to 510px in width-->
					<div class="ldd_submenu">
					<form method="post"  id="cercapersona" onsubmit="return false"  >
						<ul>
							<li class="ldd_heading">Nome</li>
							<li><input type="text" name="nomepersona" class="enter"></li>
							<li class="ldd_heading">Cognome</li>
							<li><input type="text" name="cognomepersona" class="enter"></li>
							<li class="ldd_heading">Città</li>
							<td> <select name="citta" id="reg_citt"> </td>
									<option value="Qualsiasi">Qualsiasi</option>
							        <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
							        <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
							        <?php endforeach; endif; unset($_from); ?>
							        </select>
							<li class="ldd_heading">Interesse</li>
						   <td> <select name="interesse" id="reg_int"> </td>
						   		   <option value="Qualsiasi">Qualsiasi</option>
							       <?php $_from = $this->_tpl_vars['listainteressi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
							       <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
							       <?php endforeach; endif; unset($_from); ?>
							       </select>
						    </li>
						</ul>
						<input type="hidden" name="controller" value="ricerca"/>
					    <input type="hidden" name="task" value="cerca_utente"/>
					</form>

		
						<a class="ldd_subfoot" ></a>
					</div>
				</li>
				<li>
					<a class="tasto" href="index.php">HOME</a>
				</li>

				
			</ul>
		

	<div id="wrapper">
		<div id="header">
			<div class="cb"></div>
		</div>
		
		<div id="main">
			<div class="content">
				
				<div id="composto"> </div>
				<div id="composto2"> </div>

				<div id="main_content"><?php echo $this->_tpl_vars['main_content']; ?>
</div>
                <div id="side_content"><?php echo $this->_tpl_vars['side_content']; ?>
</div>

				<div class="cb"></div>
			</div>
			
			<div class="footer">
			
				
				<div class="cb"></div>
			
			</div>
		</div>
		
		
	</div>
	
</body>
</html>