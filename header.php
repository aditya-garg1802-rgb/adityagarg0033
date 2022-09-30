<?php
require_once("config.php");
require_once("previewprovider.php");
require_once("entity.php");
if(!isset($_SESSION["userLoggedIn"]))
{
    header("Location: registeruser.php");
}
$userLoggedIn=$_SESSION["userLoggedIn"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Adiflix</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div class='wrapper'>
    