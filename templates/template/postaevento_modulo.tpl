<div class="social">
	<h3>crea un evento</h3>
	<form method="post" action="http://localhost/socialize_test0.5/index.php?controller=creazione&task=nuovo" id="form_creaevento"> 
      <p> 
        <td align="left"> <label for="crea_nome"> Nome Evento: </label> <br></td>
        <td> <input type="text" name="nome" id="crea_nome"/></td>

      </p>
      <p>
        <td align="left"> <label for="crea_luogo"> Locazione: </label> <br></td>
        <td> <input type="text" name="luogo" id="crea_luogo"/> </td>
      </p>

	  <p>
        <td align="left"> <label for="crea_descrizione"> Descrizione: </label> <br></td>
        <td> <textarea cols=40 rows=4 name="descrizione" id="crea_descrizione" maxlength=150></textarea> </td>
      </p>
	  
      <p>
    
        <td align="left"> Data di svolgimento:  <br></td>
        <input type="text" name="data" id="datepicker_evento" /></td>
      </p>

	    <td align="left"> <label for="crea_categoria"> Categoria: </label> <br></td>
        <td> <select name="categoria" id="crea_categoria"> </td>
        {foreach from=$category item=i}
        <option value={$i}>{$i}</option>
        {/foreach}
        </select>
      </p>
	  
      <p>
        <td align="left"> <label for="crea_citt"> Città: </label> <br></td>
        <td> <select name="citta" id="crea_citt"> </td>
        {foreach from=$result item=i}
        <option value={$i}>{$i}</option>
        {/foreach}
        </select>
      </p>
     

   </table>
     <table cellpadding="5">


     <tr>
        <td> <input type="submit" name="crea" value="Crea" id="crea_submit" /> </td>
     </tr>

   </table>
</form> 
					
					
					
</div>
