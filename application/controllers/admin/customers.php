<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Customers;

class Controller_Customers extends Controller
{
    /**
     *
     */
    public function action_index(){
        $model = new Model_Customers();
        $data['customers'] = $model->getAll();
        $this->view->generate("customers/customers", $data);
    }

    /**
     * @param array $args
     */
    public function action_detail(array $args = null){
        $customer_id = (isset($args[0])? $args[0] : null);
        $model = new Model_Customers();
        $data['customer'] = $model->getCustomerDetails($customer_id);
        $data['orderHistory'] = $model->getOrdersHistory($customer_id);
        $this->view->generate("customers/detail", $data);
    }

    /**
     * @param array $args
     */
    public function action_editCustomerDetails(array $args = null){
        $customer_id = (isset($args[0])? $args[0] : null);
        $model = new Model_Customers();
        $data['customer'] = $model->getCustomerDetails($customer_id);
        if(isset($_POST['send'])) {
            unset($_POST['send']);
            $_POST['customer_id'] = $customer_id;
            $data['mess'] = $model->editCustomerDetails($customer_id, $_POST);
            $this->view->redirect("/admin/customers/editCustomerDetails/$customer_id");
            return;
        }
        $this->view->generate("customers/edit", $data);
    }

    /**
     * @param array $args
     */
    public function action_deleteCustomerDetails(array $args = null){
        $customer_id = isset($argsp[0])? $args[0] : null;
        $model = new Model_Customers();
        $res = $model->deleteCustomerDetails($customer_id);
        $this->view->redirect("/admin/customers");
    }
}