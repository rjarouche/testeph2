<?php
namespace Cadastro\Conexao;


class Config {



    
    private function __construct() 
    {}
    
    private function __clone() 
    {}
    
    public static function getConfig($name){
        include $_SERVER['DOCUMENT_ROOT'].'/cadastro_produtos/config.php';
        return  $configs[$name];
    }
    
    
}
