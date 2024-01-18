<?php

include_once './admin/actions/dbConnexion.php';



$sql = "SELECT * FROM produit";
$result = mysqli_query($conn, $sql); ?>

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

        <?php

        while ($row = mysqli_fetch_array($result)) {
        ?>

            <div class="card" style="width: 18rem;">
                <img src="<?php echo $row['photo'] ?>" class="card-img-top" alt="product image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['titre'] ?></h5>
                    <p class="card-text"><?php echo $row['designation'] ?></p>
                </div>
            </div>


        <?php
        }

        ?>

    </div>


</body>

</html>