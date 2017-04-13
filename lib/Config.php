<?php
namespace Cadastro\Conexao;


class Config {


    private static $configs;
    
    private function __construct() 
    {}
    
    private function __clone() 
    {}
    
    
    
    public static function getConfig($name){
        if(!isset(self::$configs)){
            self::$configs = include dirname(__DIR__).DIRECTORY_SEPARATOR.'config.php';
        }    
        return  self::$configs[$name];
    }
    
    
}
