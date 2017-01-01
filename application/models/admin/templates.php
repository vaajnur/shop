<?php

namespace Models\Admin;

use Core\Model;
use Lib\Lib_DateBase;
use Lib\Lib_Registry;

class Model_Templates extends Model{
    public function getAll(){
        $sql = '
            SELECT * FROM template
        ';
        $mysqli = Lib_Registry::get('mysqli');
        $query = Lib_DateBase::query($sql) or die($mysqli->error);
        while($res = $query->fetch_assoc()){
            $row2[] = $res;
        }
        if(!$row2)return;
        return $row2;
    }
}