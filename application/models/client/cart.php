<?

namespace Models\Client;

use Core\Model;
use Lib\Lib_DateBase;

class Model_Cart extends Model
{
/*    public function getElement($id)
    {
        $sql = "
            SELECT  * FROM component_catalog WHERE id = $id
        ";
        $res = Lib_DateBase::query($sql);
        if ($res)
            $row = $res->fetch_assoc();
        if ($row) {
            $sql2 = "
            SELECT * FROM pictures WHERE element_id = $id AND component_id = 1
        ";
            $res2 = Lib_DateBase::query($sql2);
            if ($res2->num_rows)
                $row['image'] = $res2->fetch_assoc();
            return $row;
        }
        return false;
    }*/

    /**
     * @param $id
     * @return bool|mixed
     */
    public function getOptionValue($id){
        $sql = "SELECT * FROM input_select_radio WHERE id in ($id)";
        $res = Lib_DateBase::query($sql);
        if($res)
            while($row = $res->fetch_assoc())
                $row2[] = $row['name'];
        if($row2 != null)return $row2;
        return false;
    }
}