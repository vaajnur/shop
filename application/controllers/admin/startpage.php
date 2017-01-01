<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Orders;
use Models\Admin\Model_Customers;

class Controller_Startpage extends Controller{
    /**
     *
     */
    public function action_index(){
        $data = "";
        $model_orders = new Model_Orders();
        $orders = $model_orders->getAll();
        $model_customers = new Model_Customers();
        $customers = $model_customers->getAll();

        $data['orders_count'] = count($orders);
        $data['bounce_rate'] = null;
        $data['user_registrations'] = count($customers);
        $data['unique_visitors'] = null;
        $this->view->generate("startpage", $data);
    }
}