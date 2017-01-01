<?

namespace Models\Admin;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;


class Model_Orders extends Model{

    /**
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT
        o.id, o.quantity, o.pay_type, o.date,
        c_c.name as c_c_name, c_c.image, c_c.id as c_c_id,
        isr.name as isr_name,
        c_d.name as c_d_name, c_d.secondname as c_d_secondname
        FROM `orders` o
        LEFT JOIN component_catalog c_c
        ON o.element_id = c_c.id
        LEFT JOIN input_select_radio isr
        ON o.size_id = isr.id
        LEFT JOIN customer_details c_d
        ON o.customer_id = c_d.customer_id
        ";
        $res = Lib_DateBase::query($sql);
        if($res){
            while($row = $res->fetch_assoc()){
                $row2[] = $row;
            }
        }
        if($row2)return $row2;
        return;
    }


}

?>