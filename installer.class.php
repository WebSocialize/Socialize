<?php

/**
* Classe che gestisce l'installazione dell'applicazione
*@package Installer 
*/
class Installer {
        private $step = 0;
        private $sql = 'socialize.SQL';

        public function __construct(){
                echo '<html>
                <head>
                <title>Installazione Socialize</title>
                <link href="../socialize/templates/template/css/style.css" rel="stylesheet" type="text/css" />
                </head>
                <body>
                <div id="content">';
                
                /* In base ai dati inviati via POST, determina il prossimo step
                 * dell'installazione.
                 */
                if (isset($_POST['dbuser']))
                        $this->step = 1;
                if(isset($_POST['adminmail']))
                        $this->step = 2;
                        
                switch($this->step) {
                        //Step 0: credenziali db
                        case 0:
                                $this->getDBInfo();
                        break;
                        //Step 1: creazione config, credenziali admin
                        case 1:
                                if(!$_POST['dbuser'] || !$_POST['dbpassword']){
                                        echo '<p>Non hai riempito tutti i campi richiesti!</p><br />
                                        <a href="./installer.class.php">Torna indietro</a>';
                                        exit();
                                }
                                
                                
                                $file = fopen('includes/config.inc.php', 'w+')
                                        or die ('<p>Non hai permessi di scrittura in questa directory.</p><br/>
                                        <a href="./installer.class.php">Torna indietro</a>');
                                $config = '<?php
        global $config;
	$config["debug"]=false;
        $config["mysql"] = array(
                "host" => "localhost",
                "user" => "'. $_POST['dbuser'].'",
                "password" => "'. $_POST['dbpassword'].'",
                "database" => "socialize");
        $config["smarty"] = array(
                "template_dir" => "../socialize/templates/template/",
                "compile_dir" => "../socialize/templates/templates_c/",
                "config_dir" => "../socialize/templates/configs/",
                "cache_dir" => "../socialize/templates/cache/",
        );
?>';
                                fwrite($file, $config);
                                fclose($file);
                                        
                                echo'<h3>File di configurazione creato</h3><p>Non interrompere la procedura di installazione!</p>';
                                $this->getAdminInfo();
                        break;
                        //Step 2: popolamento del DB
                        case 2:
                                if ( $_POST['adminpassword'] != $_POST['adminpasswordconfirm'] ){
                                        echo 'Le password non corrispondono.';
                                        exit();
                                }
                                // Recuperiamo i dati forniti dall'admin poco fa
                                require_once './includes/config.inc.php';
                                // Connessione al dbms e creazione del nuovo database
                                mysql_connect($config['mysql']['host'],
                                        $config['mysql']['user'],
                                        $config['mysql']['password']);
                                try {
                                        mysql_query('DROP DATABASE IF EXISTS socialize');
                                        $this->importa_sql($this->sql);
                                        // Creazione del nuovo utente admin
					                    require_once 'Foundation/Utility/USingleton.php';
					                    require_once 'Foundation/FDb.php';
                                        require_once 'Foundation/FUtente.php';
                                        require_once 'Entity/Eutente.php';
                                        require_once 'Foundation/FAdmin.php';
                                        require_once 'Entity/EAdmin.php';
                                        $admin = new EAdmin();
                                        $admin->email=$_POST['adminmail'];
                                        $admin->pwd=$_POST['adminpassword'];
                                        // Il nuovo utente viene aggiunto al db
                                        $newadmin = new FAdmin();
                                        $newadmin->store($admin);
                                        echo'<h3>Installazione completata!</h3>
                                        <a href="./index.php">Vai all\'applicazione</a>';
                                }
                                catch (Exception $e){
                                        echo'<h3>Errore nella creazione del DB</h3>';
                                        echo $e;
                                        echo '<p>Controlla che le credenziali siano corrette e riprova.</p>';
                                        mysql_query('DROP DATABASE socialize');
                                }
                                mysql_close();
                }
                echo '</div></body></html>';
                
        }

        /* Crea una form per ottenere le credenziali d'accesso al DB
         */
        public function getDBInfo(){
                echo '<h2>Credenziali di accesso al database</h2>
<p>Questa procedura viene avviata quando non esiste il file includes/config.inc.php. Se in futuro vorrai reinstallare l\'applicazione ricordati di cancellare il file.</p>
                <p>Inserisci lo username e la password necessari per la connessione al database.</p>
                        <form method="POST" action="installer.class.php">
                        <label>Username:</label><input type="text" name="dbuser"/><br />
                        <label>Password:</label><input type="password" name="dbpassword"/> <br />
                        <button type="submit">Invia</button>
                </form>';
        }
        
        /* Form per le credenziali dell'amministratore del sito.
         */
        public function getAdminInfo(){
                echo '<h2>Credenziali dell\'amministratore</h2>
                <p>Inserisci una email e una password. Al termine dell\'installazione
                potrai usare queste credenziali per accedere all\'applicazione ed amministrarla.</p>
                        <form method="POST" action="installer.class.php">
                        <label>E-Mail:</label><input type="text" name="adminmail"/><br />
                        <label>Password:</label><input type="password" name="adminpassword"/> <br />
                        <label>Conferma password:</label><input type="password" name="adminpasswordconfirm"/> <br />
                        <button type="submit">Invia</button>
                </form>';
        }

        /* Legge un file .sql ed esegue le istruzioni che esso contiene
         */
        public function importa_sql($sqlfile) {
                // estraggo il contenuto del file
                $queries = file_get_contents($sqlfile);
                // Rimuovo eventuali commenti
                $queries = preg_replace(array('/\/\*.*(\n)*.*(\*\/)?/', '/\s*--.*\n/', '/\s*#.*\n/'), "\n", $queries);
                // recupero le singole istruzioni
                $statements = explode(";", $queries);
                $statements = preg_replace("/\s/", ' ', $statements);
                // ciclo le istruzioni
                foreach ($statements as $query) {
                        $query = trim($query);
                        if ($query) {
                                // eseguo la singola istruzione
                                $result = mysql_query($query);
                                // e stampo eventuali errori
                                if (!$result)
                                        throw new Exception('Impossibile eseguire la query ' . $query . ': ' . mysql_error());
                        }
                }
        }
}

$installer = New Installer();
?>