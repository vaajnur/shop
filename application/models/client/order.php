<?

namespace Models\Client;

use Core\Model;
use Lib\Lib_DateBase;

class Model_Order extends Model{
    /**
     * @param $data
     * @return bool|mixed
     */
    public function addOrder($data, $customer_id, $pay_type){
        $sql = "
            INSERT INTO `orders` SET
        ";
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d H:i:s');
        foreach ($data as $element_id => $size) {
            if (is_array($size['size'])) {
                foreach ($size['size'] as $sizeID => $amountIDS) {
                    $fields["element_id"] = $element_id;
                    $fields["size_id"] = $sizeID;
                    $fields["quantity"] = implode(',' , $amountIDS);
                    $fields["customer_id"] = $customer_id;
                    $fields["pay_type"] = $pay_type;
                    $fields["date"] = $date;
                    $res = Lib_DateBase::build_query($sql, $fields);
                }
            }
        }
        return $res;
    }
}