<?php

namespace Controllers\Admin;

use Core\Controller;
use Models\Admin\Model_Leftmenu;


class Controller_Leftmenu extends Controller
{

    /**
     * @return array
     */
    public function create($param = null)
    {
        $menu = new Model_Leftmenu();
        $sections = $menu->get();

        /**
         * @param $entry
         * @param $entryStatic
         * @param $option
         * @param $div
         * @param $ul
         * @param $ul_category
         */
        function FunctionName(&$entry, $entryStatic, &$option, &$div, &$ul, &$ul_category)
        {
            global $param;
            static $level = 0;
            foreach ($entry as $key => &$arr) {
                /* *************************** HTML  */
                // 1
                $option .= "<option value='" . $arr['id'] . ($arr['id'] == $param ? 'selected' : null ). "'>" . str_repeat("-", $level * 2) . $level . ". " . $arr['name'] . "</option>";
                // 2
                $div .= "<div class='level_" . $level . "' data-id='".$arr['id']."' draggable='true'>" . "<a href='/admin/section/detail/".$arr['id']."'>"  . str_repeat("-", $level)  . $level . '. ' . $arr['name'] . "</a></div>";
                // 3
                ($arr['parent_id'] != 0 ? $ul .= "<li><a href='section/category/".$arr['id']."'>".$arr['name'] :  ''); // section/detail/ to section/category 09.06.2016
                // 4
                ($arr['parent_id'] != 0 && $arr['component_id'] == 1 ? $ul_category .= "<li><a href='section/category/".$arr['id']."'>".$arr['name'] :  '');
                /* ******************************* */
                $level++;
                foreach ($entryStatic as $key2 => $value2) {
                    if ($arr['id'] == $value2['parent_id']) {
                        $arr['child'][] = $value2;
                    }//if
                }//for helperIterator
                if (isset($arr['child'])) {
                    // 3
                    ($arr['parent_id'] != 0 ? $ul .= "<span class=\"caret\"></span></a><ul class=\"dropdown-menu\">" : '' );
                    // 4
                    ($arr['parent_id'] != 0 && $arr['component_id'] == 1 ? $ul_category .= "</a><ul class=\"categories cat_level_{$level}\">" : '' );
                    FunctionName($arr['child'], $entryStatic, $option, $div, $ul, $ul_category);
                    $level--;
                    $ul .= "</ul>";
                    $ul_category .= "</ul>";
                } // if child
                else {
                    $level--;
                    $ul .= "</a></li>";
                    $ul_category .= "</a></li>";
                }
            }    // for
        }

        foreach ($sections as $key => $value) {
            if ($value['parent_id'] == 0) {
                $sections1 = array($value);
            }
        }
        $option = "<select class='form-control' name='parent_id' id=''>"; // in edit section
        $option .= "<option value=''>Выбрать</option>";
        $div = "<div class='admin_sections_menu'>"; // admin left
        $ul = "<ul class='nav navbar-nav'>"; // in client topmenu
        $ul_category = "<ul class='aa-catg-nav'>"; // in client leftmenu

        FunctionName($sections1, $sections, $option, $div, $ul, $ul_category);

        $option .= "</select>";
        $div .= "</div>";
        $ul .= "</ul>";
        $ul_category .= "</ul>";

        return array("select" => $option, "div" => $div, "ul" => $ul, "ul_category" => $ul_category);
    }
}