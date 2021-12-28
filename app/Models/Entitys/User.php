<?php

namespace App\Models\Entitys;

use App\Services\QuerysDatabase\QuerySeter;
use Src\Repository\UserRepository;
use Src\Helpers\MessageAuth;
use Src\Middlewares\AuthenticatorMiddleware;

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
        $_SESSION['type_user'] = $this->type;
        return $this->type;
    }

    public static function isUser(): array
    {        
        if(!isset($_SESSION['id'])) return $buttons[] = [ "Text" => "Sign Up", "Link" => "/sign-up", "TypeUser" => "Register", "TypeLink" => "/sign-up" ];

        $user = UserRepository::schemaGetTypeUser( (int) $_SESSION['id'] );
        $_SESSION['type_user'] = $user['type_user'];

        if($user['type_user'] === "vendor"){
            $buttons[] = [ "Text" => "Dasboard", "Link" => "/dashboard", "TypeUser" => "Create NFT", "TypeLink" => "/dashboard/create-nft" ];
        }elseif($user['type_user'] === "client"){
            $buttons[] = [ "Text" => "Profile", "Link" => "/profile", "TypeUser" => "Become Vendor", "TypeLink" => "/become-vendor?type=vendor" ];
        }

        return $buttons['0'];
    }

    public static function newBlockchain(int $user, string $blockchain, string $blockchainPassword): void
    {
        $insert = QuerySeter::schemaCreateBlockchain( (int) $user, (string) $blockchain, (string) $blockchainPassword );

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

    public static function authUpdateProfile(int $user, string $name, string $email, array $image): void
    {
        $verifyName = AuthenticatorMiddleware::verifyName($name);
        $verifyEmail = AuthenticatorMiddleware::verifyEmail($email);
        $verifyImage = AuthenticatorMiddleware::verifyImage($image);

        if($verifyEmail === false || $verifyEmail === false || $verifyImage === false) return;

        $profile = QuerySeter::schemaUpdateUser( (int) $user, (string) $name, (string) $email, (string) $image['name'] );

        move_uploaded_file($image['tmp_name'], dirname(__DIR__, 3). '\storage\users\\' . $image['name']);

        new User( (int) $_SESSION['id'], (string) $name, (string) $email, (string) $_SESSION['password'], (string) $image['name'], (string) $_SESSION['type_user'] );
        header('Refresh');
    }

}

?>