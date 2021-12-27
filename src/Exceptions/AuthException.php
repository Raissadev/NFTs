<?php

namespace Src\Exceptions;

use Src\Helpers\MessageAuth;

class AuthException extends \DomainException
{

    private string $messageException;

    public function __construct(string $message)
    {
        $this->messageException = $message;

        MessageAuth::launchMessage('error', $this->messageException);
        header('Location: '.BASE_URL.'/exception');
        
    }

}

?>
