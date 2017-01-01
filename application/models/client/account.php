<?

namespace Models\Client;

use Core\Model;
use Lib\Lib_DateBase;

class Model_Account extends Model{
    /**
     * @param $customer_id
     * @return array
     */
    public function ordersHistory($customer_id){
        $sql = "
            SELECT o.id, o.element_id, o.pay_type, o.quantity, o.date,
            cat.name, cat.price,
            pic.image
            FROM `orders` o
            LEFT JOIN component_catalog cat
            ON o.element_id = cat.id
            LEFT JOIN pictures pic
            ON o.element_id = pic.element_id AND pic.component_id = 1
            WHERE customer_id = $customer_id
            GROUP BY o.id
        ";
        $res = Lib_DateBase::query($sql);
        if($res){
            while($row = $res->fetch_assoc()){
                $row2[] = $row;
            }
        }
        if(!isset($row2))return;
        return $row2;
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerDetails($customer_id){
        $sql = "
            SELECT  * FROM customer_details WHERE customer_id = $customer_id
        ";
        $res = Lib_DateBase::query($sql);
        if($res)
            $row = $res->fetch_assoc();
        if(!isset($row))return;
        return $row;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function addCustomerDetails($data){
        $sql = "
            INSERT INTO customer_details SET
        ";
        $res = Lib_DateBase::build_query($sql, $data);
        return $res;
    }

    /**
     * @param $data
     * @param $customer_id
     * @return mixed
     */
    public function editCustomerDetails($data, $customer_id){
        $sql = "
            UPDATE customer_details SET
        ";
        $where = "WHERE customer_id = $customer_id";
        $res = Lib_DateBase::build_query($sql, $data, $where);
        return $data;
    }
}