<?php
namespace Cadastro\Conexao;

/**
 * Classe abstrata para a as operações com banco de dados
 */
abstract class DatabaseDAO
{

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /*Método select que retorna um record set*/
    public function selectDB($sql, $params = null)
    {
        $rs = $this->conn->prepare($sql);
        $rs->execute($params);
        return $rs;
    }

    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public function insertDB($sql, $params = null)
    {
        $conexao = $this->conn;
        $query = $conexao->prepare($sql);
        $query->execute($params);
        $retorno = $conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
        return $retorno;
    }

    /*Método update que altera valores do banco de dados e retorna o número de linhas afetadas*/
    public function updateDB($sql, $params = null)
    {
        $query = $this->conn->prepare($sql);
        $query->execute($params);
        $retorno = $query->rowCount() or die(print_r($query->errorInfo(), true));
        return $retorno;
    }

    /*Método delete que excluí valores do banco de dados retorna o número de linhas afetadas*/
    public function deleteDB($sql, $params = null)
    {
        $query = $this->conn->prepare($sql);
        $query->execute($params);
        $retorno = $query->rowCount() or die(print_r($query->errorInfo(), true));
        return $retorno;
    }

}
