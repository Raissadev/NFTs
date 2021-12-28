<?php

namespace App\Route;

class Router
{

    private string $httpMethod;
    private array $request;

    public function __construct()
    {
        $this->request = $_POST;
    }

    public function get(string $path, string $class, string $params): void
    {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] = "GET";

        if(strpos($_SERVER['REQUEST_URI'], $path) !== false){
            ((new $class)->$params());
        }

    }

    public function post(string $path, string $class, string $params): void
    {
        if(!$this->request) return;
        
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] = "POST";
        
        if(strpos($_SERVER['REQUEST_URI'], $path) !== false){
            ((new $class)->$params());
        }
        
    
    }

    public function put(string $path, string $class, string $params): void
    {
        if(!$this->request) return;

        $this->httpMethod = $_SERVER['REQUEST_METHOD'] = "PUT";

        if(strpos($_SERVER['REQUEST_URI'], $path) !== false){
            ((new $class)->$params());
        }
        
    }

    public function delete(string $path, string $class, string $params): void
    {
        if(!$this->request) return;

        $this->httpMethod = $_SERVER['REQUEST_METHOD'] = "DELETE";

        if(strpos($_SERVER['REQUEST_URI'], $path) !== false){
            ((new $class)->$params());
        }

    }

}

?>