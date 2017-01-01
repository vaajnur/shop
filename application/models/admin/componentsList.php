<?php

namespace Models\Admin;

use Core\Model;
use Lib\Lib_Registry;
use Lib\Lib_DateBase;

class Model_ComponentsList extends Model{

    /**
     * @return array
     */
    public function getAll(){
         $sql = '
            SELECT * FROM components
         ';
        $mysqli = Lib_Registry::get('mysqli');
        $query = Lib_DateBase::query($sql) or die($mysqli->error);
        while($row = $query->fetch_assoc()){
            $row2[] = $row;
        }
        return $row2;
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id){
        $sql = "
            SELECT * FROM components WHERE id = $id
         ";
        $mysqli = Lib_Registry::get('mysqli');
        $query = Lib_DateBase::query($sql) or die($mysqli->error);
        $row = $query->fetch_assoc();
        return $row;
    }

    /**
     * @return array
     */
    public function getInputTypes(){
        $sql = "
            SELECT * FROM input_types
        ";
        $res = Lib_DateBase::query($sql);
        if(isset($res)){
            while($row = $res->fetch_assoc()){
                $row2[] = $row;
            }
            if($row2)return $row2;
            return;
        }
    }

    /**
     * @param $component
     * @return array
     */
    public function getComponentFields($component){
        /*$sql = '
          SHOW COLUMNS FROM component_'.$component
        ;
        $mysqli = Lib_Registry::get('mysqli');
        $result = Lib_DateBase::query($sql)or die($mysqli->error);
        while($row = $result->fetch_assoc()){
            $row2[] = $row;
        }
        if(empty($row2))return;
        return $row2;*/
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function addNewComponent($data){
        $sql = "
            INSERT INTO components SET
        ";
        $res = Lib_DateBase::build_query($sql, $data);
        $id = Lib_DateBase::insert_id();
        if($res == true) {
            $comp = strtolower($data['latin_name']);
            $sql2 = "
            CREATE table component_$comp (id int(11) auto_increment primary key, active varchar(255), section_id int(11),
              CONSTRAINT fk_section_id$id FOREIGN KEY (section_id)
  REFERENCES section (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
  )
        ";
            $res2 = Lib_DateBase::query($sql2);
            return $res2;
        }else{
            return $res;
        }
    }

    /**
     * @param $component_name
     * @param $data
     * @return bool|mixed
     */
    public function addField($component_name, $data, $options = null){
        $sql = "
            ALTER TABLE component_$component_name ADD COLUMN {$data['name']} varchar(255)
        ";
        $res = Lib_DateBase::query($sql);
        if($res) {
            $sql2 = "
            INSERT INTO fields SET
            ";
            $res2 = Lib_DateBase::build_query($sql2, $data);
            $id = Lib_DateBase::insert_id();
            // ADD OPTION WHEN ADD FIELD
            if($id == true && !empty($options[0])){
                foreach($options as $opt) {
                    $sql3 = "INSERT INTO input_select_radio SET";
                    $fields = array(
                        "field_id" => $id,
                        "name" =>  $opt,
                        "type" => $data['input_type']
                    );
                    $res3[] = Lib_DateBase::build_query($sql3, $fields);
                }
            }
            if($res2)return $res2;
            return false;
        }
    }

    /**
     * @param $data
     * @param $field_id
     * @param $comp
     * @return bool|mixed
     */
    public function editField($data, $options = null, $field_id, $comp){
        $sql = "SELECT name FROM fields WHERE id = $field_id";
        $res = Lib_DateBase::query($sql);
        $old_field = $res->fetch_assoc();
        $sql2 = "
            UPDATE fields SET
        ";
        $where = "
            WHERE id = $field_id
        ";
        $res2 = Lib_DateBase::build_query($sql2, $data, $where);
        // ******* EDIT OPTION
        if($res && !empty($options)){
            foreach($options as $id=>$opt){
                $sql4 = "UPDATE input_select_radio SET";
                $fields = array(
                    "name" => $opt,
                    "type" => $data['input_type']
                );
                $where = "WHERE id = $id AND field_id = $field_id";
                $res4[] = Lib_DateBase::build_query($sql4, $fields, $where);
            }
        }
        // ********************
        if($res2 && $old_field){
            $sql3 = "
            ALTER TABLE component_$comp CHANGE COLUMN {$old_field['name']} {$data['name']} varchar(255)
            ";
            $res3 = Lib_DateBase::query($sql3);
            if($res3)return $res3;
            return false;
        }
    }

    /**
     * @param $id
     * @param $comp
     * @param $column
     * @return bool|mixed
     */
    public function deleteField($id, $column, $comp){
        $sql = "
          DELETE FROM fields WHERE id = $id
        ";
        $res = Lib_DateBase::query($sql);
        if($res == true){
            $sql2 = "
                ALTER TABLE component_$comp DROP column $column
            ";
            $res2 = Lib_DateBase::query($sql2);
            if($res2 == true){
                return $res2;
            }
            return false;
        }else{
            return false;
        }
    }

    /**
     * @param $options_new
     * @param $field_id
     * @param $input_type
     * @return array|bool
     */
    public function addOption($options_new, $field_id, $input_type){
        foreach ($options_new as $opts) {
            $sql = "INSERT INTO input_select_radio SET";
            $fields = array(
                "field_id" => $field_id,
                "name" => $opts,
                "type" => $input_type
            );
            $res[] = Lib_DateBase::build_query($sql, $fields);
        }
        if($res)return $res;
        return false;
    }

    /**
     * @param $field_id
     * @return bool|mixed
     */
    public function getFieldOptsInfo($field_id){
        $sql = "SELECT * FROM input_select_radio WHERE field_id = $field_id";
        $res = Lib_DateBase::query($sql);
        if($res) {
            while ($row = $res->fetch_assoc()) {
                $row2[] = $row;
            }
            if($row2)return $row2;
            return;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteOption($id){
        $sql = "DELETE FROM input_select_radio WHERE id = $id";
        $res = Lib_DateBase::query($sql);
        if($res) {
            if($res)return $res;
            return;
        }
    }

    /**
     * @param $id
     * @param $comp
     * @return bool|mixed
     */
    public function delete($id, $comp){
        $sql = "
          DELETE FROM components WHERE id = $id
        ";
        $res = Lib_DateBase::query($sql);
        if($res == true){
            $sql2 = "
                DROP table component_$comp
            ";
            $res2 = Lib_DateBase::query($sql2);
            if($res2 == true){
                return $res2;
            }
            return false;
        }else{
            return false;
        }
    }
}