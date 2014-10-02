<?php

/**
 * @package Entity
 */
class Eevento {

/**
 *
 * @var type string
 */
public $nome;
/**
 *
 * @var type string
 */
public $data;
/**
 *
 * @var type string
 */
public $citta;
/**
 *
 * @var type string
 */
public $luogo;
/**
 *
 * @var type string
 */
public $descrizione;
/**
 *
 * @var type string
 */
public $categoria;
/**
 *
 * @var type int
 */
public $numVisite=0;
/**
 *
 * @var type string
 */
public $idimg=null;
/**
 *
 * @AssociationType Entity.Eutente
 * @AssociationMultiplicity 0..* 
 */
public $partecipanti=array();     //array di EUtenti partecipanti
/**
 * @AssociationType Entity.Eutente
 * @AssociationMultiplicity 1
 */
public $organizzatore;           //un Eutente crea l'evento
/**
* @AssociationType Entity.ECommento
* @AssociationMultiplicity 0..*
*/
public $commenti = array();      //array di oggetti di tipo ECommento

/**
 * aggiunge un partecipante
 */
public function aggiungiPartecipante($persona) {
	$this->partecipanti[]=$persona;
        $this->numVisite++;
}

/**
 * elimina un partecipante
 */
public function eliminaPartecipante($persona) {
    unset($this->partecipanti[array_search($persona, $this->partecipanti)]);
    $this->numVisite--;
}

/**
 * aggiunge un commento
 */
public function aggiungiCommento( $commento ){
    array_push($commenti, $vcommento);
}

/**
 * aggiorna i dati dell'evento in seguito ad una modifica
 */
public function aggiornaEvento($date,$place,$description,$imm) {
   $this->data=$date;
   $this->luogo=$place;
   $this->descrizione=$description;
   $this->idimg=$imm;
}

/**
 * valida nome dell'evento
 */
public function setNome($n){     
         $pattern = '/^[a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\'\ ]+$/';
        if ( preg_match( $pattern, $n ) )
           {  
              $n=mysql_real_escape_string($n);
              $this->nome=$n;
           }
            else 
                $this->nome=false;         
}

/**
 * valida la data in modo tale che sia nel giusto formato e sia conforme al calendario gregoriano
 */
public function setData($d) {
      $pattern='/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
       if ( preg_match( $pattern, $d ) )
           {  
              $this->data=$d;
           }
            else {
                $this->data=false;
            }
    }

/**
 * valida il luogo
 */
public function setLuogo($l){
	$pattern = '/^[a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\'\.\,\ ]+$/';
        if ( preg_match( $pattern, $l ) )
           {  
              $l=mysql_real_escape_string($l);
              $this->luogo=$l;
           }
            else 
                $this->luogo=false;  
}

/**
 * valida la descrizione
 */
public function setDescrizione($d){
        $d=mysql_real_escape_string($d);
    	$this->descrizione=$d;
}


/**
 * inserisce i dati dell'evento validandone il contenuto tramite le set
 */
public function validaEvento($name, $date, $city, $where, $description, $category, $owner, $photo=NULL) {
	$this->setNome($name);
	$this->setData($date);
	$this->citta=$city;
	$this->setLuogo($where);
	$this->setDescrizione($description);
	$this->categoria=$category;
	$this->organizzatore=$owner;
    $this->idimg=$photo;
}
}


?>