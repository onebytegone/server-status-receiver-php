<?php

require 'model/ServerEvent.php';
require 'lib/EventStore.php';

$requestData = $_GET;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $requestData = $_POST;
}

$serverName = isset($requestData['name']) ? $requestData['name'] : 'Unidentified';
$payload = array_diff_key($requestData, array('name' => true));
$event = new ServerEvent($serverName, $payload);
$store = new EventStore('./server-status.json');
$store->push($event);

header('Content-type:application/json;charset=utf-8');
echo '{}';
