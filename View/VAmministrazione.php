<?php

/**
 * @package View
 */
class VAmministrazione extends View{

    /**
     * resituisce l'id del commento da cancellare se selezionato altrimenti FALSE
     * @return mixed
     */
    public function getIdCommento() {
        if (isset($_REQUEST['idcomm']))
            return $_REQUEST['idcomm'];
        else
            return false;
    }

    /**
     * restituisce l'email dell'utente da cancellare se selezionato altrimenti FALSE
     * @return mixed
     */
    public function getEmailUtente() {
        if (isset($_REQUEST['mail']))
            return $_REQUEST['mail'];
        else
            return false;
    }

     /**
     * restituisce il nome dell'evento da cancellare se selezionato altrimenti FALSE
     * @return mixed
     */
    public function getNomeEvento() {
        if (isset($_REQUEST['nomeevento']))
            return $_REQUEST['nomeevento'];
        else
            return false;
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