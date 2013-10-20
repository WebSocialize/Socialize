<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;

$config['smarty']['template_dir'] =
'C:\xampp\htdocs\progetto_bookstore\bookStore\templates\main\template';
$config['smarty']['compile_dir'] =
'C:\xampp\htdocs\progetto_bookstore\bookStore\templates\main\templates_c';
$config['smarty']['config_dir'] =
'C:\xampp\htdocs\progetto_bookstore\bookStore\templates\main\configs';
$config['smarty']['cache_dir'] =
'C:\xampp\htdocs\progetto_bookstore\bookStore\templates\main\cache';

$config['debug']=false;
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'pippo';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'bookstore';

//configurazione server smtp per invio email
$config['smtp']['host'] = 'smtp.live.com';
$config['smtp']['port'] = '25';
$config['smtp']['smtpauth'] = true;
$config['smtp']['username'] = 'davide-cichella@hotmail.it';
$config['smtp']['password'] = '';

$config['email_webmaster']='davide-cichella@hotmail.it';
$config['url_bookstore']='http://localhost/bookstore2/';

function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>
