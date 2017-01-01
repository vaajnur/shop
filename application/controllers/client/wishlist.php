<?

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Cart;

class Controller_Wishlist extends Controller{
    /**
     * @return array
     */
    public function elements(){
        $model = new Model_Cart();
        $data = array();
        if(isset($_SESSION['user']['wish'])){
            foreach ($_SESSION['user']['wish'] as $id => $quantity) {
                $data['element'][$id] = $model->getElement($id);
            }
        }
        return $data;
    }

    /**
     *
     */
    public function action_index(){
        $data = $this->elements();
        $this->view->generate("wishlist", $data);
    }

    /**
     * @param array $args
     */
    public function action_add(array $args = null){
        $element_id = (isset($args[0])? $args[0] : '' );
        $_SESSION['user']['wish'][$element_id] = 1;
        return;
    }

    /**
     * @param array $args
     */
    public function action_delete(array $args = null){
        $element_id = (isset($args[0])? $args[0] : '' );
        unset($_SESSION['user']['wish'][$element_id]);
        $this->view->redirect("/wishlist");
    }
}