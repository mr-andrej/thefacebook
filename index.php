<?php require_once "_functions.php";
db_connect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>[thefacebook]</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon"
          type="image/png"
          href="/img/favicon.png"/>
</head>
<body>

<!-- nav -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><strong>[thefacebook]</strong></a>
        </div>
    </div>
</nav>
<!-- ./nav -->

<!-- main -->
<main class="container">
    <h1 class="text-center">Welcome to <strong>[thefacebook]</strong> <br><br></h1>
    <?php if (isset($_GET['registered'])): ?>
        <div class="alert alert-success">
            <p>Account created successfully! Use your email and password to login.</p>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6"><br>

            <h4>Login to start enjoying unlimited fun!</h4>

            <!-- login form -->
            <form method="post" action="php/login.php">
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="E-mail">
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="login" value="Login">
                </div>
            </form>
            <!-- ./login form -->
        </div>
        <br>
        <div class="col-md-6">
            <h4>Don't have an account yet? Register!</h4>
            <!-- TODO: Copy the style of the original TheFacebook index page -->
            <!-- register form -->
            <form method="post" action="php/register.php">
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="E-mail">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="firstname" placeholder="First Name">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="lastname" placeholder="Last Name">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="location" placeholder="Location">
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="register" value="Register">
                </div>
            </form>
            <!-- ./register form -->
        </div>
    </div>
</main>
<!-- ./main -->

<?php include "_footer.php" ?>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
