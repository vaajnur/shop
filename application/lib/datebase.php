<?php

namespace Lib;

class Lib_DateBase {

    /**
     * @param $query
     * @return mixed
     */
	function query($query)
	{
		$mysqli = Lib_Registry::get('mysqli');
		if(($num_args = func_num_args()) > 1){
			$arg  = func_get_args();
			unset($arg[0]);
			foreach($arg as $argument=>$value){
				$arg[$argument]= $mysqli->real_escape_string($value);
			}
			$query = vsprintf($query,$arg);	
		}
        $res = $mysqli->query($query);
        if(preg_match('`(INSERT|UPDATE|DELETE|REPLACE)`i',$query,$null)){
			if($sql = $mysqli->affected_rows){
				return $sql;
			}		
		}else{
			if(!$res)return;
			if($res){
				return $res;
			}
		}
		return $res;
	}

    /**
     * @param $query
     * @param $array
     * @param string $where
     * @param string $_devide
     * @return bool|mixed
     */
	function build_query($query,$array,$where = '', $_devide = ',')
	{
		if(is_array($array)){
			$part_query = '';
			$mysqli = Lib_Registry::get('mysqli');
			foreach($array as $index=>$value){
				$part_query .= sprintf(" %s = '%s'".$_devide,$index,$mysqli->real_escape_string($value));
			}
			$part_query = trim($part_query,$_devide);
			$query.=$part_query." ".$where;
			return $this->query($query) ;
		}
		return false;
	}

    /**
     * @param $object
     * @return mixed
     */
	function fetch_object($object)
	{
		return $object->fetch_object();
	}

    /**
     * @param $object
     * @return mixed
     */
	function num_rows($object)
	{
		return $object->num_rows;
	}

    /**
     * @param $object
     * @return mixed
     */
	function affected_rows($object)
	{
		return $object->affected_rows;
	}

    /**
     * @return mixed
     */
	function insert_id()
	{
		return Lib_Registry::get('mysqli')->insert_id;
	}

	function real_escape_string($str){
		return Lib_Registry::get('mysqli')->real_escape_string($str);
	}

}