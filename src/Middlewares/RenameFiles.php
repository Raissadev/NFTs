<?php

namespace Src\Middlewares;

class RenameFiles
{

    public static function renameImage(string $name, string $image): string
    {
        return md5($name) .'.'. pathinfo($image)['extension'];
    }

}

?>
