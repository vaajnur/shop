<?

namespace Controllers\Client;

use Core\Controller;
use Models\Admin\Model_Section;

class Controller_Startpage extends Controller{
    public function action_index(){
        $model = new Model_Section();
        $data['components'] = $model->getComponentsFieldsElements(5);
        $this->view->generate('startpage', $data);
    }
}