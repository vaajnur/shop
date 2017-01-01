<?

namespace Controllers\Admin;

use Models\Admin\Model_ComponentsSort;
use Core\Controller;

class Controller_ComponentsSort extends Controller{
    /**
     * @param array $args
     */
    public function action_sort(array $args = null){
        $section_id = isset($args[0])? $args[0]: null;
        $model = new Model_ComponentsSort();
        if(isset($_POST['comp_ids'])){
            $arr = array_flip(json_decode($_POST['comp_ids']));
            $res = $model->sort($section_id, $arr);
            echo(json_encode($res));
            return;
        }
    }

    public function action_addsort(){
        $model = new Model_ComponentsSort();
//        $model->addsort();
    }
}