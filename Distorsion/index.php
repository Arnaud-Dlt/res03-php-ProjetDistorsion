<?php

session_start();

require "services/Router.php";

$newRouter = new Router();

if (isset ($_GET["route"])){
    
    $newRouter->checkRoute($_GET["route"]);
}

else{
    $newRouter->checkRoute("");
}


?>