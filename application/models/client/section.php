<?

namespace Models\Client;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;

class Model_Section extends Model{
    /**
     * @param $section_id
     * @return mixed
     */
    public function getById($section_id){
        $sql = "SELECT * FROM section WHERE id = {$section_id}";
        $result = Lib_DateBase::query($sql);
        $row = $result->fetch_assoc();
        if(empty($row))return;
        return $row;
    }

    /**
     * @param $section_id
     * @return array
     */
    public function getSubSections($section_id){
        $sql = "SELECT * FROM section WHERE parent_id = {$section_id}";
        $result = Lib_DateBase::query($sql);
        while($row = $result->fetch_assoc()){
            $row2[] = $row;
        }
        if(empty($row2))return;
        return $row2;
    }
}