<?php

require_once __DIR__ . '/../src/init.php';

$db = new DataBase;
$order = new Order($db);
$client = new Client($db);

$data = json_decode(file_get_contents('php://input'), true);

$clientByPhone = $client->getByPhone($data['client']['phone']);

if ($clientByPhone !== false) {
    $clientId = $clientByPhone['id'];
} else {
    $clientId = $client->create($data['client']);
}
$data['order']['client_id'] = $clientId;
$data['order']['start'] = (new DateTime($data['order']['start']))->format('Y-m-d');
$data['order']['end'] = (new DateTime($data['order']['end']))->format('Y-m-d');
$res = $order->create($data['order']);

if ($res === false) {
    http_response_code(400);
} else {
    http_response_code(200);
}
