<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>

<meta charset="utf-8" />
<link rel="stylesheet" href="templates/template/css/jquery-ui.css" />
<script src="templates/template/js/jquery-1.9.1.js"></script>
<script src="templates/template/js/jquery-ui.js"></script>
 

 <!-- jquery validazioni //-->   
<script type="text/javascript" src="templates/template/js/jquery.validate.js"></script>   
<script type="text/javascript" src="templates/template/js/validation.js"></script> 
<script type="text/javascript" src="templates/template/js/CHome.js"></script>
<script type="text/javascript" src="templates/template/js/CRicerca.js"></script>
<script type="text/javascript" src="templates/template/js/CComunicazione.js"></script>



	<title>Socialize - Know your life</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="templates/template/css/fonts.css"  />
	<link rel="stylesheet" type="text/css" href="templates/template/css/style.css"  />
	
	
</head>
<body>
	<a href="index.php" id="logo"></a>
	<ul id="ldd_menu" class="ldd_menu">
				<li>
					<span>LOGIN</span><!-- Increases to 510px in width-->
					<div class="ldd_submenu">
					<form method="post" action="index.php?controller=registrazione&task=login" id="form_login">
						<ul>
							<li class="ldd_heading">Email:</li>
							<li><input type="text" name="email"></li>
							<li class="ldd_heading">Password:</li>
							<li><input type="password" name="password"></li>
							<li><input type="submit" name="login" value="Login"> </li>
						</ul>
                                        </form>
						<a class="ldd_subfoot" id="recupera_password" >Password dimenticata?</a>

                                                    <div id="dialog-recpassword" title="Recupera Password" style="display:none">
					
                    <p class="under">Scrivi il tuo indirizzo email nel campo sottostante. Ti verrà subito invitata un email contentente la tua password.</p><br>
					
                                              <form id="form_recpassword">
       					 <p>Email<br><input type="text" name="email" id="email_recupero"/></p>
					     <input type="hidden" name="controller" value="comunicazione"/>
					     <input type="hidden" name="task" value="recupera_password"/>
                                             
						</form>
						</div>
					   
					</div>
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
							       {foreach from=$result item=i}
							       <option value="{$i}">{$i}</option>
							       {/foreach}
							       </select>
							   </li>
							<li class="ldd_heading">Categoria</li>
							 <select name="categoria" > 
							 	   <option value="Qualsiasi">Qualsiasi</option>
							       {foreach from=$category item=j}
							       <option value="{$j}">{$j}</option>
							       {/foreach}
							       </select>
						</ul>
						<input type="hidden" name="controller" value="ricerca"/>
					    <input type="hidden" name="task" value="cerca_evento"/> 
					    
  
					</form>
          			<div class="ldd_subfoot"></div>
					</div>
				</li>
				
			</ul>
		</div>
	<div id="wrapper">
		
		<div id="header">
		<div class="box">	
		 <div class="cb"></div>
		 </div>
              </div>
			
        <div id="main">
			<div class="content">
				<noscript id="noajax">ATTENZIONE: Javascript è disabilitato! Per una migliore esperienza con Socialize ne raccomandiamo l'attivazione.</noscript>
				
				<div id="composto"></div>
				
              <div id="main_content"> {$main_content}</div>
               <div id="side_content"> {$side_content}</div>

				<div class="cb"></div>
			</div>
			
			<div class="footer">
			
				
				<div class="cb"></div>
			
			</div>
		</div>
		
	
</body>
</html>
