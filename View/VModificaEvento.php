<?php

/**
 * @package View
 */
class VModificaEvento extends View{

    /**
     * restituisce i dati del commento da inserire
     * @return array
     */
    public function getDatiCommento() {
        $datitipo = array('nome_evento', 'comment');
        $dati = array();
        foreach ($datitipo as $data) {
            if (isset($_REQUEST[$data]))
                $dati[$data] = $_REQUEST[$data];
        }
        return $dati;
    }

    /**
     * restituisce i dati per modificare l'evento
     * @return array
     */
    public function getNuoviDati() {
        $datitipo = array('nome', 'data', 'luogo', 'descrizione', 'idimg');
        $dati = array();
        foreach ($datitipo as $data) {
            if (isset($_REQUEST[$data]))
                $dati[$data] = $_REQUEST[$data];
        }
        return $dati;
    }

    /**
     * restituisce il nome dell'evento a cui deve pertecipante appartiene. La sua email viene presa dalle info di sessione
     * @return array
     */
    public function getDatiPartecipazione() {
        $dati["nome_evento"] = $_REQUEST["nome_evento"];
        return $dati;
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

?>
