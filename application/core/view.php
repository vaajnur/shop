<?php

namespace Core;

use Controllers\Admin\Controller_Leftmenu;
use Lib\Lib_AJAX;

class View
{
    private $namespace;

    /**
     * @param $namespace
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @param $content_view
     * @param null $data
     */
    function generate($content_view, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        if (!$content_view) {
            /* ************ caller */
            $trace = debug_backtrace();
            $caller = $trace[1]['function'];
            $template = str_replace("action_", "", $caller);
            $content_view = strtolower($template) . ".php";
        } else {
            $content_view = $content_view . ".php";
        }
        if($this->namespace == "admin" && !isset($_SESSION['admin']['name'])){
            include VIEW_PATH. DS . $this->namespace . DS . 'login.php';
            return;
        }

        // catch AJAX request
        $obj_ajax = new Lib_AJAX();
        if ($obj_ajax->getIsAjaxRequest()) {
            include VIEW_PATH. DS . $this->namespace . DS . $content_view;
            return;
        }
        /* ********************* left menu */
//        include(CONTROLLER_PATH . DS . 'admin/leftmenu.php');
        $menu_obj = new Controller_Leftmenu();
        $left_menu = $menu_obj->create();

        /* ************** */
        $template_view = 'template.php';

        $templ = VIEW_PATH. DS . $this->namespace . DS . $template_view;
        if (is_file($templ))
            include($templ);
        else
            die("template_view $templ not found!!");

    }

    /**
     * @param string $url
     */
    public function redirect($url = '')
    {
        header("Location: " . $url);
    }
}