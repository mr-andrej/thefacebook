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

<!-- Navigation -->
<nav class="navbar navbar-default justify-content-between">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php"><strong>[thefacebook]</strong></a>

        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="php/logout.php">Logout</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="profile.php"
              style="text-align:center; margin-top: 1vh;">
            <input class="form-control mr-sm-2" type="text" name="email" placeholder="Enter e-mail" style="width: 25vh;">
            <button class="btn btn-light" type="submit">Search</button>
        </form>
    </div>

</nav>
<!-- Navigation End -->
