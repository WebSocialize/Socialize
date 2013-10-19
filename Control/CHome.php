<?php

class CHome{
    //metodi
 
    public function costruisci(){
        $VHome = USingleton::getInstance( 'VHome' );
        
       // $CRegistrazione=USingleton::getInstance('CRegistrazione');
       // $registrato=$CRegistrazione->getUtenteRegistrato();
        $contenuto=$this->smista();
        $VHome->imposta_side( $contenuto );
       /* if ($registrato) {
         *   $VHome->impostaPaginaRegistrato();
        *} else {
        *   $VHome->impostaPaginaGuest();
        }
        * 
        */
        $VHome->mostraPagina();
    }
    
    public function smista(){
        
        $view=USingleton::getInstance('VHome');
       // switch ($view->getController()) {
       //   case 'registrazione':
                $CRegistrazione=USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
       /*     case 'ricerca':
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            case 'ordine':
                $COrdine=USingleton::getInstance('COrdine');
                return $COrdine->smista();
            default:
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->ultimiArrivi();
        }
        
        */
    }
}

?>
