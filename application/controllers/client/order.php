<?

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Cart;
use Models\Client\Model_Account;
use Models\Client\Model_Order;
use Models\Client\Model_Login;

class Controller_Order extends Controller{
    /**
     * @return array
     */
    public function elements()
    {
        $model = new Model_Cart();
        $model2 = new \Models\Admin\Model_Element();
        $data = array();
        $data['total_sum'] = 0;
        // fetch values from session cart id's
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $size) {
                $element = $model2->getElement("1", "catalog", $id);
                if ($element)
                    $data['element'][$id] = $element;
                if (is_array($size['size'])) {
                    foreach ($size['size'] as $sizeID => $amount) {
                        // turn id's in real readable values
                        $quantity = $model->getOptionValue(implode(',', $amount));
                        $sizeVAL = $model->getOptionValue($sizeID); // !!! return array

                        if ($quantity) {
                            // если кол-во в корзине больше доступного
                            if ((int)array_sum($quantity) > (int)$element['avail_fields']['quantity'][0]['name']) {
                                $quantity = null;
                                $data['element'][$id]['sizeVAL'][$sizeVAL[0]]['sizeAmount'] = $quantity[0] = $element['avail_fields']['quantity'][0]['name'];
                            } else {
                                $data['element'][$id]['sizeVAL'][$sizeVAL[0]]['sizeAmount'] = array_sum($quantity);
                            }
                            // size id для перерасчета
                            $data['element'][$id]['sizeVAL'][$sizeVAL[0]]['sizeID'] = $sizeID;
                            $data['element'][$id]['total_quantity'][] = array_sum($quantity);
                        }
                    } // end loop
                }
                $data['element'][$id]['total'] = $data['element'][$id]['price'] * array_sum($data['element'][$id]['total_quantity']);
                $data['total_sum'] = $data['total_sum'] + $data['element'][$id]['total'];
            }
        }
        return $data;
    }

    /**
     *
     */
    public function action_index(){
        $model_account = new Model_Account();
        $data = $this->elements();
        if(isset($_SESSION['user'])) {
            $customer_id = $_SESSION['user']['id'];
            $data['customer_details'] = $model_account->getCustomerDetails($customer_id);
        }
        $this->view->generate("order", $data);
    }

    /**
     *
     */
    public function action_addOrder(){
        $model_account = new Model_Account();
        $model = new Model_Order();
        // if logined
        if(isset($_SESSION['user'])) {
            $customer_id = $_SESSION['user']['id'];
            // add order
            if(isset($_POST['send_order'])){
                $data['customer_details'] = $model_account->getCustomerDetails($customer_id);
                // проверка форм
                if(empty($_SESSION['cart'])){
                    $data['mess_type2'] = "warning";
                    $data['mess2'] = "Корзина пуста!";
                }else if($data['customer_details'] == false){
                    $data['mess_type2'] = "danger";
                    $data['mess2'] = "Не заполнены личные данные!";
                }else{
                    $res = $model->addOrder($_SESSION['cart'], $customer_id, $_POST['pay_type']);
                    if($res == true){
                        $data['mess_type2'] = "success";
                        $data['mess2'] = "Заказ оформлен!";
                        $_SESSION['cart'] = null;
                    }else{
                        $data['mess_type2'] = "danger";
                        $data['mess2'] = "Заказ не оформлен!";
                    }
                }
            }
        }else{
            $data['mess_type2'] = "danger";
            $data['mess2'] = "Не заполнены личные данные!";
        }
        $element = $this->elements();
        $data['element'] = (isset($element['element'])? $element['element'] : null);
        $data['total_sum'] = (isset($element['total_sum'])? $element['total_sum'] : null );
        $this->view->generate("order", $data);
    }

    /**
     *
     */
    public function action_addDetails(){
        $model_account = new Model_Account();
        $model = new Model_Order();
        $data = $this->elements();
        $customer_id = $_SESSION['user']['id'];
        $data['customer_details'] = $model_account->getCustomerDetails($customer_id);
            // add customer details
            if (isset($_POST['send_details'])) {
                unset($_POST['send_details']);
                // if logined
                if(isset($_SESSION['user'])) {
                    $customer_id = $_SESSION['user']['id'];
                }else{
                    $model_login = new Model_Login();
                    $data2['name'] = $_SESSION['user']['name'] = $_POST['email'];
                    $data2['password'] = $_SESSION['user']['password'] = "";
                    $customer_id = $_SESSION['user']['id'] = $model_login->registerUser($data2);
                }
                // ////////////////
                $_POST['customer_id'] = $customer_id;
                $res = $model_account->addCustomerDetails($_POST);
                if($res == false){
                    $data['mess_type1'] = "danger";
                    $data['mess1'] = "Неверные данные!";
                }else{
                    $data['customer_details'] = $model_account->getCustomerDetails($customer_id);
                    $data['mess_type1'] = "success";
                    $data['mess1'] = "Личные данные заполнены!";
                }
            } else {
                $data['mess_type1'] = "warning";
                $data['mess1'] = "Пустые данные!";
            }

        $this->view->generate("order", $data);
    }

    /**
     *
     */
    public function action_login(){
        $data = $this->elements();
        if(isset($_POST['send_login'])){
            $model = new Model_Login();
            unset($_POST['send_login']);
            foreach($_POST as $name => $post){
                if($post == ""){
                    $data['mess'] = "Пустое поле $name";
                    $data['mess_type'] = "warning";
                    $this->view->generate("order", $data);
                    return;
                }
            }
            $res = $model->getUser($_POST);
            if($res) {
                $_SESSION['user'] = $res;
                $data['mess'] = "Успешная авторизация!";
                $data['mess_type'] = "success";
            }else{
                $data['mess'] = "Ошибка входа!";
                $data['mess_type'] = "danger";
            }
        }
        $this->view->generate("order", $data);
    }
}