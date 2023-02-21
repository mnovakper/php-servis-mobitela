<?php

/*Mini MVC framework za moje potrebe*/
/*Mini MVC framework*/

session_start();

require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App();
$app->load_controller();