<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$db_hostname = 'localhost';


$db_dbname   = 'ctiir6_db';


$db_username = 'root';


$db_password = '';

$db_charset = 'utf8';


try {
    $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_dbname", $db_username, $db_password);
    

    }
catch(PDOException $e)
    {
    echo " Erreur de la connexion avec la base de données";
    die();
    }
 ?>