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
    public function getDati() {
        $dati = array( 'nome', 'cognome', 'email', 'password', 'conf_password', 'sesso', 'citta', 'data_nas' );
        foreach ( $dati as $data ) {
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
}

?>
