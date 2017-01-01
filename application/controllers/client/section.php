<?php

namespace Controllers\Client;

use Core\Controller;
use Models\Client\Model_Section;

class Controller_Section extends Controller
{
    public function pagination($page, &$components){
        $max_elems = 5;
        $count = $pages = $pagination = null;
        // cut component elements
        foreach($components as &$comp){
            if($comp['latin_name'] == 'catalog'){
                $count = count($comp['elements']);
                if($page){
                    if (empty($comp['elements'][0]) == false){
                        $comp['elements'] = array_slice($comp['elements'], ($page-1)*$max_elems, $max_elems);
                    }
                }
            }
        }
        // cut to pages
        if(isset($count)){
            $pages = $count/$max_elems;
            $half_page = $count%$max_elems;
            if($half_page != 0) {
                $pages++;
            }
            $pages = (int)$pages; // кол-во стр
            for($i = 0;$i < $pages; $i++){
                $pagination[] = $i + 1;
            }
        }

        $pagin['pagination']  = $pagination;
        $pagin['pages'] = $pages;
        return $pagin;
    }

    /**
     *
     */
    function action_detail(array $args = null){
        $section_id = (isset($args[0]) ? $args[0] : null );
        $page = (isset($args[1]) ? $args[1] : 1 );
        $max_elems = (isset($args[2]) ? $args[2] : 5 );

        $model = new \Models\Admin\Model_Section();
        $section_info = $model->getById($section_id);
        $components = $model->getComponentsFieldsElements($section_id);
        /* /////////////////////// PAGINATION ///////// */
        $pagin = $this->pagination($page, $components);
        $url = "section/detail/$section_id";
        /* ****** end pagination * */
        $data = array(
            "section_info" => $section_info,
            "components" => $components,
            "url" => $url,
            "page" => $page,
            // pagin
            "pagination" => $pagin['pagination'],
            "pages" => $pagin['pages']
        );
        $this->view->generate('section/section',  $data);
    }
    /**
     * @param array $args
     */
    function action_category(array $args = null){
        $section_id = (isset($args[0])? $args[0]: "");
        $page = (isset($args[1]) ? $args[1] : 1 );
        $max_elems = (isset($args[2]) ? $args[2] : 5 );

        $model = new Model_Section();
        $model2 = new \Models\Admin\Model_Section();
        $section_info = $model->getById($section_id);
        $sub_sections = $model-> getSubSections($section_id);
        $components = null;
        if($sub_sections == null){
            $components = $model2->getComponentsFieldsElements($section_id);
        }
        /* ***** pagin ***** */
        $pagin = null;
        if($components != null)
            $pagin = $this->pagination($page, $components);
        $url = "section/category/$section_id";

        $data = array(
            "section_info" => $section_info,
            "sub_sections" => $sub_sections,
            "components" => $components,
            "url" => $url,
            "page" => $page,
            // pagin
            "pagination" => $pagin['pagination'],
            "pages" => $pagin['pages']
        );
        $this->view->generate('section/category',  $data);
    }

    /**
     * @param array $args
     */
    function action_element(array $args = null){
        $element_id = (isset($args[0])? $args[0]: "");
        $component_name = (isset($args[1])? $args[1]: "");
        $component_id = (isset($args[2])? $args[2]: "");
        $ajax = isset($args[3])? $args[3]: null;

        $model = new \Models\Admin\Model_Element();
        $data['element'] = $model->getElement($component_id, $component_name, $element_id);
        if($ajax == true){
            $data["component_name"] = $component_name;
            $data["component_id"] = $component_id;
            $this->view->generate('component/catalog/catalog_quick_modal', $data);
        }else{
            $this->view->generate('component/catalog/catalog_element',  $data);
        }
    }

}