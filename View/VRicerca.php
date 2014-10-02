<?php

/**
 * @package View
 */
class VRicerca extends View {

    //metodi
    /**
     * mostra gli eventi cercati dall'utente
     */
    public function displayEventiTrovati($result) {
        $session = USingleton::getInstance("USession");
        $org = array();
        if (is_array($result)) {
            $arr = array();
            foreach ($result as $value) {
                $arr[] = get_object_vars($value);
                $org[] = get_object_vars($value->organizzatore);
            }

            $count = count($arr);
            for ($i = 0; $i < $count; $i++) {
                $this->assign('titolo', '');
                $this->assign('tipo', 'Evento');
                $this->assign('i', $i);
                $this->assign('classe', 'gotoprof' . $i);
                $this->assign('risultati', $arr[$i]);
                $this->assign('organizzatore', $org[$i]);
                if ($session->leggi_valore("email"))
                    $this->display('risultati_ricerca.tpl');
                else
                    $this->display('risultati_ricerca_logout.tpl');
            }
        }
        elseif (is_object($result)) {
            $x = get_object_vars($result);
            $o = get_object_vars($result->organizzatore);
            $this->assign('tipo', 'Evento');
            $this->assign('i', "0");
            $this->assign('classe', 'gotoprof0');
            $this->assign('risultati', $x);
            $this->assign('organizzatore', $o);
            if ($session->leggi_valore("email"))
                $this->display('risultati_ricerca.tpl');
            else
                $this->display('risultati_ricerca_logout.tpl');
        }
        else
            $this->display('ricerca_fallita.tpl');
    }

    /**
     * mostra gli eventi cercati dall'utente
     */
    public function displayUtentiTrovati($result) {
        if (is_array($result)) {
            $arr = array();
            foreach ($result as $value) {
                $arr[] = get_object_vars($value);
            }

            $count = count($arr);
            for ($i = 0; $i < $count; $i++) {
                $this->assign('titolo', '');
                $this->assign('tipo', 'Utente');
                $this->assign('i', $i);
                $this->assign('classe', 'gotoprof' . $i);
                $this->assign('risultati', $arr[$i]);
                $this->display('risultati_ricerca.tpl');
            }
        } elseif (is_object($result)) {
            $x = get_object_vars($result);
            $this->assign('tipo', 'Utente');
            $this->assign('i', "0");
            $this->assign('classe', 'gotoprof0');
            $this->assign('risultati', $x);
            $this->display('risultati_ricerca.tpl');
        }
        else
            $this->display('ricerca_fallita.tpl');
    }

    /**
     * resituisce i parametri della ricerca
     */
    public function getParametri() {
        $ris = array();
        foreach ($_REQUEST as $data => $value)
            $ris[$data] = $value;
        return $ris;
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
     * mostra il profilo dell'evento
     */
    public function displayProfiloEvento($risorsa) {
        $session = USingleton::getInstance("USession");
        $user_mail = $session->leggi_valore("email");
        if ($user_mail == $risorsa->organizzatore->email)
            $this->assign('mioevento', true);
        elseif ($session->leggi_valore('admin'))
            $this->assign('amministratore', true);
        $bool = false;
        $z = 0;
        $arr = array();
        $com = array();
        if ($user_mail) {
            foreach ($risorsa->partecipanti as $value) {
                if ($value->email == $user_mail & !$bool) {
                    $bool = true;
                }
                $arr[] = get_object_vars($value);
            }
            if ($bool)
                $this->assign('take_part', 'Non voglio partecipare più');
            else
                $this->assign('take_part', "Parteciperò all'evento");
            $this->assign('partecipanti', $arr);

            foreach ($risorsa->commenti as $value) {
                $com[] = get_object_vars($value);
                $com[$z]["commentante"] = get_object_vars($com[$z]["commentante"]);
                $z++;
            }
            $num = count($com);
            $this->assign('commenti', $com);


            $x = get_object_vars($risorsa);
            $org = get_object_vars($risorsa->organizzatore);
            $this->assign('org', $org);
            $this->assign('Informazioni', $x);
            $this->display('profilo_evento.tpl');
        }
        else {
            $x = get_object_vars($risorsa);
            $this->assign('Informazioni', $x);
            $this->display('profilo_evento_logout.tpl');
        }
    }

    /**
     * mostra il profilo dell'evento
     */
    public function displayProfiloUtente($risorsa) {
        $session = USingleton::getInstance("USession");
        if ($session->leggi_valore('admin'))
            $this->assign('amministratore', true);
        elseif ($session->leggi_valore('email') == $risorsa->email)
            $this->assign('mioprofilo', true);
        $x = get_object_vars($risorsa);
        $this->assign('Informazioni', $x);
        $this->assign('interessi', $risorsa->interessi);
        $this->display('profilo_utente.tpl');
    }

}

?>