<?php 
class Autoloader {
    public static function autoload($class) {
        $class = str_replace('\\', '/', $class);
        $root = __DIR__; 
            
        $file = $root . '/' . $class . '.php';
       
        if (file_exists($file)) {
            
            require $file;
        }
    }
    public static function register() {
        spl_autoload_register(['Autoloader', 'autoload']);
    }
}


?>