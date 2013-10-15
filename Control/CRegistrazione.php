<?php

/*
 * Classe registrazione
 */

class CRegistrazione {
    
    //attributi
    private $email;
    private $password;
    
    //metodi
    public function CreaUtente(){
        /*
         * prendo i dati tramite il metodo dati della funzione getDati di VRegistrazione
         * controllo che email uguale non sia presente nella BD, poi controllo che password 
         * e la sua conferma coincidano. In caso di errori li salvo in un array e poi li passero'
         * a VRegistrazione.
         * Prima bisogna capire come usare Singleton per fare una sola istanza etc
         */
        
    }
    
    /*
     * email attivazione
     */
    public function EmailAttiv() {
        
    }
    
    /*
     * conferma attivazione
     */
    public function attivazione() {
        
    }
    
}

?>
