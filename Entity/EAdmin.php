<?php

/**
 * @package Entity
 */
class EAdmin {

    /**
     *
     * @var type string
     */
    public $email;
    /**
     *
     * @var type string
     */
    public $pwd;

    /**
     *  inserisce i valori nell'amministratore appena creato
     * @param string mail 
     * @param string $pass
     */
    public function popolaAdmin($mail, $pass) {
        $this->email = $mail;
        $this->pwd = $pass;
    }

}