<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Templates;

class Controller_Templates extends Controller{
    public function action_index(){
        $templ_obj = new Model_Templates();
        $data = $templ_obj->getAll();
        $this->view->generate("templates/templates", $data);
    }
}