<?php

/**
 *  @package Controller
 */
class CAmministrazione {

    /**
     *  permette all'amministratore di eliminare un utente compresi i suoi commenti, partecipazioni ed eventi organizzati
     */
    public function eliminaUtente() {
        $Vadmin = USingleton::getInstance('VAmministrazione');
        $email = $Vadmin->getEmailUtente();
        //eliminare commenti, eventuali partecipazioni, eventi, e poi l'utente
        $Fcomment = new FCommento();
        $Fuser = new FUtente();
        $Fevent = new FEvento();
        $query = "DELETE FROM `commento` WHERE `email_utente`='" . $email . "'";
        $Fcomment->query($query);
        $query = "DELETE FROM `partecipanti` WHERE `email_utente`='" . $email . "'";
        $Fuser->query($query);
        $query = "SELECT * FROM `evento` WHERE `organizzatore`='" . $email . "'";
        $eventiorganizzati = $Fevent->ricerca($query);
        if (is_array($eventiorganizzati)) {
            foreach ($eventiorganizzati as $value) {
                $this->eliminaEvento($value->nome);
            }
        } elseif (is_object($eventiorganizzati))
            $this->eliminaEvento($eventiorganizzati->nome);
        $Fuser->delete_interessi($email);
        $Fuser->delete($email);
    }

    /**
     *  permette all'amministratore di eliminare un evento le partecipazioni, e i commenti legati all'evento
     */
    public function eliminaEvento($name = NULL) {

        if (isset($name))
            $nome = $name;
        else {
            $Vadmin = USingleton::getInstance('VAmministrazione');
            $nome = $Vadmin->getNomeEvento();
        }
        $Fcomment = new FCommento();
        $Fuser = new FUtente();
        $Fevent = new FEvento();
        $query = "DELETE FROM `commento` WHERE `nome_evento`='" . $nome . "'";
        $Fcomment->query($query);
        $query = "DELETE FROM `partecipanti` WHERE `nome_evento`='" . $nome . "'";
        $Fuser->query($query);
        $Fevent->delete($nome);
    }

    /**
     *  permette all'amministratore di eliminare un commento
     */
    public function eliminaCommento() {
        $Vadmin = USingleton::getInstance('VAmministrazione');
        $id = $Vadmin->getIdCommento();
        $Fcomment = new FCommento();
        $Fcomment->delete($id);
    }

    public function smista() {
        $view = USingleton::getInstance('VAmministrazione');
        switch ($view->getTask()) {
            case 'del_commento':
                return $this->eliminaCommento();
            case 'del_evento':
                return $this->eliminaEvento();
            case 'del_utente':
                return $this->eliminaUtente();
        }
    }

}