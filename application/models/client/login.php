<?

namespace Models\Client;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;

class Model_Login extends Model{
    /**
     * @param $data
     * @return mixed
     */
    public function getUser($data){
        $name = Lib_Datebase::real_escape_string($data['name']);
        $password = md5(Lib_Datebase::real_escape_string($data['password']));
        $sql = "
            SELECT  * FROM customers WHERE name = '{$name}' AND password = '{$password}'
        ";
        $res = Lib_DateBase::query($sql);
        if(!$res)return;
        $row = $res->fetch_assoc();
        if(empty($row))return;
        return $row;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function registerUser($data){
        $sql = "
            INSERT INTO customers SET
        ";
        $res = Lib_DateBase::build_query($sql, $data);
        if(!$res)return false;
        $id = Lib_DateBase::insert_id();
        return $id;
    }
}