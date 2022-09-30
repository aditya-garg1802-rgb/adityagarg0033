<?php
require_once("header.php");
$preview= new PreviewProvider($exc,$userLoggedIn);
echo $preview->createPreviewVideo(null);
?>