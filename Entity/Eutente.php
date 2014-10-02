<?php

/**
 * @package Entity
 */
class Eutente {

    //attributi
    /**
     *
     * @var type string
     */
    public $nome;

    /**
     *
     * @var type string
     */
    public $cognome;

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
     *
     * @var type string
     */
    public $data;

    /**
     *
     * @var type char
     */
    public $sesso;

    /**
     *
     * @var type string
     */
    public $citta;

    /**
     *
     * @var type string
     */
    public $codice;

    /**
     *
     * @var type string
     */
    public $immprofilo = "utentedefaultimg.jpg";

    /**
     *
     * @var type string
     */
    public $status = null;

    /**
     *
     * @var type int
     */
    public $attivazione = 0;
    public $interessi = array();

    /**
     * genera un codice di attivazione casuale per l'attivazione dell'account via mail
     */
    public function generaCodiceAttivazione() {
        $this->codice = mt_rand();
    }

    /**
     *   restituisce il nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * restituisce il cognome
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * restituisce il codice attivazione
     */
    public function getCodiceAttivazione() {
        return $this->codice;
    }

    /**
     * restituisce la data di nascita
     */
    public function getData() {
        return $this->data;
    }

    /**
     * restituisce il sesso
     */
    public function getSesso() {
        return $this->sesso;
    }

    /**
     * restituisce la citta'
     */
    public function getCitta() {
        return $this->citta;
    }

    /**
     * resituisce la pwd
     */
    public function getPwd() {
        return $this->pwd;
    }

    /**
     * restituisce l'email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * imposta il nome ed effettua la validazione
     * @param string $d
     */
    public function setNome($d) {
        $pattern = '/^[[:alpha:]]{3,20}$/';
        if (preg_match($pattern, $d)) {

            $this->nome = $d;
        }
        else
            $this->nome = false;
    }

    /**
     * imposta il cognome ed effettua la validazione
     * @param string $d
     */
    public function setCognome($d) {
        $pattern = '/^[a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27\'\ ]+$/';
        if (preg_match($pattern, $d)) {
            $d = mysql_real_escape_string($d);
            $this->cognome = $d;
        } else {
            $this->cognome = false;
        }
    }

    /**
     * imposta il sesso
     * @param string $d
     */
    public function setSesso($d) {
        $this->sesso = $d;
    }

    /**
     * imposta la data ed effettua la validazione
     * @param string $d
     */
    public function setData($d) {
        $pattern = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
        if (preg_match($pattern, $d)) {
            $this->data = $d;
        } else {
            $this->data = false;
        }
    }

    /**
     * imposta la password ed effettua la validazione
     * @param string $d
     */
    public function setPassword($d) {
        $pattern = '/^\w{8,20}$/';
        if (preg_match($pattern, $d)) {

            $this->pwd = $d;
        }
        else
            $this->pwd = false;
    }

    /**
     * imposta la mail ed effettua la validazione
     * @param string $d
     */
    public function setEmail($d) {
        $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        if (preg_match($pattern, $d)) {
            $user = new FUtente();
            $result = $user->load($d);
            if (!$result) {
                $this->email = $d;
            }
            else
                $this->email = false;
        }
        else
            $this->email = false;
    }

    /**
     * imposta la città
     * @param string $d
     */
    public function setCitta($d) {

        $this->citta = $d;
    }

    /**
     * imposta gli interessi
     * @param string $i
     */
    public function setInteressi($i) {

        $this->interessi = $i;
    }

    /**
     * imposta lo stato
     * @param string $stato
     */
    public function setStatus($stato) {
        $this->status = $stato;
    }

    /**
     * aggiorna le informazioni dell'utente
     * @param string $date
     * @param string $city
     * @param array $interest
     * @param string $image
     */
    public function aggiornaUtente($date, $city, $interest, $image) {
        $this->data = $date;
        $this->citta = $city;
        $this->interessi = $interest;
        $this->immprofilo = $image;
    }

    /**
     * valida le informazioni dell'utente per aggiungerle durante la creazione dell'utente usando i metodi set     
     * @param string $name
     * @param string $surname
     * @param string mail
     * @param string $pass
     * @param string $date
     * @param char $sex
     * @param string $city
     * @param array $interest
     */
    public function validaUtente($name, $surname, $mail, $pass, $date, $sex, $city, $interest) {
        $this->setNome($name);
        $this->setCognome($surname);
        $this->setEmail($mail);
        $this->setPassword($pass);
        $this->setData($date);
        $this->setSesso($sex);
        $this->setCitta($city);
        $this->setInteressi($interest);
    }

    /**
     * inserisce l'immagine del profilo dell'utente
     * @param string $image
     */
    public function inserisciImmagine($image) {
        $this->immprofilo = $image;
    }

}

?>
