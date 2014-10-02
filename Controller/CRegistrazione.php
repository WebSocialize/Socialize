<?php

/**
 *  @package Controller
 */
class CRegistrazione {

    //attributi
    private $email;
    private $password;
    private $errore = '';
    private $script = '';

    /**
     *  crea l'utente che ha effettuato la procedura di registrazione
     */
    public function CreaUtente() {

        $view = USingleton::getInstance('VRegistrazione');
        $vhome = USingleton::getInstance('VHome');
        $dat_reg = $view->getDati();
        $utente = new Eutente();
        $utente->validaUtente($dat_reg['nome'], $dat_reg['cognome'], $dat_reg['email'], $dat_reg['pwd'], $dat_reg['data'], $dat_reg['sesso'], $dat_reg['citta'], $dat_reg['interessi']);
        if ($dat_reg['pwd'] == $dat_reg['conf_pwd']) {
            if ($utente->getNome() != false && $utente->getCognome() != false && $utente->getEmail() != false && $utente->getPwd() != false) {
                $utente->generaCodiceAttivazione();
                $Fuser = new FUtente();
                $Fuser->store($utente);
                $Fuser->store_interessi($dat_reg['interessi'], $dat_reg['email']);
                $this->emailAttivazione($utente);
                //se sto usando ajax faccio direttamente il display del template interessato, altrimenti ricompongo l'intera pagina e la ritorno a chome che tramite vhome effettua il display
                if (!$vhome->getAjax()) {
                    $contenuto = array('main' => $view->setTemplate('conferma_registrazione.tpl'), 'side' => $view->setTemplate('vuoto.tpl'));
                    return $contenuto;
                }
                else
                    $view->display('conferma_registrazione.tpl');
            }
        }
    }

    /**
     *  verifica la password immessa dall'utente e quella dell'utente, durante la procedura di cambio password
     *  @return boolean
     */
    public function controllaVecchiaPassword() {
        $session = USingleton::getInstance('USession');
        $view = USingleton::getInstance('VRegistrazione');
        $pwds = $view->getOldNewPassword();
        if ($pwds['old_password']) {
            $Fuser = new FUtente();
            $utente = $Fuser->load($session->leggi_valore('email'));
            if ($utente->pwd == $pwds['old_password'])
                echo json_encode(true);
            else
                echo json_encode(false);
        }
    }

    /**
     *  funzione che comunica se la mail immessa dall'utente è disponibile o già in uso
     *  @@return boolean
     */
    private function verificaEsistenzaEmail() {
        $view = USingleton::getInstance('VRegistrazione');
        $email = $view->getEmail();
        $Fadmin = new FAdmin();
        $admin = $Fadmin->load($email);
        if ($admin != false)
            return true;
        else {
            $Fuser = new FUtente();
            $user = $Fuser->load($email);
            if ($user)
                return true;
            else
                return false;
        }
    }

    /**
     *  comunica in codifica json il risultato di verificaEsistenzaEmail() come risposta alla chiamata ajax
     */
    public function accountDisponibile() {
        if ($this->verificaEsistenzaEmail())
            echo json_encode(false);
        else
            echo json_encode(true);
    }

    /**
     * comunica se si sta tentando di recuperare la password per un account inesistente usando la funzione verificaEsistenzaEmail()
     * @return boolean json encode
     */
    public function passwordRecuperabile() {
        if ($this->verificaEsistenzaEmail())
            echo json_encode(true);
        else
            echo json_encode(false);
    }

    /**
     *  aggiorna i dati dell'utente in seguito alla modifica del profilo. Ritorna la display del profilo dell'utente aggiornato
     */
    public function modificaUtente() {
        $session = USingleton::getInstance('USession');
        $view = USingleton::getInstance('VRegistrazione');
        $nuovi_dati = $view->getNuoviDati();
        //$datiEvento['citta'] = rtrim($datiEvento['citta']);
        // $datiEvento['interessi'] = rtrim($datiEvento['interessi']);
        $Fuser = new FUtente();
        $utente = $Fuser->load($session->leggi_valore('email'));
        if (!isset($nuovi_dati['idimg']))
            $nuovi_dati['idimg'] = 'utentedefaultimg.jpg';
        $utente->aggiornaUtente($nuovi_dati['data'], $nuovi_dati['citta'], $nuovi_dati['interessi'], $nuovi_dati['idimg']);
        $Fuser->update($utente);

        $view_ricerca = USingleton::getInstance('VRicerca');
        $view_ricerca->displayProfiloUtente($utente);
    }

