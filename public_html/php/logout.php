<?php
session_start();
session_destroy();
$ultimaPag = isset($_GET["de"]) ? "../" : $_GET["de"];
header("location:$ultimaPag");
?>