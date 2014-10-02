  <div class="right">
    		<div class="social">
					<h3>registrati ora</h3>
					<form method="post"  id="form_register"> 
      <p> 
        <td align="left"> <label for="reg_nome"> Nome: </label> <br></td>
        <td> <input type="text" name="nome" id="reg_nome"/></td>

      </p>
      <p>
        <td align="left"> <label for="reg_cogn"> Cognome: </label> <br></td>
        <td> <input type="text" name="cognome" id="reg_cogn"/> </td>
      </p>
      <p>
        <td align="left"><label for="reg_mail"> Email: </label><br></td>
        <td> <input type="text" name="email" id="reg_mail"/> </td>
      </p>
      <p>
        <td align="left"><label for="password"> Password: </label><br></td>
        <td> <input type="password" name="pwd" id='password'/> </td>
      </p>
      <p>
        <td align="left"><label for="conf_password"> Conferma:</label> <br></td>
        <td> <input type="password" name="conf_pwd" id='conf_password'/> </td>
      </p>
      <p>
    
    <td align="left"> Data di nascita:  <br></td>
       <input type="text" name="data" id="datepicker" /></td>
        </p>
      <p>
        <td align="left"><label for="reg_sesso"> Sesso:</label> </td>
        <td><input type="radio" name="sesso" value="M" id="reg_sesso" CHECKED>M
            <input type="radio" name="sesso" value="F">F
        </td>
      </p>
      <p>
        <td align="left"> <label for="reg_citt"> Città: </label> <br></td>
        <td> <select name="citta" id="reg_citt"> </td>
        {foreach from=$listacitta item=i}
        <option value="{$i}">{$i}</option>
        {/foreach}
        </select>
      </p>

      <p>
        <td align="left"> <label for="reg_int"> Interessi: </label> <br></td>
        {foreach from=$listainteressi item=k}
        <input type="checkbox" name={$k}>{$k}
        {/foreach}
        </select>
      </p>
  
    <input type="hidden" name="task" value="salva" />   
   

   </table>
     <table cellpadding="5">


     <tr>
        <td> <input type="submit" name="register" value="Invia" /> </td>
     </tr>

   </table>
</form> 
					
					
					
				</div>
      </div>