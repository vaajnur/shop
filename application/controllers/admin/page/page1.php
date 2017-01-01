<?

namespace Controllers\Admin;

use Core\Controller;

class Controller_Page1 extends Controller{
    public function action_index(){
        $data = null;
        $this->view->generate("page", $data);
    }
}