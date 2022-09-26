<?php

header('Content-Type: application/json');

$version = "11";
$change = "no";


echo json_encode(array("version" => $version, "change" => $change));



?>