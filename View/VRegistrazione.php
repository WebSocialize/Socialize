<?php

class VRegistrazione extends View{
    
    //attributi
    
    //metodi
    
    /*
     * metodo per prendere il nome dai dati inseriti dall'utente 
     */
    public function getEmail() {
        if( isset( $_REQUEST[ 'email' ] ) ) 
            return $_REQUEST[ 'email' ];
        else
            return FALSE;
    }
    
    /*
     * ritorna la password inserita dall'utente
     */
    public function getPassword() {
        if( isset( $_REQUEST[ 'password' ] ) )
            return $_REQUEST[ 'password' ];
        else
            return false;
    }
    
    /*
     * restituisce i dati inseriti nella form per la restituzione e li inserisce in un array
     */
    /*public function getDati() {
        $datitipo = array( 'nome', 'cognome', 'email', 'password', 'conf_password', 'data_nas','sesso', 'comune' );
        $dati=array();
        foreach ( $datitipo as $data ) {
            if( isset( $_REQUEST[ $data ] ) )
              {  $dati[ $data ] = $_REQUEST[ $data ];
                echo $dati[$data];}
        }
        return $dati;    
    }*/

    public function getDati() {
        $datitipo = array( 'nome', 'cognome', 'email', 'password', 'conf_password', 'giorno','mese','anno','sesso', 'comune' );
        $dati=array();
        foreach ( $datitipo as $data ) {
            if( isset( $_REQUEST[ $data ] ) )
               $dati[ $data ] = $_REQUEST[ $data ];    
        }
        return $dati;    
    }
    
    /*
     * imposta l'errore per visualizzare l'errore
     */
    public function stampaErrore( $errore ){
        //assegna $errore al template relativo
    }
    
    public function getDatiAttivazione() {
        if(isset($_REQUEST['codice_attivazione']) && isset($_REQUEST['email']))
            return array('codice'=>$_REQUEST['codice_attivazione'], 'username'=>$_REQUEST['username']);
        else
            return false;
    }
    
    public function setTemplate( $template ){
        $registrazione = USingleton::getInstance( 'VRegistrazione' );
        return $registrazione->fetch( $template );
    }
    
        public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }
}

?>
