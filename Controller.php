<?php

namespace morlowsk\corephp;
use morlowsk\corephp\middlewares\BaseMiddleware;

/**
 * Summary of Controller
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * Summary of middlewares
     * @var \morlowsk\corephp\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];
    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Summary of getMiddlewares
     * @return \morlowsk\corephp\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
    
}