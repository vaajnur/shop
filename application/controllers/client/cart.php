<?

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Cart;

class Controller_Cart extends Controller
{
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
                    foreach ($size['size'] as $sizeID => $amountIDS) {
                        // turn id's in real readable values
                        $quantity = $model->getOptionValue(implode(',', $amountIDS));
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
    public function action_index()
    {
        $data = $this->elements();
        $this->view->generate("cart/cart", $data);
    }

    /**
     *
     */
    public function action_smallcart()
    {
        $data = $this->elements();
        $this->view->generate("cart/smallcart", $data);
    }

    /**
     * @param array $args
     */
    public function action_add(array $args = null)
    {
        $element_id = (isset($args[0]) ? $args[0] : '');
        if (!empty($_POST['size'])) {
            $quantity = !empty($_POST['quantity']) ? $_POST['quantity'] : 83;
            if (!in_array($_POST['size'], $_SESSION['cart'][$element_id]['size'])) {
                $size = $_POST['size'];
                $_SESSION['cart'][$element_id]["size"][$size][] = $quantity;
            }
            $_SESSION['cart'][$element_id]["size"][$_POST['size']][] = $quantity;
        }
        return;
    }

    /**
     *
     */
    public function action_update()
    {
        if (isset($_POST['send'])) {
            unset($_POST['send']);
            foreach ($_POST as $name => $val) {
                if (!empty($val)) {
                    global $new_amount;
                    global $new_size;
                    global $el_id;
                    global $size;
                    $name = explode('_', $name);
                    if ($name[0] == 'quantity') {
                        $new_amount = $val;
                    } else if ($name[0] == 'size') {
                        $new_size = $val;
                    }
                    $el_id = $name[1];
                    $size = $name[2];
                    // UPDATE size and counts
                    if (isset($new_size) && isset($new_amount)) {
                        unset($_SESSION['cart'][$el_id]['size'][$size]);
                        $_SESSION['cart'][$el_id]['size'][$new_size] = array($new_amount);
                    } else if (isset($new_size)) {
                        $old_amount = $_SESSION['cart'][$el_id]['size'][$size]; // !!! it's array
                        unset($_SESSION['cart'][$el_id]['size'][$size]);
                        $_SESSION['cart'][$el_id]['size'][$new_size] = $old_amount;
                    } else if (isset($new_amount)) {
                        $_SESSION['cart'][$el_id]['size'][$size] = array($new_amount);
                    }
                }
            }
        }
        $this->view->redirect("/cart");
    }

    public function action_clean()
    {
        $_SESSION['cart'] = null;
    }
    public function action_clear()
    {
        $_SESSION['cart'] = null;
    }

    /**
     *
     */
    public function action_count()
    {
        $count = 0;
        $model = new Model_Cart();
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $size) {
                foreach ($size['size'] as $sizeID => $amountIDS) {
                    $quantity[] = $model->getOptionValue(implode(',', $amountIDS));
                    if ($quantity)
                        $count = array_sum($quantity);
                }
            }
        }
        echo $count;
        return;
    }

    /**
     * @param array $args
     */
    public function action_delete(array $args = null)
    {
        $element_id = (isset($args[0]) ? $args[0] : '');
        $size_id = (isset($args[1]) ? $args[1] : '');
        unset($_SESSION['cart'][$element_id]['size'][$size_id]);
        $this->view->redirect("/cart");
    }
}