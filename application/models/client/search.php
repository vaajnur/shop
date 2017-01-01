<?php 

namespace Models\Client;

use Core\Model;
use Lib\Lib_Registry;
use Lib\Lib_DateBase;

/**
* 
*/
class Model_Search extends Model{

    /**
     * @param $arg
     * @return array
     */
	public function search($arg)
	{
		if(empty($arg))return;
		$sql = "
			SELECT a.description
			FROM catalog a
			WHERE a.description  
			LIKE '%".$arg."%'"
		;
		// var_dump($sql);
		$result = Lib_DateBase::query($sql);
		// var_dump($result);
		if (!$result) return;
		while($row = $result->fetch_assoc()){
			$row2[] = $row;
		}
		if(empty($row2))return;
		return $row2;
	}

}

 ?>