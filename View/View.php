<?php
/*
 * classe view inizializza smarty e il suo ambiente di lavoro
 */

require 'lib/smarty/Smarty.class.php';

class View extends Smarty {
    public function __construct() {
        $this->smarty();
        $this->template_dir = 'templates/template';
        $this->compile_dir = 'templates/templates_c';
        $this->config_dir = 'templates/configs';
        $this->cache_dir = 'templates/cache';
    }
    
    /*
     * funzione che assegna un template passato come parametro
     */
    public function setTemplate( $template ){
        $this->display( $template );
    }
    
}


?>
