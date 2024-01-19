<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<div class="container">

    <h1>Ajouter Un </h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="code-product" class="form-label">Code produit</label>
            <input type="text" class="form-control" id="code-product" name="code-product" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="titre-product" class="form-label">titre de produit</label>
            <input type="text" class="form-control" id="titre-product" name="titre-product" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo de produit</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <div class="mb-3">
            <label for="gesignation-product" class="form-label">Designation produit</label>
            <input type="text" class="form-control" id="designation-product" name="designation-product">
        </div>
        <div class="mb-3">
            <label for="prix-product" class="form-label">prix de produit</label>
            <input type="text" class="form-control" id="prix-product" name="prix-product">
        </div>

        <div class="mb-3">
            <select class="form-select" aria-label="Categorie" aria-placeholder="Caegories" name='category'>
                <option value="pantalon">pantalon</option>
                <option value="pijamas">pijamas</option>
                <option value="t-shirt">T-shhirt</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Enregistrer</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $codeProduct = $_POST['code-product'];
    $titreProduct = $_POST['titre-product'];
    $designation = $_POST['designation-product'];
    $prix = $_POST['prix-product'];
    $category = $_POST['category'];


    if (!empty($_FILES['photo']['name'])) {

        var_dump($_FILES);
        // die();
        $nomphoto = $_FILES['photo']['name'];

        $nomphototemporaire = $_FILES['photo']['tmp_name'];
        $typephoto = $_FILES['photo']['size'];

        $errorphoto = $_FILES['photo']['error'];

        $cheminphoto = 'photos/';

        if (copy($nomphototemporaire, $cheminphoto . $nomphoto)) {
            $lienphoto = $cheminphoto . $nomphoto;
        } else {
            $lienphoto = 'photos/photo.jpg';
        }
    }

    include_once 'dbConnexion.php';

    $req = "INSERT INTO produit (titre,code,photo,designation,categorie,prix)
          VALUES ('$titreProduct','$codeProduct','$lienphoto','$designation','$category','$prix')";
    $result = mysqli_query($conn, $req);

    header('location: index.php');
}



?>



<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>