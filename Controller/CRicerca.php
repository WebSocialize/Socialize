<?php

/**
 * @package Controller
 */
class CRicerca {

    //attributi
    protected $result;

    //metodi
    public function cerca_evento() {
        $view = USingleton::getInstance('VRicerca');
        $evento = new FEvento();
        $parametri = $view->getParametri();
        $query="";
        if (isset($parametri['citta']) || isset($parametri['categoria']))
        {
        $citt = $parametri['citta'];
        $cat = $parametri['categoria'];
        if ($citt=="Qualsiasi" && $cat=="Qualsiasi")
            $query = "SELECT * FROM `evento`";
        else if($citt=="Qualsiasi")
            $query= "SELECT * FROM `evento` WHERE `categoria`=" . "'" . $cat . "'";
        else if ($cat=="Qualsiasi")
            $query=  "SELECT * FROM `evento` WHERE `citta`=" . "'" . $citt . "'";
        else
            $query = "SELECT * FROM `evento` WHERE `citta`=" . "'" . $citt . "'" . " AND `categoria`=" . "'" . $cat . "'";
        }
        
        if ($parametri['nomeevento'] != "")
        {
            $nome = mysql_real_escape_string($parametri['nomeevento']);
            if ($query=="")
                $query = "SELECT * FROM `evento` WHERE `nome`=". "'" . $nome . "'";
            elseif ($query == "SELECT * FROM `evento`") $query= $query." WHERE `nome`=". "'" . $nome . "'";
            else $query= $query." AND `nome`=". "'" . $nome . "'";
        }
        $result = $evento->ricerca($query);
        return $result;
    }

    public function cerca_utente() {
        $view = USingleton::getInstance('VRicerca');
        $utente = new FUtente();
        $parametri = $view->getParametri();
        $string = ' WHERE attivazione=1';
        if (!isset($parametri['email']))
        //cerco utente in base a nome cognome e città
         {  
            if ($parametri['nomepersona'] != '')
                $string .= ' AND `nome`=' . "'" . $parametri['nomepersona'] . "'";
            if ($parametri['cognomepersona'] != '')
                $string .= ' AND cognome =' . "'" . $parametri['cognomepersona'] . "'";
            if($parametri['citta']!="Qualsiasi")
                $string .= ' AND `citta` =' . "'" . $parametri['citta'] . "'";
            if ($parametri['interesse']=="Qualsiasi")
            {
              $query = 'SELECT * FROM `utente`' . $string;
              $result = $utente->ricerca($query);
            }
            else
            {
              $query = 'SELECT * FROM `utente`,`interesse`' . $string. ' AND `nome_interesse` = '."'".$parametri['interesse']."'".' AND `utente`.`email` = `interesse`.`email_utente`';
              $result=$utente->ricerca($query);
            }
        }
        else
        {
            $mail = $parametri['email'];
            $query = 'SELECT * FROM `utente` WHERE `email`='. "'" . $mail . "'";
            $result = $utente->ricerca($query);
        }
        //cerco 
        return $result;
    }

   // SELECT * FROM `utente`,`interesse` WHERE `email` = 'davide-cichella@hotmail.it' AND `utente`.`email`=`interesse`.`email_utente`

    public function smista() {
        $view = USingleton::getInstance('VRicerca');
        switch ($view->getTask()) {
            case 'cerca_evento':
                return $view->displayEventiTrovati($this->cerca_evento());
            case 'cerca_utente':
                return $view->displayUtentiTrovati($this->cerca_utente());
            case 'profilo_utente':
                return $view->displayProfiloUtente($this->cerca_utente());
            case 'profilo_evento':
                return $view->displayProfiloEvento($this->cerca_evento());
        }
    }

}

?>
