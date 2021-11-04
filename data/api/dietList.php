<?php

require_once __DIR__ . '/../src/init.php';

$db = new DataBase;
$diets = [];

foreach ($db->findAll('SELECT * FROM `diet`') as $diet) {
    $diets[] = $diet;
}

jsonResponse($diets);
