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

    private static $dbtype = "mysql";
    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $db = "produtos";
    public static $conn;

    // Singleton para sempre pegar uma conexão já existente
    public static function getConnection()
    {
        try
        {
            if (!isset(static::$conn)) {
                static::$conn = new \PDO(static::$dbtype . ":host=" . static::$host . ";port=" . static::$port . ";dbname=" . static::$db.";charset=utf8", static::$user, static::$password);
            }
        } catch (PDOException $i) {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return (static::$conn);
    }
}
