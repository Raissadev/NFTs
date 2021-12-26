<?php

namespace App\Models\Entitys;

use Src\Repository\UserRepository;
use Src\Helpers\MessageAuth;

class User extends UserRepository
{

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $image;
    private string $type;
    private static string $blockchain;
    private static string $blockchainPassword;
    
    public function __construct(int $id, string $name, string $email, string $password, string $image, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->type = $type;

        self::getId($this->id); 
        self::getName($this->name); 
        self::getEmail($this->email); 
        self::getPassword($this->password); 
        self::getImage($this->image);
        self::getType($this->type);

        $_SESSION['login'] = true;

        return $this;
    }

    public function getId(): int
    {
        $_SESSION['id'] = $this->id;
        return $this->id;
    }

    public function getName(): string
    {
        $_SESSION['name'] = $this->name;
        return $this->name;
    }

    public function getEmail(): string
    {
        $_SESSION['email'] = $this->email;
        return $this->email;
    }

    public function getImage(): string
    {
        $_SESSION['image'] = $this->image;
        return $this->image;
    }

    public function getPassword(): string
    {
        $_SESSION['password'] = $this->password;
        return $this->password;
    }

    public function getType(): string
    {
        $_SESSION['type'] = $this->type;
        return $this->type;
    }

    public static function isUser(): array
    {        
        if(!isset($_SESSION['id'])) return $buttons[] = [ "Text" => "Sign Up", "Link" => "/sign-up" ];

        $user = UserRepository::schemaGetTypeUser( (int) $_SESSION['id'] );
        $_SESSION['type'] = $user['type_user'];

        if($user['type_user'] === "vendor"){
            $buttons[] = [ "Text" => "Dasboard", "Link" => "/dashboard" ];
        }elseif($user['type_user'] === "client"){
            $buttons[] = [ "Text" => "Profile", "Link" => "/profile" ];
        }

        return $buttons['0'];
    }

    public static function newBlockchain(int $user, string $blockchain, string $blockchainPassword): void
    {
        $insert = UserRepository::schemaCreateBlockchain( (int) $user, (string) $blockchain, (string) $blockchainPassword );

        if(!empty($insert)){
            MessageAuth::launchMessage('error', 'Invalid data!');
            return;
        }

        MessageAuth::launchMessage('success', 'Blockchain successfully registered!');

        self::$blockchain = $blockchain;
        self::$blockchainPassword = $blockchainPassword;
    }

    public static function getMyBlockchain(int $user): array
    {
        $blockchain = UserRepository::schemaFetchBlockchain( (int) $user );
        return $blockchain;
    }

}

?>