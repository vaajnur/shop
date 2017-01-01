<?php 

namespace Controllers\Admin;

use Core\Controller;
use Lib\Lib_ImageUpload;
use Models\Admin\Model_Section;
use Models\Admin\Model_ComponentsList;
use Models\Admin\Model_Templates;

class Controller_Section extends Controller
{
    /**
     * @param $section_id
     */
    public function upload_images($section_id){
        if(!empty($_FILES['image']['name']) && $section_id != false) {
//            include "application/lib/imageUpload.php";

            $path_to_save = "images/";
            if(!is_array($_FILES['image']['tmp_name'])) {
                $tmp_name[] = $_FILES['image']['tmp_name'];
                $file[] = $_FILES['image']['name'];
            }else{
                $tmp_name = $_FILES['image']['tmp_name'];
                $file = $_FILES['image']['name'];
            }

            $obj_image_upload = new Lib_ImageUpload();
            $mess = $obj_image_upload->upload_image($tmp_name, $file, $path_to_save); // array mess
            if(false == empty($mess))
                $_SESSION['image_resize_err'] = $mess;

        }
    }
    /**
     *
     */
    function action_index(array $args = null){
        $mess = (isset($args[0])? $args[0] : null);
        // mess for delete section
        if($mess == "del") {
            $res = isset($args[1])?$args[1] : false ;
            $section_name = isset($args[2])? urldecode($args[2]) : null;
            $data['mess'] = ($res == true ? " Раздел $section_name  удален!" : "Ошибка! Раздел $section_name не удаален!");
            $data['mess_type'] = ($res == true ? "success" : "danger");
        }

        $model = new Model_Section();
        $data['sections'] = $model->getAll();
        $this->view->generate('section/section',  $data);
    }

    /**
     * @param array $args
     */
    function action_detail(array $args = null){
        $id = (isset($args[0]) ? $args[0]: null);
        /* ******* mess for added ELEMENTS */
        $mess['added'] = (isset($args[1]) ? $args[1]: null);
        /* ********* mess for error on add ELEMENTS */
        if(isset($_SESSION['image_resize_err'])){
            $mess['image_resize_err'] = $_SESSION['image_resize_err'];
            $_SESSION['image_resize_err'] = null;
        }
        if(isset($_SESSION['image_upload_err'])){
            $mess['image_upload_err'] = $_SESSION['image_upload_err'];
            $_SESSION['image_upload_err'] =  null;
        }
        /* ********** end mess ***** */
        $model = new Model_Section();

        $section_info = $model->getById($id);
        $components = $model->getComponentsFieldsElements($id);
        $available_componenet = $model->getAvailableComps($id);

        $data = array(
            "section_info" => $section_info,
            "components" => $components,
            "mess" => $mess,
            "available_componenet" => $available_componenet
        );
        $this->view->generate('section/detail2',  $data);
    }

    /**
     *
     */
    function action_add(){
        $components_list_obj = new Model_ComponentsList;
        $section_obj = new Model_Section();
        $templ_obj = new Model_Templates();

        $data['components_list'] = $components_list_obj->getAll();
        $data['templates'] = $templ_obj->getAll();

        if(isset($_POST['send'])){
            unset($_POST['send']);
            $insert_id = false;
            if(empty($_POST['name'])) {
                $data['mess'] =  "Ошибка! Пустое поле Название раздела!";
                $data['mess_type'] = "danger" ;
            }else if(empty(($_POST['parent_id']))){
                $data['mess'] =  "Ошибка! Не выбран родительский раздел!";
                $data['mess_type'] = "danger" ;
            }else{
                if(!empty($_FILES['image']['name'])) {
                    $_POST['image'] = $_FILES['image']['name'];
                }
                $insert_id = $section_obj->add($_POST);
                if(!empty($_FILES['image']['name']) && $insert_id) {
                    $this->upload_images($insert_id);
                }
                // mess
                $data['mess'] = ($insert_id == true ? " Раздел {$_POST['name']} добавлен!" : "Ошибка! Раздел {$_POST['name']} не добавлен!");
                $data['mess_type'] = ($insert_id == true ? "success" : "danger" );
            }
        }
        $this->view->generate('section/add', $data);
    }
    /**
     * @param array $args
     */
    function action_edit(array $args = null){
        $section_id = (isset($args[0])? $args[0]: "");
        $model = new Model_Section();
        $data['section'] = $model->getById($section_id);

        // for mess
        $mess = (isset($args[1])? $args[1]: null);
        if(isset($mess)) {
            $data['mess'] = ($mess != -1 ? "Отредактировано!" : " Ошибка!!! ");
            $data['mess_type'] = ($mess != -1 ? "success" : "danger");
        }

        if(isset($_POST['send'])){
            unset($_POST['send']);
            // не выбран раздел
            if($_POST['parent_id'] == ''){
                $_POST['parent_id'] = $data['section']['parent_id'];
            }
            //  картинка раздела
            if(!empty($_FILES['image']['name'])){
                $_POST['image'] = $_FILES['image']['name'];
                // удаляю старую
                if(!empty($data['section']['image'])) {
                    if(file_exists("images/{$data['section']['image']}"))
                        unlink("images/{$data['section']['image']}");
                    if(file_exists("images/small/{$data['section']['image']}"))
                        unlink("images/small/{$data['section']['image']}");
                    if(file_exists("images/medium/{$data['section']['image']}"))
                        unlink("images/medium/{$data['section']['image']}");
                }
                $this->upload_images($section_id);
            }

            $res = $model->edit($section_id, $_POST);
            $this->view->redirect("/admin/section/edit/$section_id/$res");
        }
        $this->view->generate('section/edit',  $data);
    }

    /**
     * @param array $args
     */
    function action_delete(array $args = null){
        $id = (isset($args[0])? $args[0]: "");
        $model = new Model_Section();
        $section = $model->getById($id);

        $res = $model->delete($id);
        if(!empty($section['image'])) {
            if(file_exists("images/{$section['image']}"))
                unlink("images/{$section['image']}");
            if(file_exists("images/small/{$section['image']}"))
                unlink("images/small/{$section['image']}");
            if(file_exists("images/medium/{$section['image']}"))
                unlink("images/medium/{$section['image']}");
        }

        $this->view->redirect("/admin/section/index/del/$res/{$section['name']}");
    }

    /**
     * @param array $args
     */
    function action_addComponent(array $args = null){
        $section_id = isset($args[0])? $args[0] : null ;
        $model = new Model_Section();
        if(isset($_POST['send_comp'])){
            $comp_id = $_POST['available_component'];
            $res = $model->addComponent($section_id, $comp_id);
        }
        $this->view->redirect("/admin/section/detail/$section_id");
    }

    /**
     * @param array $args
     */
    function action_deleteComponent(array $args = null){
        $section_id = isset($args[0])? $args[0] : null ;
        $component_id = isset($args[1])? $args[1] : null;
        $model = new Model_Section();
        $res = $model->deleteComponent($section_id, $component_id);
        $this->view->redirect("/admin/section/detail/$section_id");
    }
}