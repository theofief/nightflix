<?php
header('Content-Type: application/json');

$url = 'https://zenquotes.io/api/today';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if(curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de récupération']);
    exit;
}

curl_close($ch);
echo $response;