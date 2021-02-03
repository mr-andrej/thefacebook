<?php
require_once "../_functions.php";

db_connect();

$sql = "SELECT id, email, firstname, lastname, password FROM users WHERE email = ?";

$statement = $connection->prepare($sql);
$statement->bind_param("s", $_POST['email']);
$statement->execute();
$statement->store_result();
$statement->bind_result($id, $email, $firstname, $lastname, $password);
$statement->fetch();

if ($statement->execute()) {
    if (password_verify($_POST['password'], $password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_email'] = $email;
        redirect_to("/home.php");
    } else
        redirect_to("/index.php?login_error=true");
} else
    echo "Error: " . $connection->error;

