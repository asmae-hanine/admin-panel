<?php

include_once './admin/actions/dbConnexion.php';

// get the product id 
$productId = $_GET['id'];

//delete it from the produit table 
$req = "DELETE FROM produit WHERE id = '$productId'";


$result = mysqli_query($conn, $req);

//redirect the admin to the home page 

header('location: index.php');