    /*
     * aggiorna la password dell'utente
     */

    public function modificaPassword() {
        $session = USingleton::getInstance('USession');
        $view = USingleton::getInstance('VRegistrazione');
        $pwds = $view->getOldNewPassword();
        $Fuser = new FUtente();
        $utente = $Fuser->load($session->leggi_valore('email'));
        $utente->pwd = $pwds['new_password'];
        $Fuser->update($utente);

        $view_ricerca = USingleton::getInstance('VRicerca');
        $view_ricerca->displayProfiloUtente($utente);
    }

    /**
     * salva lo stato dell'utente e fa la display del profilo
     */
    public function setStatus() {
        $view = USingleton::getInstance("VRegistrazione");
        $dati = $view->getDatiStato();
        $session = USingleton::getInstance("USession");
        $fuser = new FUtente();
        $user = $fuser->load($session->leggi_valore("email"));
        $user->setStatus($dati["status"]);
        $fuser->update($user);
        $view_ricerca = USingleton::getInstance('VRicerca');
        $view_ricerca->displayProfiloUtente($user);
    }

    /**
     * invia la mail necessaria all'utente per attivare il proprio account
     */
    public function emailAttivazione($user) {
        $header = "From: Socialize";
        $oggetto = "Attivazione account Socialize";
        $messaggio = "Ciao " . $user->nome . " " . $user->cognome . "! Hai ricevuto questa mail poichè hai creato un account su Socialize associato a questo indirizzo email. Per confemare l'attivazione fai clic sul link sottostante:\n\nhttp://socialize.altervista.org?task=attivazione&email=" . $user->email . "&codice_attivazione=" . $user->codice . "";
        mail($user->email, $oggetto, $messaggio, $header);
    }

    /*
     * attiva l'utente che ha completato l'operazione tramite clic sul link presente nella mail ricevuta
     */

    public function attivazione() {
        $view = USingleton::getInstance('VRegistrazione');
        $data = $view->getDatiAttivazione();
        $Fuser = new FUtente();
        $user = $Fuser->load($data['email']);
        $user->attivazione = 1;
        $Fuser->update($user);
        $contenuto = array('main' => $view->setTemplate('conferma_attivazione.tpl'), 'side' => $view->setTemplate('vuoto.tpl'));
        return $contenuto;
    }

    /**
     * controlla se l'utente è loggato deve effettuare il login oppure se deve effettuare il logout
     */
    public function verificaSessione() {
        $autenticato = false;
        $session = USingleton::getInstance('USession');
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $task = $VRegistrazione->getTask();
        $this->email = $VRegistrazione->getEmail();
        $this->password = $VRegistrazione->getPassword();
        if ($session->leggi_valore('email') != false)
            $autenticato = true;

        elseif ($task == 'login') {
            //controlla autenticazione
            $autenticato = $this->autenticazione($this->email, $this->password);
        }
        if ($task == 'esci') {
            //logout
            $this->logout();
            $autenticato = false;
        }

        return $autenticato;
    }

    /**
     *  effettua il login
     */
    public function autenticazione($m, $p) {
        $view = USingleton::getInstance('VRegistrazione');
        $Fadmin = new FAdmin();
        $admin = $Fadmin->load($m);
        if ($admin != false) {
            if ($p == $admin->pwd) {
                $session = USingleton::getInstance('USession');
                $session->imposta_valore('email', $m);
                $session->imposta_valore('admin', true);
                $session->imposta_valore('password', $p);
                return true;
            }
        } else {
            $Fuser = new FUtente();
            $user = $Fuser->load($m);
            if ($user != false && $user->attivazione == 1) {
                if ($p == $user->pwd) {
                    $session = USingleton::getInstance('USession');
                    $session->imposta_valore('email', $m);
                    $session->imposta_valore('password', $p);
                    return true;
                }
                else
                    return false;
            }
            else
                return false;
        }
    }

