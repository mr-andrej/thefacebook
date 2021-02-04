<?php
session_start();

function db_connect()
{
    global $connection;

    $db_server = "localhost";
    $username = "mrandrej";
    $password = "password";
    $db_name = "theFacebookDB";

    $connection = new mysqli($db_server, $username, $password, $db_name);

    if ($connection->connect_error)
        die("Error: " . $connection->connect_error);

}

function redirect_to($url)
{
    header("Location: " . $url);
    exit();
}

function is_auth()
{
    return isset($_SESSION['user_id']);
}

function check_auth()
{
    if (!is_auth())
        redirect_to("/index.php?logged_in=false");
}



