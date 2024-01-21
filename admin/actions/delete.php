<?php

include_once 'dbConnexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM produit WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

header('location:../table-admin.php');
die();
