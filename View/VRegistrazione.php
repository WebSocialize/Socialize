<?php

/**
 * @package View
 */
class VRegistrazione extends View {

    //attributi
    public $_errorenome;
    public $_errorecognome;
    public $_erroremail;
    public $_errorepwd;
    public $_erroredata;
    public $_erroreconfpwd;

    //metodi

    /**
     * metodo per prendere il nome dai dati inseriti dall'utente 
     */
    public function getEmail() {
        if (isset($_REQUEST['email']))
            return $_REQUEST['email'];
        else
            return FALSE;
    }

    /**
     * ritorna la password inserita dall'utente
     */
    public function getPassword() {
        if (isset($_REQUEST['password']))
            return $_REQUEST['password'];
        else
            return false;
    }

    /**
     * restituisce i dati dell'utente che deve registrarsi
     */
    public function getDati() {
        $datitipo = array('nome', 'cognome', 'email', 'pwd', 'conf_pwd', 'data', 'sesso', 'citta');
        foreach ($_REQUEST as $dati => $value)
            if ($value == 'on')
                $datitipo[] = $dati;
        $dati = array();
        $interessi = array();
        foreach ($datitipo as $data) {
            if (isset($_REQUEST[$data])) {
                if ($_REQUEST[$data] == 'on')
                    $interessi[] = $data;
                else
                    $dati[$data] = $_REQUEST[$data];
            }
        }
        $dati['interessi'] = $interessi;
        return $dati;
    }

    /**
     * restituisce i dati dell'utente per modificare il suo profilo
     */
    public function getNuoviDati() {
        $datitipo = array('data', 'citta', 'idimg');
        foreach ($_REQUEST as $dati => $value)
            if ($value == 'on')
                $datitipo[] = $dati;
        $dati = array();
        $interessi = array();
        foreach ($datitipo as $data) {
            if (isset($_REQUEST[$data])) {
                if ($_REQUEST[$data] == 'on')
                    $interessi[] = $data;
                else
                    $dati[$data] = $_REQUEST[$data];
            }
        }
        $dati['interessi'] = $interessi;
        return $dati;
    }

    /**
     * restituisce la vecchia password, la nuova password e la conferma di quest'ultima per la procedura di cambio password
     */
    public function getOldNewPassword() {
        $datitipo = array('old_password', 'new_password', 'new_password_conf');
        $dato = array();
        foreach ($datitipo as $data)
            if (isset($_REQUEST[$data]))
                $dato[$data] = $_REQUEST[$data];
        return $dato;
    }

    /**
     * prende i dati per modificare lo stato dell'utente
     */
    public function getDatiStato() {
        $datitipo = array('email', 'status');
        $dato = array();
        foreach ($datitipo as $data)
            $dato[$data] = $_REQUEST[$data];
        return $dato;
    }

    /**
     * prende i dati per l'attivazione
     */
    public function getDatiAttivazione() {
        if (isset($_REQUEST['codice_attivazione']) && isset($_REQUEST['email']))
            return array('codice_attivazione' => $_REQUEST['codice_attivazione'], 'email' => $_REQUEST['email']);
        else
            return false;
    }

    /**
     * imposta il template passato per parametro
     */
    public function setTemplate($template) {
        return $this->fetch($template);
    }

    /**
     * carica le province da inserire nelle possibili scelte da un apposito file
     */
    public function setProvince() {
        $handle = fopen('province.txt', 'r');
        //$result = array();
        $i = 0;
        while (!feof($handle)) {
            $buffer = fgets($handle);
            $buffer = rtrim($buffer);
            $result[$i] = trim($buffer, '');
            $i++;
        }
        fclose($handle);
        $this->assign('listacitta', $result);
    }

    /**
     * carica gli interessi da inserire nelle possibili scelte da un apposito file
     */
    public function setInteressi() {
        $handle = fopen('interessi.txt', 'r');
        //$result = array();
        $i = 0;
        while (!feof($handle)) {
            $buffer = fgets($handle);
            $buffer = rtrim($buffer);
            $result[$i] = trim($buffer, '');
            $i++;
        }
        fclose($handle);
        $this->assign('listainteressi', $result);
    }

    /**
     * restituisce il task da eseguire
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

    /**
     * imposta gli eventi in primo piano
     * @param mixed $eventi Array di Eeventi o un singolo Eevento
     */
    public function setPrimopiano($eventi) {
        if (is_array($eventi)) {
            $evnt = array();
            $org = array();
            foreach ($eventi as $value) {
                $evnt[] = get_object_vars($value);
                $org[] = get_object_vars($value->organizzatore);
            }
            for ($i = 0; $i < count($evnt); $i++) {
                $this->assign("evento" . $i, $evnt[$i]);
                $this->assign("org" . $i, $org[$i]);
            }
        } elseif (is_object($eventi)) {
            $evnt = get_object_vars($eventi);
            $org = get_object_vars($eventi->organizzatore);
            $this->assign("org0", $org);
            $this->assign("evento0", $evnt);
        }
        else
            return false;
    }

}

?>
