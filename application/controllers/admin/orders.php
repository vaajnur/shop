<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Orders;

class Controller_Orders extends Controller
{
    /**
     *
     */
    public function action_index(){
        $model = new Model_Orders();
        $data['orders'] = $model->getAll();
        $this->view->generate("orders/orders", $data);
    }
}