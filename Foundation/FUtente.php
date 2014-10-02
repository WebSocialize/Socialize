<?php
/**
 * @package Foundation
 */
class FUtente extends FDb {
    //metodi
    public function __construct() {
        $this->tabella = 'utente';
        $this->key = 'email';
        $this->class = 'Eutente';
        USingleton::getInstance('FDb');
    }


    public function store($utente) {
        $i = 0;
        $values = '';
        $fields = '';
        foreach ($utente as $kay => $value) {
                if ($i == 0) {
                    $fields.='`' . $kay . '`';
                    $values.='\'' . $value . '\'';
                } else {
                    if ($kay != "interessi") {
                        $fields.=', `' . $kay . '`';
                        $values.=', \'' . $value . '\'';
                    }
                }
                $i++;
        }
        $query = 'INSERT INTO ' . $this->tabella . ' (' . $fields . ') VALUES (' . $values . ')';
        $return = $this->query($query);
            return $return;
        }
    
    public function update( $obj ){
        $fields ='';
        $i=0;
        foreach( $obj as $key=>$value ){
            if( $i==0){
                $fields = $fields."`".$key."`='".$value."'";
            }
            else{
                if($key != "interessi")
                    $fields = $fields.','."`".$key."`='".$value."'";
            $this->delete_interessi($obj->email);
            $this->store_interessi($obj->interessi,$obj->email);
            }
            $i++;
    
        }
        $arrayObject=get_object_vars($obj);
        $query = "UPDATE `".$this->tabella."` SET ".$fields." WHERE `email` ='".$arrayObject[$this->key]."'";
        $result = mysql_query($query);
        if( !$result )
            return FALSE;
        else 
            return true;
    }

    public function store_interessi($int, $email_guy) {
    	foreach ($int as $interesse)
    	{
            $query = "INSERT INTO `interesse`(`nome_interesse`, `email_utente`) VALUES ('" . $interesse . "', '" . $email_guy . "')";
        	$result = $this->query($query);
        }
        return true;
    }

    public function delete_interessi($email_guy){
        $query="DELETE FROM `interesse` WHERE `email_utente`='".$email_guy."'";
        $result = $this->query($query);
        return true;
    }

    public function ricerca($query) {
        $utenti = parent::ricerca($query);
        if(is_array($utenti)) {
            $num = count($utenti);
            for($i=0; $i<$num; $i++)
                $utenti[$i]->interessi = $this->load_interessi($utenti[$i]->email); 
        }
        elseif(is_object($utenti)) {
            $utenti->interessi = $this->load_interessi($utenti->email);
        }
        return $utenti;
    }

   /* public function load($mail){
        $utente=parent::load($mail);
        $utente->interessi=$this->load_interessi($mail);
        return $utente;
    }
*/

    public function load_interessi($email_guy) {
        $query = "SELECT * FROM `interesse` WHERE `email_utente`='" . $email_guy . "'";
        $result = mysql_query($query);
        $interessi = array();
        if ( $result != false ) {
            while ($row = mysql_fetch_assoc($result)) {
                $interessi[]=$row['nome_interesse'];
            }
        }
        return $interessi;
    }
}
?>
