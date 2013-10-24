<?php

/*
 * 
 */

class FDb{
    //attributi
    protected $tabella;     
    protected $key;
    protected $class;
    protected $connection;
    protected $result;
    protected $_auto_increment=false;


    //metodi
    public function __construct() {
        global $config;
        $this->connect($config['mysql']['host'], $config['mysql']['password'], $config['mysql']['user'], $config['mysql']['database']);
    }
    
    public function connect($host, $user, $password,$database) {
        /*
         * connessione al server mysql e connessione ad un database passato per parametro  
         */
    
        $this->connection = mysql_connect($host, $password, $user);
        if( !$this->connection ) {
            die( 'impossibile connettersi al server specificato' );
        }   
        else
            $selected = mysql_select_db ( $database, $this->connection );
        if( !$selected )
            die( 'impossibile connettersi al Db specificato' );
        
        return true;
    }
     
    
    
 /*   public function connect($host,$user,$password,$database) {
        $this->_connection=mysql_connect($host,$password,$user);
        if (!$this->_connection) {
            die('Impossibile connettersi al database: ' . mysql_error());
        }
        $db_selected = mysql_select_db($database, $this->_connection);
        if (!$db_selected) {
            die ("Impossibile utilizzare $database: " . mysql_error());
        }
        debug('Connessione al database avvenuta correttamente');

        $this->query('SET names \'utf8\'');
        return true;

    }
    */
    
    /*
     * restituisce un oggetto caricando dal database, predendo in ingresso la p.k.
     */
    /*public function load( $pk ){
        echo $tabella;
        echo $key;
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

    */
    
    public function load($key) {
        $query='SELECT * ' .
                'FROM `'.$this->tabella.'` ' .
                'WHERE `'.$this->key.'` = \''.$key.'\'';
        $ris = $this->query($query);
        if( $ris ){
            return $this->getObject();
        }
        else
            return false;    
    }

    public function query($query) {
        $this->result=mysql_query($query);
        debug($query);
        debug(mysql_error());
        if (!$this->result)
            return false;
        else
            return true;
    }
    public function getObject() { 
        $numero_righe=mysql_num_rows($this->result);
        //debug('Numero risultati:'. $numero_righe);
        if ($numero_righe>0) {
            $row = mysql_fetch_object($this->result,$this->class);
            $this->result=false;
            return $row;
        } else
            return false;
    }
    /*
     * salva un oggetto nel database
     */
    /*public function store( $obj ){
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
    }*/
        public function store($object) {
        $i=0;
        $values='';
        $fields='';
        foreach ($object as $kay=>$value) {
            if (!($this->_auto_increment && $kay == $this->key) && substr($kay, 0, 1)!='_') {
                if ($i==0) {
                    $fields.='`'.$kay.'`';
                    $values.='\''.$value.'\'';
                } else {
                    $fields.=', `'.$kay.'`';
                    $values.=', \''.$value.'\'';
                }
                $i++;
            }
        }
        $query='INSERT INTO '.$this->tabella.' ('.$fields.') VALUES ('.$values.')';
        $return = $this->query($query);
        if ($this->_auto_increment) {
            $query='SELECT LAST_INSERT_ID() AS `id`';
            $this->query($query);
            $result=$this->getResult();
            return $result['id'];
        } else {
            return $return;
        }
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
