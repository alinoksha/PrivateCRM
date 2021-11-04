<?php

require_once __DIR__ . '/../src/init.php';

$raw = file_get_contents(__DIR__ . '/sql/delivery.sql');

$sqls = explode(';', $raw);

$db = new DataBase;
foreach ($sqls as $sql) {
    $db->exec($sql);
}
