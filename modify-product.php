<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">

        <h1>Modifier Un Produit</h1>

        <?php

        include_once './admin/actions/dbConnexion.php';

        $productId = $_GET['id'];
        var_dump($productId);

        $sql = "SELECT * FROM produit WHERE id = '$productId'";
        $result = mysqli_query($conn, $sql);
        // conver our result into an array so we could get into each value of the row 
        $row = mysqli_fetch_array($result);

        ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="code-product" class="form-label">Code produit</label>
                <input type="text" class="form-control" id="code-product" name="code-product" value="<?php echo $row['code'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="titre-product" class="form-label">titre de produit</label>
                <input type="text" class="form-control" id="titre-product" name="titre-product" value="<?php echo $row['titre'] ?>">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo de produit</label>
                <input type="file" class="form-control" id="photo" name="photo" value="<?php echo $row['photo'] ?>">
            </div>
            <div class="mb-3">
                <label for="designation-product" class="form-label">Designation produit</label>
                <input type="text" class="form-control" id="designation-product" name="designation-product" value="<?php echo $row['designation'] ?>">
            </div>
            <div class="mb-3">
                <label for="prix-product" class="form-label">prix de produit</label>
                <input type="text" class="form-control" id="prix-product" name="prix-product" value="<?php echo $row['prix'] ?>">
            </div>

            <div class="mb-3">
                <select class="form-select" aria-label="Categorie" aria-placeholder="Caegories" name='category' value="<?php echo $row['categorie'] ?>">
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


        //modify them in the db

        $req = "UPDATE produit SET 
            titre = '$titreProduct',
            code = '$codeProduct',
            photo = '$lienphoto',
            designation = '$designation',
            categorie = '$category',
            prix = '$prix'
            WHERE id = '$productId';
        ";

        $result1 = mysqli_query($conn, $req);

        header('location:index.php');
        die();
    }
    ?>

</body>

</html>