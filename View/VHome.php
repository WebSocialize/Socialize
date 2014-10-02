<?php

/**
 * @package View
 */
class VHome extends View {

    //attributi
    public $_main_content;
    public $_side_content;
    public $_template;
    public $_errorenome;

    //metodi
    /**
     * imposta il contenuto principale della pagina
     */
    public function imposta_main($contenuto) {
        $this->_main_content = $contenuto;
    }

    /**
     * restituisce il contenuto laterale di una pagina
     */
    public function imposta_side($contenuto) {
        $this->_side_content = $contenuto;
    }

    /**
     * carica le province da inserire nelle possibili scelte da un apposito file
     */
    public function setProvince() {
        $handle = fopen('province.txt', 'r');
        //$result = array();
        $i = 0;
        while (!feof($handle)) {
            $buffer = fgets($handle);
            $buffer = rtrim($buffer);
            $result[$i] = trim($buffer, '');
            $i++;
        }
        fclose($handle);
        $this->assign('result', $result);
    }

    /**
     * carica le categorie da inserire nelle possibili scelte da un apposito file
     */
    public function setCategorie() {
        $handle = fopen('categorie.txt', 'r');
        //$result = array();
        $i = 0;
        while (!feof($handle)) {
            $buffer = fgets($handle);
            $buffer = rtrim($buffer);
            $result[$i] = trim($buffer, '');
            $i++;
        }
        fclose($handle);
        $this->assign('category', $result);
    }

    /**
     * carica gli interessi da inserire nelle possibili scelte da un apposito file
     */
    public function setInteressi() {
        $handle = fopen('interessi.txt', 'r');
        //$result = array();
        $i = 0;
        while (!feof($handle)) {
            $buffer = fgets($handle);
            $buffer = rtrim($buffer);
            $result[$i] = trim($buffer, '');
            $i++;
        }
        fclose($handle);
        $this->assign('listainteressi', $result);
    }

    /**
     * imposta la pagina per l'utente che ha effettuato il login
     */
    public function setPaginaRegistrato() {
        if ($this->_template != 'registrato_default.tpl') {
            $this->_template = 'registrato_default.tpl';
            $this->setProvince();
            $this->setCategorie();
            $this->setInteressi();
            $session = USingleton::getInstance('USession');
            $this->assign('main_content', $this->_main_content);
            $this->assign('side_content', $this->_side_content);
            $this->assign('user', $session->leggi_valore('email'));
            $this->display($this->_template);
        }
        else
            return fetch($this->_main_content);
    }

    /**
     * imposta la pagina per l'amministratore
     */
    public function setPaginaAdmin() {
        if ($this->_template != 'registrato_admin.tpl') {
            $this->_template = 'registrato_admin.tpl';
            $this->setProvince();
            $this->setCategorie();
            $this->setInteressi();
            $session = USingleton::getInstance('USession');
            $this->assign('main_content', $this->_main_content);
            $this->assign('side_content', $this->_side_content);
            $this->display($this->_template);
        }
        else
            return fetch($this->_main_content);
    }

    /**
     * imposta la pagina per l'utente che non ha effettuato il login/registrazione
     */
    public function setPaginaGuest() {
        if ($this->_template != 'home_default.tpl') {
            $this->_template = 'home_default.tpl';
            $this->setProvince();
            $this->setCategorie();
            $this->assign('main_content', $this->_main_content);
            $this->assign('side_content', $this->_side_content);
            $this->display($this->_template);
        } else {
            return $this->_main_content;
        }
    }

    /**
     * resituisce il controller che serve per smistare tra i vari compiti da effettuare
     */
    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }

   /**
    * verifica se si sta rispondendo ad una chiamata ajax
    */
    public function getAjax() {
        if (isset($_REQUEST['ajax']))
            return $_REQUEST['ajax'];
        else
            return false;
    }

}

?>
