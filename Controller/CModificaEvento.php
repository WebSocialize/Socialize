<?php

/**
 * @package Controller
 */
class CModificaEvento {

    /**
     * funzione che carica il commento sul database
     */

    public function creaCommento() {
        $view = USingleton::getInstance("VModificaEvento");
        $datiComment = $view->getDatiCommento();
        foreach ($datiComment as $data => $value)
            $datiComment[$data] = mysql_real_escape_string($value);
        $fuser = new FUtente();
        $session = USingleton::getInstance("USession");
        $user = $fuser->load($session->leggi_valore("email"));
        $ecomment = new ECommento();
        $ecomment->popolaCommento($user, $datiComment['comment']);
        $fcomment = new FCommento($ecomment);
        $fcomment->store($ecomment, $datiComment["nome_evento"]);
        $fevent = new FEvento();
        $event = $fevent->load($datiComment["nome_evento"]);
        $view_ricerca = USingleton::getInstance("VRicerca");
        $view_ricerca->displayProfiloEvento($event);
    }

    /**
     * salva l'immagine dell'evento
     */
    public function salvaImmagine() {

        $error = "";
        $msg = "";
        $fileElementName = 'fileToUpload3';
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
        } elseif (empty($_FILES['fileToUpload3']['tmp_name']) || $_FILES['fileToUpload3']['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';
        } else {
            $msg .= "idimg=" . $_FILES['fileToUpload3']['name'];
            $target_path = "templates/template/images/" . basename($_FILES['fileToUpload3']['name']);
            @move_uploaded_file($_FILES['fileToUpload3']['tmp_name'], $target_path);
        }
        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "'\n";
        echo "}";
    }

    /**
     * aggiunge (o elimina) un partecipante all'evento 
     */
    public function AddPartecipante() {
        $view = USingleton::getInstance("VModificaEvento");       //prendo i dati dell'evento
        $dati = $view->getDatiPartecipazione();
        $session = USingleton::getInstance("USession");           //e dell'utente
        $fuser = new FUtente();
        $user = $fuser->load($session->leggi_valore("email"));    //carico l'EUtente dal db
        $fevent = new FEvento();
        $dati["nome_evento"] = mysql_real_escape_string($dati['nome_evento']);
        $event = $fevent->load($dati["nome_evento"]);            //carico l'Eevento dal db
        $trovato = false;
        foreach ($event->partecipanti as $value) {
            if ($value->email == $session->leggi_valore("email") & !$trovato) {
                $event->eliminaPartecipante($user);
                $fevent->delete_partecipante($event, $user->email);
                $trovato = true;
            }
        }
        if (!$trovato) {
            $event->aggiungiPartecipante($user);
            $fevent->store_partecipante($event, $user->email);
        }
        $fevent->update($event);                                  //salvo le modifiche sul db

        $view_ricerca = USingleton::getInstance("VRicerca");

        $view_ricerca->displayProfiloEvento($event);
    }

    /**
     * modifica l'evento e lo aggiorna sul db
     */
    public function ModificaEvento() {
        $view = USingleton::getInstance('VModificaEvento');
        $nuovi_dati = $view->getNuoviDati();
        $Fevent = new FEvento();
        $evento = $Fevent->load($nuovi_dati['nome']);
        $evento->aggiornaEvento($nuovi_dati['data'], $nuovi_dati['luogo'], $nuovi_dati['descrizione'], $nuovi_dati['idimg']);
        $Fevent->update($evento);
        $view_ricerca = USingleton::getInstance('VRicerca');
        $view_ricerca->displayProfiloEvento($evento);
    }

    public function smista() {
        $view = USingleton::getInstance('VModificaEvento');
        switch ($view->getTask()) {
            case 'inserisci':
                return $this->creaCommento();
            case 'add_partec':
                return $this->AddPartecipante();
            case 'salva_immagine':
                return $this->salvaImmagine();
            case 'modificaevento':
                return $this->ModificaEvento();
        }
    }

}

?>
