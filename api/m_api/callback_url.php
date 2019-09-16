<?php
header("Content-Type: application/json");

include_once '../../models/initialization.php';

$callback_response = file_get_contents('php://input');

// initialize test class
$test = new TestTable();

$test->json_data = $callback_response;

$test->create();