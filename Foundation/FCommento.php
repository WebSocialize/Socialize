<?php

/**
 * @package Foundation
 */
class FCommento extends FDb{
    public function __construct() {
        $this->tabella = 'commento';
        $this->key = 'id';
        $this->class = 'ECommento';
        $this->_auto_increment= true;
        USingleton::getInstance('FDb');
    }
    
    public function store( $com, $nome_evento=null ){
        $insert = "INSERT INTO commento (`commentante`, `commento`,`nome_evento`) VALUES ('".$com->commentante->email."', '".$com->commento."', '".$nome_evento."')";
        $result = $this->query( $insert ); 
     /*   $query = 'SELECT LAST_INSERT_ID() AS `id`';
        $this->query($query);
        $result = $this->getResult();
        $com->id= $result['id'];*/
    }
    
    public function load( $id_com ){
        $commento = parent::load( $id_com );
        $fuser = new Futente();
        $fevent = new FEvento();
        $user = $fuser->load( $commento->commentante);
        $commento->commentante = $user;
       
        return $commento;
    }
    
    

}
    
?>
