<?php

set_time_limit(0);
ob_implicit_flush();

$host = "localhost";
$port = 9080;

set_time_limit(1110);

$socket = socket_create(AF_INET, SOCK_STREAM, 0) || die("OPS! Falha na criação do socket\n");

if (!socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1)) {
    echo socket_strerror(socket_last_error($socket));
    exit;
}

$result = socket_bind($socket, $host, $port) || die("OPS! Falha na ligação do socket\n");

$result = socket_listen($socket, 3) || die("OPS! Falha na escuta do socket\n");

echo "Socket ouvindo . . .";

$spawn = socket_accept($socket) || die("OPS! Falha ao aceitar o socket\n");

$input = socket_read($spawn, 1024) || die("OPS! Falha na leitura do socket\n");
$input = trim($input);

echo "\n\nClient Message: " . $input . "\n\n";

$output = "Olá cliente marciano :)";

socket_write($spawn, $output, strlen($output)) || die("OPS! falha na leitura do socket\n");

socket_close($spawn);
socket_close($socket);
