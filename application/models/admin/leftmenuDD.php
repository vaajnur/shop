<?

namespace Models\Admin;

use Lib\Lib_DateBase;
use Core\Model;

class Model_LeftmenuDD extends Model{
    /**
     * @param $current_id
     * @param $new_parent_id
     * @return bool|mixed
     */
    public function drag($current_id, $new_parent_id){
        $sql = "
            UPDATE section SET
        ";
        $fields = array("parent_id" => $new_parent_id);
        $where = "WHERE id = $current_id";
        $res = Lib_DateBase::build_query($sql, $fields, $where);
        if($res)return $res;
        return;
    }
}