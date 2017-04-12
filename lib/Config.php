<?php
namespace Cadastro\Conexao;


class Config {



    
    private function __construct() 
    {}
    
    private function __clone() 
    {}
    
    public static function getConfig($name){
        
        include dirname(__DIR__).DIRECTORY_SEPARATOR.'config.php';
        return  $configs[$name];
    }
    
    
}
