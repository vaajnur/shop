<?

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_LeftmenuDD;

class Controller_LeftmenuDD extends Controller{
    /**
     * @param array $args
     */
    public function action_drag(array $args = null){
        $current_id = isset($args[0])? $args[0] : null ;
        $new_parent_id = isset($args[1])? $args[1] : null ;
        $model = new Model_LeftmenuDD();
        $res = null;
        $res = $model->drag($current_id, $new_parent_id);
        if($res)
            echo $res;
        else
            echo "Не удалось переместить раздел!";
        return;
    }
}