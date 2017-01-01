<?

namespace Controllers\Admin;

use Core\Controller;
use Lib\Lib_ImageUpload;
use Models\Admin\Model_Element;

class Controller_Element extends Controller{

    /**
     * @param $element_id
     * @param $component_id
     */
    public function upload_images($element_id, $component_id){
        if(!empty($_FILES['image']['name']) && $element_id != false) {
            $element_obj = new Model_Element();

            $path_to_save = "images/";
            if(!is_array($_FILES['image']['tmp_name'])) {
                $tmp_name[] = $_FILES['image']['tmp_name'];
                $file[] = $_FILES['image']['name'];
            }else{
                $tmp_name = $_FILES['image']['tmp_name'];
                $file = $_FILES['image']['name'];
            }

            $obj_image_upload = new Lib_ImageUpload;
            $mess = $obj_image_upload->upload_image($tmp_name, $file, $path_to_save); // array mess
            $element_obj->deleteImages($element_id, $component_id);
            $mess2 = $element_obj->addImages($element_id, $file, $component_id); // array mess2
            if(false == empty($mess))
                $_SESSION['image_resize_err'] = $mess;
            if($mess2 != true)
                $_SESSION['image_upload_err'] = $mess2;
        }
    }

    /**
     * @param array $args
     */
    public function action_index(array $args = null){
        // this action for admin/orders
        $component_id = isset($args[0])? $args[0] : null;
        $el_id = (isset($args[1])? $args[1] : null);
        $component = (isset($args[2])? $args[2] : null);
        $model = new Model_Element();
        $data['element'] = $model->getElement($component_id, $component, $el_id);
        $this->view->generate("element/element", $data);
    }

    /**
     * @param array $args
     */
    public function action_add(array $args = null){
        $section_id = isset($args[0]) ? $args[0] : '';
        $component_id = isset($args[1]) ? $args[1] : '';
        $component_name = isset($args[2]) ? $args[2] : '';

        $element_obj = new Model_Element();
        if(isset($_POST['send'])){
            unset($_POST['send']);
            $_POST['active'] = (isset($_POST['active']) ? 1 : 0);
            $_POST['section_id'] = $section_id;
            // multiple values
            foreach($_POST as $name=>&$value){
                if(is_array($value)){
//                    $multiple_values[$name] = $value;
                    $value = implode(',' , $value);
//                    unset($value);
                }
            }
            // images
            if(is_array($_FILES['image']['name'])){
                if(!empty($_FILES['image']['name'][0])){
                    $_POST['image'] = $_FILES['image']['name'][0] ;
                }
            }elseif(!empty($_FILES['image']['name'])){
                $_POST['image'] = $_FILES['image']['name'];
            }
            $insert_id = $element_obj->add($_POST, $component_name);
            // multiple values
            if($insert_id == true && !empty($multiple_values)){
//                $res = $element_obj->addMultipleValues($insert_id, $multiple_values, $component_id);
            }
            /* *********** upload images ************ */
            $this->upload_images($insert_id, $component_id);
            /* *********************** */
            $this->view->redirect("/admin/section/detail/$section_id/$insert_id");
        }

    }

    /**
     * @param array $args
     */
    public function action_edit(array $args = null){
        $section_id = ($args[0] != null ? $args[0] : '');
        $elem_id = ($args[1] != null ? $args[1] : '');
        $component_id = ($args[2] != null ? $args[2] : '');
        $component_name = ($args[3] != null ? $args[3] : '');
        /* **************** FOR FIELDS ********* */
        $element_obj = new Model_Element();
        $fields = $element_obj->getFields($component_id);
        $element = $element_obj->getElement($component_id, $component_name, $elem_id);

        $data = array(
            "section_id" => $section_id,
            "elem_id" => $elem_id,
            "component_id" => $component_id,
            "component_name" => $component_name,
            "fields" => $fields,
            "element" => $element
        );

        /* *********************** edit element */
        if(isset($_POST['send'])){
            unset($_POST['send']);
            $_POST['active'] = (isset($_POST['active']) ? 1 : 0);
            if(is_array($_FILES['image']['name']) ){
                if(!empty($_FILES['image']['name'][0])){
                    $_POST['image'] = $_FILES['image']['name'][0] ;
                }
            }elseif(!empty($_FILES['image']['name'])){
                $_POST['image'] = $_FILES['image']['name'];
            }
            // delete images
            if(!empty($_POST['img_to_delete'])){
                $img_id = $_POST['img_to_delete'];
                unset($_POST['img_to_delete']);
                $res2 = $element_obj->deleteSomeImages($img_id);
            }
            // multiple values
            foreach($_POST as $name=>&$val){
                if(is_array($val)) {
                    $val = implode(',' , $val);
//                    $multiple_values[$name] = $val;
//                    unset($val);
                }
            }
            /* /// edit element */
            $res = $element_obj->edit($_POST, $elem_id, $component_id, $component_name);
            // multiple values
            if($res && !empty($multiple_values)){
//                $res3 = $element_obj->deleteMultipleValues($elem_id, $multiple_values, $component_id);
//                $res2 = $element_obj->addMultipleValues($elem_id, $multiple_values, $component_id);
            }
            /* *********** upload images ************ */
            if(!empty($_FILES['image']['name']) && !empty($_FILES['image']['name'][0]) && $res == true)
                // upload new
                $this->upload_images($elem_id, $component_id);
            /* *********************** */
            $this->view->redirect("/admin/section/detail/$section_id");
            return;
        }
        $this->view->generate("element/edit", $data);
        return;
    }

    /**
     * @param array $args
     */
    public function action_delete(array $args = null){
        $section_id = ($args[0] != null ? $args[0] : '');
        $elem_id = ($args[1] != null ? $args[1] : '');
        $component_id = ($args[2] != null ? $args[2] : '');
        $component_name = ($args[3] != null ? $args[3] : '');

        $model = new Model_Element();
        $res = $model->delete($elem_id, $component_id, $component_name);
        /* *********************** */
        $this->view->redirect("/admin/section/detail/$section_id");
    }
}