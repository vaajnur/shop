<?

namespace Models\Admin;

use Core\Model;
use Lib\Lib_DateBase;

class Model_Login extends Model{

    /**
     * @param $data
     * @return bool|mixed
     */
    public function login($data){
      $name = Lib_Datebase::real_escape_string($data['name']);
      $password = Lib_Datebase::real_escape_string($data['password']);
      // die($name);
      // $password = $data['password'];
        $sql = "
          SELECT * FROM admins
          WHERE name = '$name'
          AND password = '$password'
        ";
        $res = Lib_Datebase::query($sql);
        if($res->num_rows) {
            $row = $res->fetch_assoc();
            // die(var_dump($row));
            return $row;
        }
        return false;
    }

}