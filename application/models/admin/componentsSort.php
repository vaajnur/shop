<?

namespace Models\Admin;

use Lib\Lib_DateBase;
use Core\Model;

class Model_ComponentsSort extends Model{
    /**
     * @param $section_id
     * @param $data
     * @return array|bool
     */
    public function sort($section_id, $data){
        $db_obj = new Lib_DateBase();
        foreach($data as $comp_id=> $sort) {
            $sql = "
            UPDATE section_components SET
        ";
            $fields = array(
                "sort_rang" => $sort
            );
            $where = "WHERE section_id = $section_id AND component_id = $comp_id";
            $res[] = $db_obj->build_query($sql, $fields, $where);
        }
        if(isset($res))return $res;
        return false;
    }

    public function addsort(){
        $sql = "ALTER table section_components ADD COLUMN sort_rang varchar(255)";
        $res = Lib_DateBase::query($sql);
        echo $res;
        for($i = 0; $i< 39;$i++) {
            $sql = "update section_components SET";
            $fields = array(
                "sort_rang" => 0
            );
            $res2[] = Lib_DateBase::build_query($sql, $fields);
        }
        print_r($res2);
        return $res2;
    }
}