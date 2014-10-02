<?php

/**
 *  @package Controller
 */
class CComunicazione {

    /**
     *  permette a un utente di contattare un altro utente tramite la mail di socialize
     */
    public function inviaEmail() {

        $Vcom = USingleton::getInstance('VComunicazione');
        $session = USingleton::getInstance('USession');
        $datiemail = $Vcom->getDati();
        $datiemail['mittente'] = $session->leggi_valore("email");
        $header = "From: Socialize <" . $datiemail['mittente'] . ">\n";
        $messaggio = "Ciao!! L'utente " . $datiemail['mittente'] . " ti ha appena inviato un messaggio tramite Socialize:\n";
        $messaggio .=$datiemail['messaggio'];
        mail($datiemail['destinatario'], $datiemail['oggetto'], $messaggio, $header);
    }

    /**
     *  effettua la procedura di recupero password: manda una email all'utente con la password smarrita
     *  @return mixed o la mail o un boolean
     */
    public function recuperaPassword() {
        $Vcom = USingleton::getInstance('VComunicazione');
        $emailrecupero = $Vcom->getEmailSmarrimento();
        $Fuser = new FUtente();
        $user = $Fuser->load($emailrecupero);
        if ($user) {
            $header = "From: Socialize\n";
            $oggetto = "Recupero password Socialize";
            $messaggio = "Ciao " . $emailrecupero . "!! Hai effettuato la procedura di smarrimento password.\nTi ricordiiamo la tua password: " . $user->pwd . "";
            mail($emailrecupero, $oggetto, $messaggio, $header);
        }
        else
            return false;
    }

    public function smista() {
        $view = USingleton::getInstance('VComunicazione');
        switch ($view->getTask()) {
            case 'messaggio_email':
                return $this->inviaEmail();
            case 'recupera_password':
                return $this->recuperaPassword();
            case 'verifica_mail':
                return $this->verificaEsistenzaEmail();
        }
    }

}

?>