<?php
echo "123";
require 'vendor/autoload.php';
use telesign\sdk\messaging\MessagingClient;
$customer_id = '5975B85B-7EA0-4B8C-A8FF-C26770CA2065';
$api_key ='SViXqkR+sEToFpbwCXDjQdFpwLq50du5YLy3Ce3EPeZ4oiGhfWTyLf7zZNumdF1AqIENpf0uVRTxDqf+3QZRZg==';
$phone_number = '17209359146';
$message = "Your package has shipped! Follow your delivery at https://vero-finto.com/orders/3456";
$message_type = "ARN";
$messaging = new MessagingClient($customer_id, $api_key);
$response = $messaging->message($phone_number, $message, $message_type);
echo($response->json);
?>