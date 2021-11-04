<?php

require_once __DIR__ . '/../src/init.php';

$db = new DataBase;
$order = new Order($db);

jsonResponse($order->getAll());
