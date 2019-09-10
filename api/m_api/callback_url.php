<?php 
$callback_response = file_get_contents('php://input');

$logFile = "CallBackConfirmation.txt";

$log = fopen($logFile, 'a');

fwrite($log, $callback_response);

fclose($log);