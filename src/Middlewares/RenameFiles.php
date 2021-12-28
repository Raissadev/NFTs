<?php

namespace Src\Middlewares;

class RenameFiles
{

    public static function renameImage(string $name, string $image): string
    {
        $fileName = md5($name) . $image;
        return $fileName;
    }

}

?>