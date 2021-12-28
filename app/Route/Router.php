<?php

namespace App\Route;

class Router
{

    private string $httpMethod;
    private array $request;
    private string $url;

    public function __construct()
    {
        $this->request = $_POST;
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function get(string $path, string $class, string $params): void
    {
        if(strpos($this->url, $path) !== false){
            (new $class)->$params();
        }
    }

    public function post(string $path, string $class, string $params): void
    {
        if(!$this->request) return;
                
        if(strpos($this->url, $path) !== false){
            (new $class)->$params();
        }
    }

    public function put(string $path, string $class, string $params): void
    {
        if(!$this->request) return;

        if(strpos($this->url, $path) !== false){
            (new $class)->$params();
        }
    }

    public function delete(string $path, string $class, string $params): void
    {
        if(!$this->request) return;

        if(strpos($this->url, $path) !== false){
            (new $class)->$params();
        }
    }

}

?>