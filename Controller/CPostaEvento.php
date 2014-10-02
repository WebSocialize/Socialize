<?php

/**
 * @package Controller
 */
class CPostaEvento {

    /**
     * crea l'evento con i dati inseriti dall'utente
     */
    public function CreaEvento() {
        $view = USingleton::getInstance('VPostaEvento');
        $vhome = USingleton::getInstance('VHome');
        $session = USingleton::getInstance('USession');
        $datiEvento = $view->getDati();
        $datiEvento['citta'] = rtrim($datiEvento['citta']); // perchè altrimenti presentava %0D%0A alla fine della stringa
        $datiEvento['categoria'] = rtrim($datiEvento['categoria']);
        if ($datiEvento['nome'] && $datiEvento['data'] && $datiEvento['luogo'] && $datiEvento['descrizione']) {
            $fuser = new FUtente();
            $organizzatore = $fuser->load($session->leggi_valore('email'));
            $evento = new Eevento();
            if (!isset($datiEvento['idimg']))
                $datiEvento['idimg'] = "eventodefaultimg.jpg";
            $evento->validaEvento($datiEvento['nome'], $datiEvento['data'], $datiEvento['citta'], $datiEvento['luogo'], $datiEvento['descrizione'], $datiEvento['categoria'], $organizzatore, $datiEvento['idimg']);
            $evento->aggiungiPartecipante($organizzatore);
            $Fevent = new FEvento();
            $Fevent->store($evento);
            $Fevent->store_partecipante($evento, $organizzatore->email);
            if ($vhome->getAjax() == "yes")
                return true;
            else {
                $contenuto = array('main' => $view->setTemplate('vuoto.tpl'), 'side' => $view->setTemplate('vuoto.tpl'));
                return $contenuto;
            }
        }
    }

    /**
     * salva l'immagine inserita dall'utente durante la creazione dell'evento
     */
    public function salvaImmagine() {

        $error = "";
        $msg = "";
        $fileElementName = 'fileToUpload';
        if (!empty($_FILES[$fileElementName]['error'])) {
            switch ($_FILES[$fileElementName]['error']) {

                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;

                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        } elseif (empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';
        } else {
            $msg .= "idimg=" . $_FILES['fileToUpload']['name'];
            $target_path = "templates/template/images/" . basename($_FILES['fileToUpload']['name']);
            @move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);
        }
        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "'\n";
        echo "}";
    }

    public function smista() {
        $view = USingleton::getInstance('VPostaEvento');
        switch ($view->getTask()) {
            case 'nuovo':
                return $this->creaEvento();
            case 'modifica':
                return $this->modificaEvento();
            case 'salva_immagine':
                return $this->salvaImmagine();
            default : {
                    $view->setProvince();
                    $view->setCategorie();
                    $result = array(
                        'side' => $view->setTemplate('postaevento_modulo.tpl'),
                        'main' => $view->setTemplate('vuoto.tpl')
                    );
                    return $result;
                }
        }
    }

}

?>