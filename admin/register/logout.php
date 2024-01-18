<?php
session_start();

// destroy session 
if (session_destroy()) {
    header('location: ./index.php ');
}
