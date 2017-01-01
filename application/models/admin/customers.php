<?

namespace Models\Admin;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;


class Model_Customers extends Model{

    /**
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT * FROM `customers`";
        $res = Lib_DateBase::query($sql);
        if($res){
            while($row = $res->fetch_assoc()){
                $row2[] = $row;
            }
        }
        if($row2)return $row2;
        return;
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerDetails($customer_id){
        $sql = "SELECT * FROM customer_details WHERE customer_id = $customer_id";
        $res = Lib_DateBase::query($sql);
        if($res)
            $row = $res->fetch_assoc();
        if(isset($row))
            return $row;
        return;
    }

    /**
     * @param $id
     * @param $data
     * @return bool|mixed
     */
    public function editCustomerDetails($id, $data){
        $sql = "UPDATE customer_details SET";
        $where = "WHERE customer_id = $id";
        $res = Lib_DateBase::build_query($sql, $data, $where);
        if($res)
            return $res;
    }

    /**
     * @param $customer_id
     * @return array
     */
    public function getOrdersHistory($customer_id){
        $sql= "
            SELECT o.element_id, o.quantity, o.pay_type, o.date,
            c_c.name, c_c.image
            FROM `orders` o
            LEFT JOIN component_catalog c_c
            ON o.element_id = c_c.id
            WHERE o.customer_id = $customer_id
        ";
        $res = Lib_DateBase::query($sql);
        if($res) {
            while ($row = $res->fetch_assoc()) {
                $row2[] = $row;
            }
        }
        if(isset($row2))return $row2;
        return;
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function deleteCustomerDetails($customer_id){
        $sql = "DELETE FROM customer_details WHERE customer_id = $customer_id";
        $res = Lib_DateBase::query($sql);
        return $res;
    }
}

?>