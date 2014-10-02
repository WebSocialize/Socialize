<?php

/**
 * @package Foundation
 */
class FEvento extends FDb {

    //metodi
    public function __construct() {
        $this->tabella = 'evento';
        $this->key = 'nome';
        $this->class = 'Eevento';
        USingleton::getInstance('FDb');
    }

    public function store_partecipante($evento, $email_guy) {
        $query = "INSERT INTO `partecipanti`(`nome_evento`, `email_utente`) VALUES ('" .$evento->nome. "', '" . $email_guy . "')";
        $result = $this->query($query);
        return $result;
    }

    public function delete_partecipante($evento, $email_guy) {
        $query = "DELETE FROM `partecipanti` WHERE `nome_evento`='" . $evento->nome . "' AND `email_utente`='" . $email_guy . "'";
        $result = $this->query($query);
        return $result;
    }
    
    public function load_partecipanti($nome_evento) {
        $query = "SELECT * FROM `partecipanti` WHERE `nome_evento`='" . $nome_evento . "'";
        $result = mysql_query($query);
        $partecipanti = array();
        if ( $result!=FALSE ) {
            while ($row = mysql_fetch_assoc($result)) {
                $fuser = new FUtente();
                $utente = $fuser->load($row['email_utente']);
                $partecipanti[] = $utente;
            }
        }

        return $partecipanti;
    }

    public function load_commenti($nome_evento) {
        $query = "SELECT * FROM `commento` WHERE `nome_evento`='" . mysql_real_escape_string($nome_evento) . "'";
        $result = mysql_query($query);
        $commenti = array();
        if ( $result != false ) {
            while ($row = mysql_fetch_assoc($result)) {
                $fcomment = new FCommento();
                $comment = $fcomment->load($row["id"], $nome_evento);
                $commenti[] = $comment;
            }
        }

        return $commenti;
    }
    

    public function load($nome_evento) {
        $evento = parent::load($nome_evento);
        $fuser = new FUtente();
        $evento->organizzatore = $fuser->load($evento->organizzatore);
        $evento->partecipanti = $this->load_partecipanti($nome_evento);
        $evento->commenti =$this->load_commenti($nome_evento);
        return $evento;
    }

    public function ricerca($query) {
        $evento = parent::ricerca($query);
        $fuser = new FUtente();
        if(is_array($evento)) {
            $num = count($evento);
            for($i=0; $i<$num; $i++){
                $evento[$i]->organizzatore = $fuser->load($evento[$i]->organizzatore);
                $evento[$i]->partecipanti = $this->load_partecipanti($evento[$i]->nome);
                $evento[$i]->commenti=$this->load_commenti($evento[$i]->nome);   
            }
        }
        elseif(is_object($evento)) {
            $evento->organizzatore = $fuser->load($evento->organizzatore);
            $evento->partecipanti = $this->load_partecipanti($evento->nome);
            $evento->commenti=$this->load_commenti($evento->nome);
        };

        return $evento;
    }
    
    public function store($evento) {
        $email = $evento->organizzatore->email;
        $cloned = clone($evento);
        $cloned->organizzatore = $email;
        $i = 0;
        $values = '';
        $fields = '';
        foreach ($cloned as $kay => $value) {
                if ($i == 0) {
                    $fields.='`' . $kay . '`';
                    $values.='\'' . $value . '\'';
                } else {
                    if ($kay != "partecipanti" && $kay != "commenti") {
                        $fields.=', `' . $kay . '`';
                        $values.=', \'' . $value . '\'';
                    }
                }
                $i++;
            
        }
        $query = 'INSERT INTO ' . $this->tabella . ' (' . $fields . ') VALUES (' . $values . ')';
        $return = $this->query($query);
        if ($this->_auto_increment) {
            $query = 'SELECT LAST_INSERT_ID() AS `id`';
            $this->query($query);
            $result = $this->getResult();
            return $result['id'];
        } else {
            return $return;
        }
    }

        public function update( $obj ){
        $fields ='';
        $i=0;
        foreach( $obj as $key=>$value ){
            if( $i==0){
                $fields = $fields."`".$key."`='".$value."'";
            }
            else{
                if($key != "partecipanti" && $key != "commenti" && $key != "organizzatore")
                    $fields = $fields.','."`".$key."`='".$value."'";
                elseif($key == "organizzatore")
                    $fields = $fields.','."`".$key."`='".$value->email."'";
            }
            $i++;
    
        }
        $arrayObject=get_object_vars($obj);
        $query = "UPDATE `".$this->tabella."` SET ".$fields.' WHERE '."`nome`"."='".mysql_real_escape_string($arrayObject[$this->key])."'";
        $result = mysql_query($query);
        if( !$result )
            return FALSE;
        else 
            return true;
    }
    
}

?>
