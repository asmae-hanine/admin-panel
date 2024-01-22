<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="./css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- connect to the data base -->

    <?php
    include_once './actions/dbConnexion.php';

    // select the element from the db 

    $sql = "SELECT * FROM produit";
    $result = mysqli_query($conn, $sql);
    ?>

    <?php
    include('./imports/dashboard-header.php')
    ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="home-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="actions/add.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Add a New Product
                        </a>
                        <a class="nav-link" href="table-admin.php">
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

            <!-- the table  -->
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            All the products
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">title</th>
                                        <th scope="col">photo</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Categorie</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Modifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td scope='row'><?php echo $row["code"] ?></td>
                                            <td><?php echo $row["titre"] ?></td>
                                            <td><img src='photos/<?php echo $row["photo"] ?>' width="30px"></td>

                                            <td><?php echo $row["designation"] ?></td>
                                            <td><?php echo $row["categorie"] ?></td>
                                            <td><?php echo $row["prix"] ?> $</td>
                                            <td>
                                                <a class="btn btn-primary" href="actions/add.php">Add</a>
                                                <a class="btn btn-success" href="actions/modify.php?id=<?php echo $row["id"] ?>">Modify</a>
                                                <a class="btn btn-danger" href='actions/delete.php?id=<?php echo $row['id'] ?>'>Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>
            <!-- the end of the table -->
            <?php
            include('./imports/dashboard-footer.php');
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="demo/chart-area-demo.js"></script>
    <script src="demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>