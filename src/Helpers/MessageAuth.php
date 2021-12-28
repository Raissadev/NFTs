<?php

namespace Src\Helpers;

class MessageAuth
{

    public static function launchMessage(string $type, string $message): void
    {
        $_SESSION['message'] = $message;
        $_SESSION['type_message'] = $type;
    }

}

?>