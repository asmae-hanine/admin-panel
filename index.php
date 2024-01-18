<?php

include_once './admin/actions/dbConnexion.php';



$sql = "SELECT * FROM produit";
$result = mysqli_query($conn, $sql); ?>
<button><a href="ajout-product.php">ajout</a></button>
<table border="2px" width="100%">
    <tr>
        <th>id</th>
        <th>Titre</th>
        <th>code</th>
        <th>photo</th>
        <th>designation</th>
        <th>categorie</th>
        <th>prix</th>
        <th>action</th>
    </tr>

    <?php

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["titre"] ?></td>
            <td><?php echo $row["code"] ?></td>
            <td><img src="<?php echo $row["photo"] ?>" width="30px"></td>
            <td><?php echo $row["designation"] ?></td>
            <td><?php echo $row["categorie"] ?></td>
            <td><?php echo $row["prix"] ?></td>
            <td><a href="delete-product.php?id=<?php echo $row["id"] ?>">supprimer</a> <a href="modify-product.php?id=<?php echo $row["id"] ?>">Modifier</a> <a href="home.php?id=<?php echo $row["id"] ?>">Afficher</a></td>
        </tr>


    <?php
    }

    ?>
</table>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>