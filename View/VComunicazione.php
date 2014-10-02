<?php

/**
 * @package View
 */
class VComunicazione extends View {
    
    /**
     * restituisce i dati dell'email da inviare: destinatario, oggetto e messaggio(body)
     * @return array
     */
    public function getDati() {
        $datitipo = array( 'destinatario','oggetto','messaggio');
        $dati=array();
        foreach ( $datitipo as $data ) {
            if( isset( $_REQUEST[ $data ] ) )
               $dati[ $data ] = $_REQUEST[ $data ];    
        }
 
        return $dati;    
    }
   
    /**
     * restituisce l'email dell'utente che vuole recuperare la password se selezionato altrimenti FALSE
     * @return mixed
     */
    public function getEmailSmarrimento(){
          if (isset ($_REQUEST['email_recupero']))
                 return $_REQUEST['email_recupero'];
         else return false;
    }
    
    /**
     * restituisce il task da eseguire
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }
}