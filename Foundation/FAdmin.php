<?php

/**
 * @package Foundation
 */
class FAdmin extends FDb{

	public function __construct() {
        $this->tabella = 'amministratore';
        $this->key = 'email';
        $this->class = 'EAdmin';
        USingleton::getInstance('FDb');
    }
}