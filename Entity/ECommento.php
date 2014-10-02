<?php
/**
 * @package Entity
 */
class ECommento{
    
    //attributi
    /**
     * @AssociationType Entity.Eutente
     * @AssociationMultiplicity 1
     */
    public $commentante;
    /**
     *
     * @var type string
     */
    public $commento;
    /**
     *
     * @var type int
     */
    public $id;

    //metodi
    public function setCommento($c){
    	$this->setCommento = $c;
    }
    /**
     * inserisce i valori nel commento appena creato
     */
    public function popolaCommento( $user, $comment) {
        $this->commentante=$user;
        $this->commento=$comment;
    }
}

?>
 
