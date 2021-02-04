<?php
require_once "../_functions.php";

session_destroy();
redirect_to("/index.php");
