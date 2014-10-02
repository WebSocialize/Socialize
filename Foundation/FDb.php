<?php

/**
 * @package Foundation
 */
class FDb {

    //attributi
    protected $tabella;
    protected $key;
    protected $class;
    protected $connection;
    protected $result;
    protected $_auto_increment = false;
    protected $variabili;

    //metodi
    public function __construct() {
        global $config;
        $this->connect($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['database']);
    }

    /**
     *  connessione al server mysql e connessione ad un database passato per parametro
     */
    public function connect($host, $user, $password, $database) {
        $this->connection = mysql_connect($host, $user, $password);
        if (!$this->connection) {
            die('impossibile connettersi al server specificato');
        }
        $selected = mysql_select_db($database, $this->connection);
        if (!$selected)
            die('impossibile connettersi al Db specificato');
        return true;
    }

    /**
     * effettua la ricerca sul database
     * @return mixed Object o array di oggetti
     * @param string $query Query sql da effettuare al db
     */
    public function ricerca($query) {
        $this->query($query);
        return $this->getObjectArray();
    }

    /**
     * effettua la load di un oggetto dal db
     * @param mixed $key la chiave primaria della tabella
     */
    public function load($key) {
        $query = 'SELECT * ' .
                'FROM `' . $this->tabella . '` ' .
                'WHERE `' . $this->key . '` = \'' . $key . '\'';
        $this->query($query);
        return $this->getObject();
    }

    /**
     * effettua una query
     * @param string $query query sql
     * @return boolean
     */
    public function query($query) {
        $this->result = mysql_query($query);
        if (!$this->result)
            return false;
        else
            return true;
    }

    /**
     * restituisce un oggetto a partire dalla t-pla caricata dal db
     * @return boolean
     */
    public function getObject() {
        $numero_righe = mysql_num_rows($this->result);
        if ($numero_righe > 0) {
            $row = mysql_fetch_object($this->result, $this->class);
            $this->result = false;
            return $row;
        }
        else
            return false;
    }

    /**
     * restituisce un array di oggetti se ho più di una t-pla altrimenti un oggetto
     * @return boolean
     */
    public function getObjectArray() {
        $numero_righe = mysql_num_rows($this->result);
        if ($numero_righe == 1) {
            $row = mysql_fetch_object($this->result, $this->class);
            $this->result = false;
            return $row;
        } elseif ($numero_righe > 1) {
            $return = array();
            while ($row = mysql_fetch_object($this->result, $this->class)) {
                $return[] = $row;
            }
            $this->result = false;
            return $return;
        }
        else
            return false;
    }

    /**
     * carica una t-pla sul db a partire dall'oggetto
     * @param oggetto $object
     * @return type
     */
    public function store($object) {
        $i = 0;
        $values = '';
        $fields = '';
        foreach ($object as $kay => $value) {
            if (!($this->_auto_increment && $kay == $this->key) && substr($kay, 0, 1) != '_') {
                if ($i == 0) {
                    $fields.='`' . $kay . '`';
                    $values.='\'' . $value . '\'';
                } else {
                    $fields.=', `' . $kay . '`';
                    $values.=', \'' . $value . '\'';
                }
                $i++;
            }
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

    /**
     * chiusura della connessione al server mysql
     */

    public function close() {
        mysql_close($this->connection);
    }

    /**
     * cancellare la tupla determinata dalla chiave $key dal db
     * @param mixed $pk chiave primaria della tabella
     * @return boolean
     */

    public function delete($pk) {
        $query = "DELETE FROM `" . $this->tabella . "` WHERE `" . $this->key . "`='" . $pk . "'";
        $result = mysql_query($query);
        if (!$result)
            return false;
        else
            return TRUE;
    }

    /**
     * update della tupla determinata dalla chiave $key
     * @return boolean
     */
    public function update($obj) {
        $fields = '';
        $i = 0;
        foreach ($obj as $key => $value) {
            if ($i == 0)
                $fields = $fields . $key . '=' . $value;
            else
                $fields = $fields . ',' . $key . '=' . $value;
        }
        $arrayObject = get_object_vars($object);
        $query = "UPDATE'.$this->tabella.'SET'.$fields.'WHERE'.$key.'=" . $arrayObject[$this->key];
        $result = mysql_query($query);
        if (!$result)
            return FALSE;
        else
            return true;
    }

}

?>
