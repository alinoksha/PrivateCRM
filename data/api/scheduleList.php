<?php

require_once __DIR__ . '/../src/init.php';

$db = new DataBase;
$schedule = [];

foreach ($db->findAll('SELECT * FROM `schedule`') as $item) {
    $schedule[] = $item;
}

jsonResponse($schedule);