    /**
     * effettua il logout
     */
    public function logout() {
        $session = USingleton::getInstance('USession');
        $session->cancella_valore('email');
        $session->cancella_valore('password');
        $session->cancella_valore('admin');
    }

    /*
     * verifica che l'email abbia il formato giusto
     */

    private function verificaEmail($d) {
        $pattern = '/^\w+@\w+\.[:alpha:]{2,3}$/';
        if (!preg_match($pattern, $d))
            return true;
        else
            return false;
    }

    public function setScript($s) {
        $this->script = $s;
    }

    /**
     * salva l'immagine del profilo dell'utente sul server
     */
    public function salvaImmagine() {

        $error = "";
        $msg = "";
        $fileElementName = 'fileToUpload2';
        if (!empty($_FILES[$fileElementName]['error'])) {
            switch ($_FILES[$fileElementName]['error']) {

                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;

                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        } elseif (empty($_FILES['fileToUpload2']['tmp_name']) || $_FILES['fileToUpload2']['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';
        } else {
            $msg .= "idimg=" . $_FILES['fileToUpload2']['name'];
            $target_path = "templates/template/images/" . basename($_FILES['fileToUpload2']['name']);
            @move_uploaded_file($_FILES['fileToUpload2']['tmp_name'], $target_path);
        }
        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "'\n";
        echo "}";
    }

    /**
     * carica dal db gli eventi in primo piano
     */
    public function EventiPrimopiano() {
        $session = USingleton::getInstance("USession");
        $fuser = new FUtente();
        $user = $fuser->load($session->leggi_valore("email"));
        $fevent = new FEvento();
        $query = "SELECT * FROM `evento` WHERE `citta`='" . $user->citta . "'ORDER BY `numVisite` DESC";
        if (is_bool($fevent->ricerca($query)))
            $query = "SELECT * FROM `evento` ORDER BY `numVisite` DESC";
        $event = $fevent->ricerca($query);
        return $event;
    }

    public function smista() {
        $view = USingleton::getInstance('VRegistrazione');
        switch ($view->getTask()) {
            case 'recupera_password':
                return $this->recuperaPassword();
            case 'salva':
                return $this->creaUtente();
            case 'attivazione':
                return $this->attivazione();
            case 'salva_immagine':
                return $this->SalvaImmagine();
            case 'modificaUtente':
                return $this->modificaUtente();
            case "cambiaStato":
                return $this->setStatus();
            case 'account_disponibile':
                return $this->accountDisponibile();
            case 'pwd_recuperabile':
                return $this->passwordRecuperabile();
            case 'verifica_old_pwd':
                return $this->controllaVecchiaPassword();
            case 'modifica_password':
                return $this->modificaPassword();
            default : {
                    if (!$this->verificaSessione()) {
                        $view->setProvince();
                        $view->setInteressi();
                        $result = array(
                            'side' => $view->setTemplate('registrazione_modulo.tpl'),
                            'main' => $view->setTemplate('contenuto_home.tpl'));
                    } else {
                        $session = USingleton::getInstance('USession');
                        if ($session->leggi_valore('admin')) {
                            $result = array(
                                'side' => $view->setTemplate('admin_main.tpl'),
                                'main' => $view->setTemplate('vuoto.tpl'));
                        } else {
                            if (is_bool($view->setPrimopiano($this->EventiPrimopiano())))
                                $result = array(
                                    'side' => $view->setTemplate('registrato_no_eventi.tpl'),
                                    'main' => $view->setTemplate('vuoto.tpl'));
                            else
                                $result = array(
                                    'side' => $view->setTemplate('registrato_main.tpl'),
                                    'main' => $view->setTemplate('vuoto.tpl'));
                        }
                    }
                    return $result;
                }
        }
    }

}

?>