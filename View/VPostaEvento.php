<?php

/**
 * @package View
 */
class VPostaEvento extends View {

    /**
     * restituisce i dati dell'evento da inserire
     * @return array
     */
    public function getDati() {
        $datitipo = array('nome', 'data', 'luogo', 'citta', 'categoria', 'descrizione', 'idimg');
        $dati = array();
        foreach ($datitipo as $data) {
            if (isset($_REQUEST[$data]))
                $dati[$data] = $_REQUEST[$data];
        }

        return $dati;
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
     * imposta il template passato per parametro
     */
    public function setTemplate($template) {
        return $this->fetch($template);
    }

    /**
     * restituisce il task da eseguire
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

}

?>