<?php

set_time_limit(0);

$host = "localhost";
$port = 9080;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) || die("OPS! Falha na criação do socket\n");
$result = socket_connect($socket, $host, $port) || die("OPS! Falha na conexão\n");

echo "Conexão estabelecida!";

$message = "Olá servidor marciano :)";

socket_write($socket, $message, strlen($message)) || die("OPS! Falha na escrita do socket\n");

$result = socket_read($socket, 1024) || die("OPS! Falha na leitura do socket\n");

echo "\n\nResponse: " . $result . "\n\n";

socket_close($socket);
