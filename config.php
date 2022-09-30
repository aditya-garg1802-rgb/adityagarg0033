<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");
try{
    $exc=new PDO("mysql:dbname=adiflix;host=localhost","root","");
    $exc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e){
    echo "Conection failed: " .$e->getMessage();
}
?>