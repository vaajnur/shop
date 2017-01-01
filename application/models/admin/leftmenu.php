<?php

namespace Models\Admin;

use Core\Model;
use Lib\Lib_Registry;
use Lib\Lib_DateBase;

class Model_Leftmenu extends Model{
    public function get(){
        // ORDER BY для topmenu на клиенте
        $sql = "
            SELECT * FROM section ORDER BY component_id
        ";
        $query = Lib_DateBase::query($sql);
        while($row = $query->fetch_assoc()){
            $row2[] = $row;
        }
        if(!$row2)return;
        return $row2;
    }
}