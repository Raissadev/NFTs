<?php

namespace Src\Middlewares;

class RenameFiles
{

    public static function renameImage(string $name, string $image): string
    {
        $fileName = md5($name) .'.'. pathinfo($image)['extension'];
        return $fileName;
    }

}

?>
