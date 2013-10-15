<?php

/*
 * 
 */

class FDb{
    //attributi
    protected $tabella;     //
    protected $key;
    protected $class;
    protected $connection;


    //metodi
    public function __construct() {
        ;
    }
    
    public function connect($dataBase, $user, $password) {
        /*
         * connessione al server mysql e connessione ad un database passato per parametro  
         */
        $this->connection = mysql_connect('localhost', $user, $password);
        if( !$this->connection ) {
            die( 'impossibile connettersi al server specificato' );
        }
        else
            $selected = mysql_select_db ( $dataBase, $this->connection );
        if( !$selected )
            die( 'impossibile connettersi al Db specificato' );
        
        return true;
    }
    
    /*
     * restituisce un oggetto caricando dal database, predendo in ingresso la p.k.
     */
    public function load( $pk ){
        $query = sprintf("SELECT * FROM '{$this->tabella}' WHERE '{$pk}'='{$key}'");
        $result = mysql_query($query);
        if( !$result )
            die( 'query failed' );
        else {
            //resituisco l'oggetto richiesto
            $obj = mysql_fetch_object( $result, $this->class);
            
            return $obj;
        }
    }
    
    /*
     * salva un oggetto nel database
     */
    public function store( $obj ){
        $i = 0;
        $campo = '';
        $valore = '';
        foreach( $obj as $key => $value ){
            if( $i==0 ){
                $campo = $campo.$key;
                $valore = $valore.$value;
            }
            else{
                $campo = $campo.','.$key;
                $valore = $valore.','.$value;
            }
        
        }    
        
        $query = "INSERT into '.$this->tabella.'('.$campo.') VALUES ('.$valore.')";    
        $result = mysql_query($query);
        if( !$result )
            return false;
        else
            return true;
    }
    
    /*
     * chiusura della connessione al server mysql
     */
    public function close(){
        mysql_close($this->connection);
    }
    
    /*
     * cancellare la tupla determinata dalla chiave $key dal db
     */
    public function delete($key){
        $query = "DELETE FROM '.$this->tabella.'WHERE'.$pk.'=".$key;
        $result = mysql_query($query);
        if( !$result )
            return false;
        else
            return TRUE;
    }
    
    /*
     * update della tupla determinata dalla chiave $key
     */
    public function update( $obj ){
        $fields ='';
        $i=0;
        foreach( $obj as $key=>$value ){
            if( $i==0)
                $fields = $fields.$key.'='.$value;
            else
                $fields = $fields.','.$key.'='.$value;
    
        }
        $arrayObject=get_object_vars($object);
        $query = "UPDATE'.$this->tabella.'SET'.$fields.'WHERE'.$key.'=".$arrayObject[$this->key];
        $result = mysql_query($query);
        if( !$result )
            return FALSE;
        else 
            return true;
    }
    
    
    
}
?>
