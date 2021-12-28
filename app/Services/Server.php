<?php

namespace App\Services;

class Server
{

    public function __construct()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $bind = socket_bind($socket, 0, 8000) or die("Error bind");
        $listen = socket_listen($socket, 1) or die("Error listen");

        do{
            $accept = socket_accept($socket) or die ("Error to accept");
            $message = "Welcome User RaissaDev!";

            socket_write($accept, $message, strlen($message));

            do{
                $read = socket_read($accept, 2048, PHP_NORMAL_READ) or die ("Error in read");

                if(!$read = trim($read)) continue;
                if($read == 'quit') break;
                if($read == 'shutdown'){ socket_close($accept); break 2; }

                $callback = "Você disse: ";
                socket_write($accept, $callback, strlen($callback));
                echo $read;
            } while(true);
                socket_close($accept);

            } while(true);
                socket_close($socket);

        }

}

new Server;

?>