<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_ComponentsList;
use Models\Admin\Model_Element;

class Controller_ComponentsList extends Controller{
    /**
     * @param array $args
     */
    public function action_index(array $args = null){
        $components_obj = new Model_ComponentsList();
        // ADD COMPONENT
        if(isset($_POST['send'])){
            unset($_POST['send']);
            $_POST['latin_name'] = strtolower($_POST['latin_name']);
            $pattern = '/^[a-z][a-z\d\S]*$/';
            preg_match($pattern, $_POST['latin_name'], $matches);
            if(empty($matches) == true){
                $data['mess'] = "Поле Component name* содержит недопустимые символы!";
                $data['mess_type'] = "danger";
            }else {
                $res = $components_obj->addNewComponent($_POST);

                // ////////// CREATE FILE
                $path = VIEW_PATH . DS . "client/component/{$_POST['latin_name']}.php";
                $file1 = fopen($path, "w");
                $str1 = '
                <? if (!empty($comp[\'elements\'])): ?>
                    <? foreach ($comp[\'elements\'] as $elem): ?>
                        <? if (isset($elem[\'image\'][0])): ?>
                            <img src="images/medium/<?= $elem[\'image\'][0] ?>" alt="">
                        <? endif ?>
                        <? foreach ($elem as $key => $el): ?>
                            <? if($key != "id" && $key != "section_id" && $key != "active" && $key != "image"): ?>
                                <p><?= $el ?></p>
                            <? endif ?>
                        <? endforeach ?>
                    <? endforeach ?>
                <? endif ?>
                ';
                if (file_exists($path))
                    fwrite($file1, $str1);

                // mess for add
                $data['mess'] = $res == true ? "Компонент {$_POST['name']} добавлен!" : "Не удалось создать компонент {$_POST['name']}!";
                $data['mess_type'] = $res == true ? 'success' : 'danger';
            }
        }
        // mess delete comp
        $mess = isset($args[0])? $args[0] : null ;
        if($mess == "del") {
            $res = $args[1];
            $comp = $args[2];
            $data['mess'] = $res == true ? "Компонент $comp удален!" : "Не удалось удалить компонент $comp";
            $data['mess_type'] = $res == true ? "success" : "danger";
        }

        $data['components'] = $components_obj->getAll();
        $this->view->generate("components_list/components_list", $data);
    }

    /**
     * @param array $args
     */
    public  function action_component(array $args = null){
        $component_id = isset($args[0]) ? $args[0] : '';
        $component_name = isset($args[1]) ? $args[1] : '';

        $components_obj = new Model_ComponentsList();
        $element_obj = new Model_Element();

        // ////////////////////////////////////////// ADD FIELD
        if(isset($_POST['send'])){
            unset($_POST['send']);
            $_POST['name'] = strtolower($_POST['name']);
            $_POST['component_id'] = $component_id;
            $pattern = '/^[a-z][a-z\d\S]*$/';
            preg_match($pattern, $_POST['name'], $matches);
            if(empty($matches) == true){
                $data['mess'] = "Поле Field name* содержит недопустимые символы!";
                $data['mess_type'] = "danger";
            }else {
                // ADD OPTIONS for select, radio, multiselect
                $options = null;
                if(!empty($_POST['option_name'])){
                    $options = $_POST['option_name'];
                    unset($_POST['option_name']);
                }
                $res = $components_obj->addField($component_name, $_POST, $options);
                $data['mess'] = $res == true ? "Поле {$_POST['cyrillic_name']} добавлено!" : "Не удалось добавить поле {$_POST['cyrillic_name']}";
                $data['mess_type'] = $res == true ? "success" : "danger";
            }
        }

        $fields = $element_obj->getFields($component_id);
        $input_types = $components_obj->getInputTypes();
        $component = $components_obj->getById($component_id);

        $data['component'] = $component;
        $data['fields'] = $fields;
        $data['input_types'] = $input_types;

        $this->view->generate('components_list/component2', $data);
    }

    /**
     * @param array $args
     * @return bool|mixed
     */
    public function action_editField(array $args = null){
        $field_id = isset($args[0])?$args[0] : null ;
        $comp = isset($args[1])?$args[1] : null ;
        $refresh_info = isset($args[2])?$args[2] : null ;

        $model = new Model_ComponentsList();
        if(isset($refresh_info)){
            $res = $model->getFieldOptsInfo($field_id);
            echo json_encode($res);
            return;
        }

        if(!empty($_POST['name']) && !empty($_POST['cyrillic_name'])){
            $pattern = '/^[a-z][a-z\d\S]*$/';
            preg_match($pattern, $_POST['name'], $matches);
            if(empty($matches) == true){
                echo "Поле Field name* содержит недопустимые символы!";
                return;
            }else {
                // EDIT OPTION
                $options = null;
                if(!empty($_POST['option_name'])){
                    $options = $_POST['option_name'];
                    unset($_POST['option_name']);
                }
                // ADD NEW OPTION
                $options_new = null;
                if(!empty($_POST['option_name_new'])){
                    $options_new = $_POST['option_name_new'];
                    unset($_POST['option_name_new']);
                }
                $res = $model->editField($_POST, $options, $field_id, $comp);
                if($res == true && isset($options_new)){
                    $res2 = $model->addOption($options_new,$field_id, $_POST['input_type']);
                }
                echo $res;
                return;
            }
        }else{
            echo "Пустые поля!";
            return;
        }
    }

    /**
     * @param array $args
     */
    public function action_deleteField(array $args = null){
        $id = isset($args[0])? $args[0] : null ;
        $column = isset($args[1])? $args[1] : null ;
        $comp_id = isset($args[2])? $args[2] : null ;
        $comp = isset($args[3])? $args[3] : null ;

        $model = new Model_ComponentsList();
        $res = $model->deleteField($id, $column, $comp);
        $this->view->redirect("/admin/componentsList/component/$comp_id/$comp");
    }

    /**
     * @param array $args
     */
    public function action_deleteOption(array $args = null){
        $id = isset($args[0])? $args[0]:null;
        $model = new Model_ComponentsList();
        $res = $model->deleteOption($id);
        echo $res;return;
    }

    /**
     * @param array $args
     */
    public function action_edit(array $args = null){
        /*$id = ($args[0] != null? $args[0] : '');
        $components_obj = new Model_ComponentsList();
        if(isset($_POST['send'])) {
            $data = $_POST;
            $data['id'] = $id;
            $components_obj->edit($data);
        }
        $data2 = "";
        $this->view->generate('components_list/edit', $data2);*/
    }

    /**
     * @param array $args
     */
    public function action_delete(array $args = null){
        $id = isset($args[0]) ? $args[0] : null;
        $comp = isset($args[1]) ? $args[1] : null ;

        $components_obj = new Model_ComponentsList();
        $res = (int)$components_obj->delete($id, $comp);
        if($res)
            if(file_exists(VIEW_PATH.DS."client/component/$comp.php"))
                unlink(VIEW_PATH.DS."client/component/$comp.php");

        $this->view->redirect("/admin/componentsList/index/del/$res/$comp");
    }
}