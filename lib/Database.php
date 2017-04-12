<?php
namespace Cadastro\Conexao;

/**
 * Classe para a conexão com banco de dados
 */
class Database
{
    /*Método construtor privado para pegar os dados através*/
    private function __construct()
    {}

    /*Evita que a classe seja clonada*/
    private function __clone()
    {}
    public static $conn;

    // Singleton para sempre pegar uma conexão já existente
    public static function getConnection()
    {
        try
        {
            if (!isset(static::$conn)) {
                static::$conn = new \PDO(Config::getConfig('dbtype') . ":host=" . Config::getConfig('host') . ";port=" . Config::getConfig('port') . ";dbname=" . Config::getConfig('db').";charset=utf8", Config::getConfig('user'), Config::getConfig('password'));
            }
        } catch (PDOException $i) {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return (static::$conn);
    }
}
