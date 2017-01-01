<?
function __autoload($class_name)
{
    $path = $class_name;
    $path_array = explode("\\" , $path);
    $file = explode("_" , array_pop($path_array));
    $file1 = $file[1];
    $path = strtolower(implode("/" , $path_array));

    if (file_exists(APP_PATH.DS.$path.DS.$file1 . ".php")) {
        include_once(APP_PATH.DS.$path.DS.$file1 . ".php");
    }else if(file_exists(APP_PATH.DS.$path.DS.lcfirst($file1) . ".php")) {
        include_once(APP_PATH.DS.$path.DS.lcfirst($file1) . ".php");
    }else {
        header("HTTP/1.0 404 Not Found");
        echo "К сожалению такой страницы не существует. " .APP_PATH.DS.$path.DS.$file1 . ".php ";
        exit;
    }
}

?>