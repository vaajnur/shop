<?php

namespace Core;

class Route
{
    private $path = "application/controllers/";
    private $controller_path_folder;
    private $namespace = "client";

    /**
     *
     */
    public function start()
    {
        session_start();
        $this->dispatch();
    }

    /**
     * @param $file
     * @param $controller
     * @param $action
     * @param $args
     */
    private function getDirections(&$file, &$controller, &$action, &$args) {

        $route = (empty($_SERVER['REQUEST_URI'])) ? '' : $_SERVER['REQUEST_URI'];
        unset($_SERVER['REQUEST_URI']);
        $route = trim($route, '/\\');
        $controller_path = $this->path;
        if (empty($route)) {
        /* ******************* Default directions ******** */
            $controller = 'startpage';
            $action = 'action_index';
            $controller_path = $this->controller_path_folder =  "application/controllers/$this->namespace/";
            $file = $controller_path.$controller.".php";
        }
        else
        {
            $parts = explode('/', $route);
            /* ************** namespace ********** */
            if($parts[0] == "admin") {
                $this->namespace =  "admin";
                array_shift($parts);
            }
            /* ***************** folders & subfolders ******* */
            $fullpath = $this->controller_path_folder = $controller_path . $this->namespace;
            foreach ($parts as $part) {
                $fullpath .= DS . $part;
                if (is_dir($fullpath)) {
                    array_shift($parts);
                    continue;
                }
                if (is_file($fullpath . '.php')) {
                    array_shift($parts);
                    $file = "$fullpath.php";
                    break;
                }
            }
            /* *************** Controller, Action, Params ******** */
            if(!isset($part))
                $part = "startpage";
            $controller = $part;
            if(!$file)
                $file = $fullpath."/$part.php";
            $action = array_shift($parts);
            if(!$action)
                $action = 'action_index';
            else
                $action = "action_$action";
            $args = $parts;
        }
    }

    /**
     *
     */
    public function dispatch(){
        $this->getDirections($file, $controller, $action, $args);
        /* ************* include Controller - Model  */
        if (is_readable($file) == false) {
            $this->ErrorPage404($file);
            return;
        }
        include $file;
        $model = str_replace("controller", "model", $file);
        if(is_readable($model)) // Model additional
            include($model);
        /* ******  controller class & action ** */
        $controller = ucfirst($controller);
        $class = 'Controllers\\'.ucfirst($this->namespace).'\Controller_' . $controller;
        $controller = new $class($this->namespace);
        if (is_callable(array($controller, $action)) == false) {
            $this->ErrorPage404($action);
            return;
        }
        $controller->$action($args);
    }

    /**
     *
     */
    public function ErrorPage404($file)
    {
        include(CONTROLLER_PATH.DS.strtolower($this->namespace).DS.'404.php');
        $class = 'Controllers\\'.ucfirst($this->namespace).'\Controller_404';
        $controller = new $class($this->namespace);
        $controller->action_index($file);
    }
}