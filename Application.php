<?php

namespace morlowsk\corephp;
use morlowsk\corephp\db\Database;
use morlowsk\corephp\db\DbModel;

/**
 * Summary of Application
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public Session $session;
    public ?UserModel $user;
    public View $view;

    public function __construct($rootPath, array $config)
    {

        $this->user = null;


        $this->userClass = '';
        $this->userClass = $config['userClass'];        
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try 
        {
            echo $this->router->resolve();
        }
        catch(\Exception $e)
        {
            $this->response->setStatusCode($e->getCode());
            echo Application::$app->view->renderView('_error', [
                'exception' => $e
            ]);
        }

    }

    public function getController(): \morlowsk\corephp\Controller
    {
        return $this->controller;
    }

    public function setController(\morlowsk\corephp\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
}