<?php

class VHome extends View{
    //attributi
    public $_main_content;
    public $_side_content;
    public $_template = 'default';
    
    //metodi
    public function imposta_main( $contenuto ){
        $this->_main_content = $contenuto;
    }
    
    public function imposta_side( $contenuto ){
        $this->_side_content = $contenuto;
    }
    
    public function setPagina(){
        $this->assign( 'main_content', $this->_main_content );
        $this->assign( 'side_content', $this->_side_content );
        $this->display( 'home_'.$this->_template.'.tpl' );
    }
    
    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }
    
}

?>
