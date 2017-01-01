<?

namespace Lib;

class Lib_Registry {
    static private $data = array();
    static public function set($key, $value) {
        self::$data[$key] = $value;
    }
    static public function get($key) {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }
    static public function remove($key) {
        if ( isset(self::$data[$key]) ) {
            unset(self::$data[$key]);
        }
    }
}