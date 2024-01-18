<?php


        //connect to the DB
        $servername = 'localhost';
        $usernamemysql = 'root';
        $password = '';
        $dbname = 'ecommerce';
        $conn = mysqli_connect($servername, $usernamemysql, $password, $dbname);

        //make sure the connection happend
        if (!$conn) {
            echo "connexion imposible <br>";
        } else {
            echo "connexion reussie <br>";
        }

        