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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register - SB Admin</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https  ://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<?php

include_once '../actions/dbConnexion.php';

if (isset($_POST['submit'])) {
    // get all the input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    //make sure the username isnt empty
    if (empty($username)) {
        // make sure the email isnt already on the db
        echo ('Make sure you enter a valide username');
        die();
    }
    if (empty($email)) {
        // make sure the email isnt already on the db
        echo ('Make sure you enter an email');
        die();
    }
    if (empty($password) && empty($password_confirm)) {
        // make sure the email isnt already on the db
        echo ('Make sure you enter password');
        die();
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        if (mysqli_num_rows($result) > 0) {
            echo ('This email is already in our database , choose another one or <a href="login.php">log in</a> .');
            die();
        }
    }
    if ($password != $password_confirm) {
        echo ('Passwods are not matching , please try to enter a valid matching passwords');
        die();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $req = "INSERT INTO users (username, email,psw)  
            VALUES ('$username', '$email', '$hashed_password')";
        $result1 = mysqli_query($conn, $req);


        if ($result1) {
            // The insert was successful, now fetch the user information
            $sql1 = "SELECT * FROM users WHERE email = '$email'";
            $result2 = mysqli_query($conn, $sql1);
            if ($result2) {
                $row = mysqli_fetch_assoc($result2);
                // database result
                $user_name = $row['username']; // here we got the user name 
                $user_email = $row['email'];
                // start session and store user informations
                //storing in session
                $_SESSION['username'] = $user_name;
                $_SESSION['email'] = $user_email;
                header('location:../home-admin.php');
                die();
            } else {
                echo 'Error executing query: ' . mysqli_error($conn);
                die();
            }
        } else {
            echo 'Error executing query: ' . mysqli_error($conn);
            die();
        }
    }
}
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" type="text" name="username" placeholder="exemple" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" />
                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" type="password" name="password" placeholder="Create a password" />
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password_confirm" type="password" name="password_confirm" placeholder="Confirm password" />
                                                    <label for="password_confirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <input class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Create an account">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php?id=<?php echo $row['user-id'] ?>">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <?php
        include('../imports/dashboard-footer.php');
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/admin/js/scripts.js"></script>


</body>

</html>