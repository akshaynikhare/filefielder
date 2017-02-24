<?php
include "Opration.php";
$op= new Opration();
$op->EXPC();
session_start();
session_destroy();
header('location:index.php');
?>