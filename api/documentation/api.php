<?php

require("/var/www/html/rest-php/vendor/autoload.php");
$openapi = \OpenApi\scan( '/var/www/html/rest-php/api');
header('Content-Type: application/json');
echo $openapi->toJSON();