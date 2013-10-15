<?php

class FUtente extends FDb {
    //metodi
    public function __construct() {
        $this->tabella = 'utente';
        $this->key = 'email';
        $this->class = 'EUtente';
        USingleton :: getInstance('FDb');    //mettere USingleton nella cartella
    }
}
?>
