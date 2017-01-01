<?php

namespace Models\Admin;

use Core\Model;
use Lib\Lib_Registry;
use Lib\Lib_DateBase;

class Model_Section extends Model
{
    /**
     * @return array
     */
    public function getAll()
    {
        $sql = "
      SELECT
            s.id as sid, s.image as s_image, s.name as s_name, s.parent_id, s.template_id, s.description as s_description,
            c.id as c_id, GROUP_CONCAT(c.name )as c_name,
            s2.name as s2_name,
            t.name as t_name
              FROM section s
              LEFT JOIN section_components sc
              ON s.id = sc.section_id
              LEFT JOIN components c
              ON sc.component_id = c.id
              LEFT  JOIN section s2
              ON s2.id = s.parent_id
              LEFT JOIN template t
              ON  s.template_id = t.id
  GROUP BY sid
      ";
        $result = Lib_DateBase::query($sql);
        while ($row = $result->fetch_assoc()) {
            $row2[] = $row;
        }
        if (empty($row2)) return;
        return $row2;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $sql = "
          SELECT s.id, s.image, s.name, s.parent_id, s.description,
          s2.name as parent_name,
          t.name as temp_name
          FROM section s
          LEFT JOIN section s2
          ON s.parent_id = s2.id
          LEFT JOIN template t
          ON s.template_id = t.id
          WHERE s.id = {$id}
          ";
        $mysqli = Lib_Registry::get("mysqli");
        $result = Lib_DateBase::query($sql) or die($mysqli->error);
        $row = $result->fetch_assoc();
        return $row;
    }

    /**
     * @param $section_id
     * @return array
     */
    public function getComponentsFieldsElements($section_id)
    {
        $sql = "
            SELECT * FROM section_components WHERE section_id = {$section_id} ORDER BY sort_rang
        ";
        $mysqli = Lib_Registry::get('mysqli');
        $query = Lib_DateBase::query($sql) or die($mysqli->error);
        while ($res = $query->fetch_assoc()) {
            $component_id[] = $res;// component section pair
        }
        if (!isset($component_id)) return;
        $db_obj = new Lib_DateBase();
        foreach ($component_id as $c_id) {
            $sql2 = "
                SELECT * FROM components WHERE id = {$c_id['component_id']}
            ";
            $query2 = $db_obj->query($sql2);
            while ($res2 = $query2->fetch_assoc()) {
                $components[] = $res2; // component name
            }
        }
        if (!$components) return;
        /* ************************** ELEMENTS */
        $elems = array();
        foreach ($components as $key => $comp) {
            global $elems;
            $elems[$key] = $comp;
            $sql3 = "
                SELECT *
                FROM component_{$comp['latin_name']}
                WHERE section_id = {$section_id}
            ";
            /* **************** FOR FIELDS ********* */
            $element_obj = new Model_Element();
            $fields_full = $element_obj->getFields($comp['id']);
            $elems[$key]['fields'] = $fields_full;
            /* ********************* ELEMS ARRAY ************** */
            $elems[$key]['elements'] = array();
            $query3 = $db_obj->query($sql3) or die($mysqli->error);
            while ($res3 = $query3->fetch_assoc()) {
                $elems[$key]['elements'][] = $res3;
            }
            /* **************** JOIN MULTIPLE FIELDS ******** */
            foreach($fields_full as $field1){
                $inp_type = $field1['input_type'];
                $inp_name = $field1['name'];
               if($inp_type == "select_multiple" || $inp_type == "radio" || $inp_type == "select"){
                   foreach($elems[$key]['elements'] as &$elem){
                       if(empty($elem[$inp_name]))continue;
                       $sql5 = "SELECT * FROM input_select_radio WHERE id in({$elem[$inp_name]})";
                       $res4 = Lib_DateBase::query($sql5);
                       if($res4->num_rows){
                           $row2 = array();
                            while($row = $res4->fetch_assoc()){
                                $row2[] = $row['name'];
                            }
                           $elem[$inp_name] = implode(',' , $row2);
                       }
                   }
               }
            }
            /* ********************** IMAGES ARR *************** */
            $sql4 = "
                SELECT *
                FROM pictures WHERE component_id = {$comp['id']}
            ";
            $res = $db_obj->query($sql4);
            while ($row = $res->fetch_assoc()) {
                $images[$key][] = $row;
            }
            /* ******************* IMAGES JOIN ELEMS ********************** */
            if (isset($images)) {
                foreach ($elems[$key]['elements'] as &$elems2) {
                    if (isset($elems2['image']))
                        $elems2['image'] = array();
                    foreach ($images[$key] as $img) {
                        if ($elems2['id'] == $img['element_id']) {
                            if (isset($elems2['image']))
                                $elems2['image'][] = $img['image'];
                        }
                    }
                }
            }

            /* ************ */
        }
        if (empty($elems)) return;
        return $elems;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function add($data)
    {
        if ($data == null) return;
        $fields = $data;
        $sql = 'INSERT INTO section SET';
        $result = Lib_DateBase::build_query($sql, $fields);
        $id = Lib_DateBase::insert_id();
        if (!$id) return false;
        $this->addComponent($id, $data['component_id']);
        return $id;
    }

    /**
     * @param $section_id
     * @param $component_id
     * @return bool|mixed
     */
    public function addComponent($section_id, $component_id)
    {
        $fields = array(
            "section_id" => $section_id,
            "component_id" => $component_id
        );
        $sql = 'INSERT INTO section_components SET';
        $res = Lib_DateBase::build_query($sql, $fields);
        return $res;
    }

    /**
     * @param $section_id
     * @param $component_id
     * @return mixed
     */
    public function deleteComponent($section_id, $component_id)
    {
        $sql = "DELETE FROM section_components WHERE section_id = $section_id AND component_id = $component_id";
        $res = Lib_DateBase::query($sql);
        return $res;
    }

    /**
     * @param $section_id
     * @return array
     */
    public function getAvailableComps($section_id)
    {
        $sql = "SELECT * FROM components";
        $res = Lib_DateBase::query($sql);
        while ($row = $res->fetch_assoc()) {
            $comps[] = $row['id'];
        }
        // ***********
        $sql2 = "SELECT * FROM section_components WHERE section_id = $section_id";
        $res2 = Lib_DateBase::query($sql2);
        if (!$res2->num_rows) $section_comps = array();
        while ($row3 = $res2->fetch_assoc()) {
            $section_comps[] = $row3['component_id'];
        }
        $available = array_diff($comps, $section_comps);
        // *****************
        $db_obj = new Lib_DateBase();
        foreach ($available as $avail) {
            $sql3 = "SELECT * FROM components WHERE id = $avail";
            $res = $db_obj->query($sql3);
            if (isset($res))
                $available_comps[] = $res->fetch_assoc();
        }
        if (isset($available_comps)) return $available_comps;
        return;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function edit($id, $data)
    {
        if ($data == null) return;
        $fields = $data;
        $sql = 'UPDATE section SET';
        $where = "WHERE id={$id}";
        $result = Lib_DateBase::build_query($sql, $fields, $where);
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if ($id == null) return;
        $sql = 'DELETE FROM section WHERE id=' . $id;
        $result = Lib_DateBase::query($sql);
        return $result;
    }
}

?>