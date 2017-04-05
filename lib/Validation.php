<?php

namespace Cadastro\Conexao;

/*
 *  Classe para validação e santinização
 */
class Validation
{
    private function __construct()
    {}
    private function __clone()
    {}

    public static function validateInt(&$valor, $msg)
    {
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        if (!preg_match('/^[0-9]+$/', $valor)) {
            throw new \Exception("O Valor só pode ser inteiro " . $msg);
        }
    }

    public static function validateValue(&$valor, $array, $msg)
    {
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        if (!in_array($valor, $array)) {
            throw new \Exception("Valor não atende as limitações " . $msg);
        }

    }

    public static function validateFloat(&$valor, $msg)
    {
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if (!preg_match('/^[0-9.]+$/', $valor)) {
            throw new \Exception("O Valor só pode ser float " . $msg);
        }
    }

    public static function validateString(&$valor, $msg)
    {
        $valor = utf8_decode($valor);
        $valor = filter_var($valor, FILTER_SANITIZE_STRING);
        if (trim($valor) == "") {
            throw new \Exception("String não pode ser vazia " . $msg);
        }
    }
    
    public static function validateDate($valor, $msg ,$format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) == $valor) {
            throw new \Exception("Formato de data inválido " . $msg);
        }
    }

}
