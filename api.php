<?php
require_once("config.inc.php");
require_once("Rest.inc.php");
require_once("API.inc.php");

// Init Class
$api = new API;
$api->process_api();

?>