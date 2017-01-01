<?

namespace Models\Admin;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;


class Model_Element extends Model
{
    /**
     * @param $comp_id
     * @return array
     */
    public function getFields($comp_id)
    {
        $sql = "
          SELECT f.id, f.name, f.cyrillic_name, f.input_type, f.component_id,
  GROUP_CONCAT(isr.id) AS id1, GROUP_CONCAT(isr.name) AS name1
          FROM fields f
          left join input_select_radio isr
  on f.id = isr.field_id
          WHERE f.component_id = '$comp_id' OR f.component_id = 0 OR f.component_id is null
          GROUP BY f.id
          ORDER BY f.component_id
        ";
        $res = Lib_DateBase::query($sql);
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $row2[] = $row;
            }
            // for multiple values
            if ($row2) {
                foreach ($row2 as &$r) {
                    if (!empty($r['id1']) && !empty($r['name1'])) {
                        $r['id1'] = explode(',', trim($r['id1']));
                        $r['name1'] = explode(',', trim($r['name1']));
                    }
                }
                return $row2;
            }
            return false;
        }
    }

    /**
     * @param $component_id
     * @param $component
     * @param $el_id
     * @return mixed
     */
    public function getElement($component_id, $component, $el_id)
    {
        $sql = "
            SELECT c.*, s.name as section
            FROM component_$component c
            LEFT JOIN section s
            ON c.section_id = s.id
            WHERE c.id = $el_id
        ";
        $res = Lib_DateBase::query($sql);
        if ($res)
            $element = $res->fetch_assoc();
        if ($element) {
            $images = $this->getPictures($el_id, $component_id);
            if (!empty($images))
                $element['image'] = $images;
            $this->getOptions($element, $component_id);
            return $element;
        }
        return;
    }

    /**
     * @param $element
     * @param $component_id
     */
    public function getOptions(&$element, $component_id){
        $element_obj = new Model_Element();
        $fields_full = $element_obj->getFields($component_id);
        $element['fields'] = $fields_full;
        /* **************** JOIN MULTIPLE FIELDS ******** */
        foreach($fields_full as $field1){
            $inp_type = $field1['input_type'];
            $inp_name = $field1['name'];
            if($inp_type == "select_multiple" || $inp_type == "radio" || $inp_type == "select"){
                if(empty($element[$inp_name]))return;
                $sql5 = "SELECT * FROM input_select_radio WHERE id in({$element[$inp_name]})";
                $res4 = Lib_DateBase::query($sql5);
                if($res4->num_rows){
                    $row2 = $fields = array();
                    while($row = $res4->fetch_assoc()){
                        $row2[] = $row['name'];
                        $fields[] = $row;
                    }
                    $element[$inp_name] = implode(',' , $row2);
                    $element['avail_fields'][$inp_name] = $fields;
                }
            }
        }
    }

    /**
     * @param $el_id
     * @param $component_id
     * @return array
     */
    public function getPictures($el_id, $component_id)
    {
        $sql = "
                SELECT * FROM pictures pic WHERE element_id = $el_id AND component_id = $component_id
            ";
        $res = Lib_DateBase::query($sql);
        $image = array();
        if ($res) {
            while ($row2 = $res->fetch_assoc()) {
                $image[] = $row2;
            }
        }
        return $image;
    }

    /**
     * @param $data
     * @param $component_name
     * @return mixed
     */
    public function add($data, $component_name)
    {
        if ($data == null) return;
        $sql = "INSERT INTO component_{$component_name} SET";
        $result = Lib_DateBase::build_query($sql, $data);
        $id = Lib_DateBase::insert_id();
        if ($id == false) return;
        return $id;
    }

    /**
     * @param $el_id
     * @param $multiple_values
     * @param $component_id
     * @return array
     */
    public function addMultipleValues($el_id, array $multiple_values = null, $component_id)
    {
        foreach ($multiple_values as $name => $val) {
            $sql = "INSERT INTO multiple_values SET";
            foreach($val as $val1) {
                $fields = array(
                    "element_id" => $el_id,
                    "value" => $val1,
                    "component_id" => $component_id,
                    "field_name" => $name
                );
                $res[] = Lib_DateBase::build_query($sql, $fields);
            }
        }
        if ($res) return $res;
        return;
    }

    /**
     * @param $el_id
     * @param array $multiple_values
     * @param $component_id
     * @return array
     */
    public function deleteMultipleValues($el_id, array $multiple_values = null, $component_id)
    {
        foreach ($multiple_values as $name => $val) {
            $sql = "DELETE FROM multiple_values WHERE element_id = $el_id AND component_id = $component_id AND field_name = '$name'";
            $res[] = Lib_DateBase::query($sql);
        }
        if ($res) return $res;
        return;
    }

    /**
     * @param $data
     * @param $elem_id
     * @param $component_id
     * @param $component_name
     * @return bool|mixed
     */
    public function edit($data, $elem_id, $component_id, $component_name)
    {
        $sql = "
            UPDATE component_$component_name SET
        ";
        $where = "WHERE id = $elem_id";
        $res = Lib_DateBase::build_query($sql, $data, $where);
        return $res;
    }

    /**
     * @param $el_id
     * @param $component_id
     * @param $comp_name
     * @return mixed
     */
    public function delete($el_id, $component_id, $comp_name)
    {
        $sql = "
            DELETE FROM component_{$comp_name} WHERE id = $el_id
        ";
        $res = Lib_DateBase::query($sql);
        if ($res) {
            $this->deleteImages($el_id, $component_id);
            return $res;
        }
        return;
    }

    /**
     * @param $el_id
     * @param $component_id
     * @return mixed
     */
    public function deleteImages($el_id, $component_id)
    {
        $sql = "
            DELETE FROM pictures WHERE element_id = $el_id AND component_id = $component_id
        ";
        $res = Lib_DateBase::query($sql);
        if ($res) {
            $images = $this->getPictures($el_id, $component_id);
            foreach ($images as $img) {
                if (file_exists("images/$img"))
                    unlink("images/$img");
                if (file_exists("images/small/$img"))
                    unlink("images/small/$img");
                if (file_exists("images/medium/$img"))
                    unlink("images/medium/$img");
            }
            return $res;
        }
        return;
    }

    /**
     * @param array $img_id
     * @return array
     */
    public function deleteSomeImages(array $img_id = null)
    {
        foreach ($img_id as $img) {
            $sql = "SELECT * FROM pictures WHERE id = $img";
            $sql2 = "DELETE FROM pictures WHERE id = $img";
            $res = Lib_DateBase::query($sql);
            $res2 = Lib_DateBase::query($sql2);
            if ($res && $res2) {
                $img1 = $res->fetch_assoc();
                if (file_exists("images/{$img1['image']}"))
                    unlink("images/{$img1['image']}");
                if (file_exists("images/small/{$img1['image']}"))
                    unlink("images/small/{$img1['image']}");
                if (file_exists("images/medium/{$img1['image']}"))
                    unlink("images/medium/{$img1['image']}");
                $res3[] = true;
            } else {
                $res3[] = false;
            }
        }
        return $res3;
    }

    /**
     * @param $el_id
     * @param $images
     * @param $component_id
     * @return bool|mixed
     */
    public function addImages($el_id, $images, $component_id)
    {
        $sql = "INSERT INTO pictures SET";
        $db_obj = new Lib_DateBase();
        $res = array();
        if (is_array($images)) {
            foreach ($images as $image) {
                $fields = array(
                    "element_id" => $el_id,
                    "image" => $image,
                    "component_id" => $component_id
                );
                $res = $db_obj->build_query($sql, $fields);
                if ($res == false) {
                    $res[$image] = "не загрузилось!";
                }
            }
        }

        return $res;
    }
}