<?php

namespace System\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Application
{
    protected $container;
    protected $middlewares = [];

    public function __construct(){
        $this->container = new Container();
        $this->container->bind('twig', new Environment(new FilesystemLoader(BASE_PATH . 'app/views')));
        /**
         * Database configuration
         * $this->container->bind('database', new Database('localhost', 'root', '', 'your_database_name'));
         */
    }

    public function addMiddleware(Middleware $middleware){
        $this->middlewares[] = $middleware;
    }
    public function run(){
        $this->handleMiddlewares();
        $this->handleRoutes();
    }

    public function handleMiddlewares(){
        foreach ($this->middlewares as $middleware){
            $middleware->handle($this->getRequest(), function (){
                // Placeholder for the next middleware or route handling
            });
        }
    }

    public function getContainer(){
        return $this->container;
    }

    public function handleRoutes(){
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri){
            case '/':
                $this->render('welcome.twig', ['name' => 'John']);
                break;

            default:
                $this->render404Page();
                break;
        }
    }

    public function render($template, $data = []){
        $twig = $this->getContainer()->resolve('twig');
        echo $twig->render($template, $data);
    }
    protected function render404Page(){
        header("HTTP/1.0 404 Not Found");
        $this->render('404.twig');
        exit();
    }
}