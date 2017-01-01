<?php

namespace Lib;

class Lib_AJAX{
    /**
     * @return bool
     */
    public function getIsAjaxRequest(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}