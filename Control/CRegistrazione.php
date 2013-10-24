<?php

/*
 * Classe registrazione
 */

class CRegistrazione {
    
    //attributi
    private $email;
    private $password;
    private $errore='';

    //metodi
    public function CreaUtente(){
        /*
         * prendo i dati tramite il metodo dati della funzione getDati di VRegistrazione
         * controllo che email uguale non sia presente nella BD, poi controllo che password 
         * e la sua conferma coincidano. In caso di errori li salvo in un array e poi li passero'
         * a VRegistrazione.
         * Prima bisogna capire come usare Singleton per fare una sola istanza etc
         */
        $user = new FUtente();
        $view = USingleton::getInstance( 'VRegistrazione' );
        $dat_reg = $view->getDati();
             //dati immessi dall'utente
        $result=$user->load( $dat_reg[ 'email' ] ); 
        if( !$result ){
            //email non usata ancora
            if( $dat_reg['password']==$dat_reg['conf_password']){
                $utente = new Eutente($dat_reg['nome'], $dat_reg['cognome'], $dat_reg['giorno'], $dat_reg['mese'],$dat_reg['anno'],$dat_reg['sesso'], $dat_reg['password'], $dat_reg['comune'],$dat_reg['email']);
                $utente->generaCodiceAttivazione();
                $Fuser = new FUtente();
                $Fuser->store($utente);
                //$this->EmailAttiv();
            }
            else{
                //le password non coincidono
                $errore='Le password inserite non coincidono!';
            }
        }    
        else   $errore = 'usare un\' altra mail: quella inserita è già stata immessa!';
        if( !$this->errore ){
            $contenuto = array(
                'main'=> $view->setTemplate( 'conferma_registrazione.tpl' ),'side'=>$view->setTemplate('vuoto.tpl'));
                return $contenuto;
        }

    
}
    
    /*
     * email attivazione
     */
    public function EmailAttiv( Eutente $user ) {
        global $config;    //INSERIRE
        $vista = USingleton::getInstance( 'VRegistrazione' );
        $vista->setLayout( 'email_attivazione' );
        $vista->impostaDati( 'email',  $user->getEmail() );
        $vista->impostaDati( 'nome', $user->getNome().' '.$user->getCognome() );
        $vista->impostaDati( 'codice_attivazione',$utente->getCodiceAttivazione() );
        $vista->impostaDati( 'email_webmaster',$config['email_webmaster'] );
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance( 'UEmail' );
        return $email->invia_email( $utente->email,$utente->nome.' '.$utente->cognome,'Attivazione account Socialize',$corpo_email );
    }
    
    /*
     * attivazione
     */
    public function attivazione(  ) {
        $view = USingleton::getInstance( 'VRegistrazione' );
        $data = $view->getDatiAttivazione();
        $Fuser = new FUtente();
        $user = $Fuser->load( $data[ 'email' ] );
        $user->attivazione = true;
        $Fuser->update( $user );
        $view->setLayout('conferma_attivazione');
        
        return processaTemplate();
        
    }
    
    public function smista() {
        $view=USingleton::getInstance('VRegistrazione');
        switch ($view->getTask()) {
            case 'recupera_password':
                return $this->recuperaPassword();
            
            case 'salva':
                return $this->creaUtente();
            case 'attivazione':
                return $this->attivazione();
                
            default :
            {
                 $result = array(
                 'side'=> $view->setTemplate('registrazione_modulo.tpl'), 
                 'main'=> $view->setTemplate('contenuto_home.tpl') );
                 return $result;
            }    
        }
       
       
    }
    
    
    
}

?>
