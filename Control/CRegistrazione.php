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
        $view = USingleton::getInstance( 'VRegistrazione' );
        $dat_reg = $view->getDati();       //dati immessi dall'utente
        $result = load( $dat_reg[ 'email' ] );
        $errore;
        if( !$result ){
            //email non usata ancora
            if( $dat_reg[ 'password' ] == $dat_reg[ 'conf_password' ]){
                $utente = new Eutente($dat_reg['nome'], $dat_reg['cognome'], $dat_reg['data_nas'], $dat_reg['password'], $dat_reg['sesso'], $dat_reg['email'], $dat_reg['citta']);
                $utente->generaCodiceAttivazione();
                $Fuser = new FUtente();
                $Fuser->store($utente);
                $this->EmailAttiv();
            }
            else{
                //le password non coincidono
                $errore = 'Le password inserite non coincidono!';
            }
        }    
        else{
            $errore = 'usare un\' altra mail: quella inserita è già stata immessa!';
        }
        
        if( !$errore ){
            /*
             * DOBBIAMO VEDERE LA PARTE RELATIVA AI TEMPLATE!!!
             */
        }
    }
    
    /*
     * email attivazione
     */
    public function EmailAttiv() {
        
    }
    
    /*
     * attivazione
     */
    public function attivazione() {
        
    }
    
}

?>
