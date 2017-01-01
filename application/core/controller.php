<?php 

namespace Core;

abstract class Controller {
    
    public $model;
    public $view;

    /**
     * @param string $namespace
     */
    function __construct($namespace = "")
    {
        $this->view = new View($namespace);
    }
    
//    abstract function action_index();
}