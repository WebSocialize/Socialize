<?php

/**
 * @package Controller
 */
class CHome {
    //metodi

    /**
     * costruisce la pagina discriminando sui vari casi, anche nel caso in cui bisogna caricare solo una porzione della pagina.
     */
    public function costruisci() {
        $VHome = USingleton::getInstance('VHome');
        $session = USingleton::getInstance('USession');
        $CRegistrazione = USingleton::getInstance('CRegistrazione');
        $registrato = $CRegistrazione->verificaSessione();
        $contenuto = $this->smista();
        if (!$VHome->getAjax()) {
            if ($registrato) {
                if ($session->leggi_valore('admin')) {
                    $VHome->imposta_side($contenuto ['side']);
                    $VHome->imposta_main($contenuto['main']);
                    $VHome->setPaginaAdmin();
                } else {
                    $VHome->imposta_side($contenuto ['side']);
                    $VHome->imposta_main($contenuto['main']);
                    $VHome->setPaginaRegistrato();
                }
            } else {
                $VHome->imposta_side($contenuto ['side']);
                $VHome->imposta_main($contenuto['main']);
                $VHome->setPaginaGuest();
            }
        }
    }

    public function smista() {
        $view = USingleton::getInstance('VHome');
        switch ($view->getController()) {
            case 'creazione':
                $CPostaEvento = USingleton::getInstance('CPostaEvento');
                return $CPostaEvento->smista();
            case 'ricerca':
                $CRicerca = USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            case 'modifica_evento':
                $CModificaEvento = USingleton::getInstance('CModificaEvento');
                return $CModificaEvento->smista();
            case 'amministrazione':
                $CAmministrazione = USingleton::getInstance('CAmministrazione');
                return $CAmministrazione->smista();
            case 'comunicazione':
                $CComunicazione = USingleton::getInstance('CComunicazione');
                return $CComunicazione->smista();
            default:
                $CRegistrazione = USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
        }
    }

}

?>
