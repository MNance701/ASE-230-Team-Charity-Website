<?php
session_start();

if (isset($_SESSION['username'])) {

    $_SESSION = array();

    session_destroy();

    echo '<h1>Sign Out Successful</h1>';
    echo '<a href="signin.php">Sign In</a>';
} else {
    echo '<h1>You are not logged in!</h1>';
    echo '<a href="signin.php">Sign In</a>';
}