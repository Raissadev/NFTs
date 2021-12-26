<?php

namespace Src\Repository;
use App\Services\ConnectionFactory;

class VendorRepository
{

    private string $table = 'users';

    public static function schemaGetOwner(int $id): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users WHERE id = $id");
        $user->execute();
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

}


?>