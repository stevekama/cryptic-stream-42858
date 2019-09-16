<?php
header("Content-Type: application/json");

$callback_response = file_get_contents('php://input');
