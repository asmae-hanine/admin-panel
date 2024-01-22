<?php
session_start();
?>
<html lang="en">
<!-- head -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<?php
if (isset($_POST['submit'])) {

    $codeProduct = $_POST['code'];
    $titreProduct = $_POST['title'];
    $designation = $_POST['description'];
    $prix = $_POST['prix'];
    $category = $_POST['category'];

    $category = isset($_POST['category']) ? $_POST['category'] : null;


    $nomphoto = ''; // Initialize $nomphoto

    if (!empty($_FILES['photo']['name'])) {
        $nomphoto = $_FILES['photo']['name'];
        $nomphototemporaire = $_FILES['photo']['tmp_name'];
        $typephoto = $_FILES['photo']['size'];
        $errorphoto = $_FILES['photo']['error'];
        $cheminphoto = '../photos/';

        if (copy($nomphototemporaire, $cheminphoto . $nomphoto)) {
            $lienphoto = $cheminphoto . $nomphoto;
        } else {
            $lienphoto = '../photos/photo.jpg';
        }
    }

    // Add this block to handle the case where $_FILES['photo']['name'] is empty
    if (empty($nomphoto)) {
        $lienphoto = '../photos/default.jpg'; // Change this to the default image path you want to use
    }

    include_once 'dbConnexion.php';

    $req = "INSERT INTO produit (titre,code,photo,designation,categorie,prix)
          VALUES ('$titreProduct','$codeProduct','$lienphoto','$designation','$category','$prix')";
    $result = mysqli_query($conn, $req);

    header('location:../home-admin.php');
    die();
}
?>

<!-- nav bar -->
<?php
include('../imports/dashboard-header.php');
?>

<body>

    <div id="layoutSidenav">
        <!-- side nav  -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="../home-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="add.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Add a New Product
                        </a>
                        <a class="nav-link" href="../table-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Modify and Delete a Product
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['username'] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            <!-- the form  -->

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add New Product</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">New product</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            All the products
                        </div>
                        <div class="card-body">

                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Product code</label>
                                    <input type="text" class="form-control" id="code" name='code'>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" id="title" name='title'>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Product photo</label>
                                    <input type="file" class="form-control" id="photo" name='photo'>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product description</label>
                                    <input type="text" class="form-control" id="description" name='description'>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">price</label>
                                    <input type="text" class="form-control" id="price" name='prix'>
                                </div>
                                <select class="form-select mb-3" aria-label="categories" name='category'>
                                    <option selected disabled>Select One Category</option>
                                    <option value="tshirt">T-shirts</option>
                                    <option value="shirt">Shirts</option>
                                    <option value="sweater">Sweaters</option>
                                    <option value="hoodie">Hoodies</option>
                                    <option value="jean">Jeans</option>
                                    <option value="pants">Pants</option>
                                    <option value="shorts">Shorts</option>
                                    <option value="skirt">Skirts</option>
                                </select>
                                <div>
                                    <button type="submit" class="btn btn-primary" name='submit'>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <!-- the end of the table -->
            <!-- footer -->

            <?php
            include('../imports/dashboard-footer.php');
            ?>
        </div>
    </div>





    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../demo/chart-area-demo.js"></script>
    <script src="../demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>

</body>

</html>