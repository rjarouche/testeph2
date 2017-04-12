<?php
/*Modelo da Categoria*/

namespace Cadastro\Produto;

class Categoria extends Modelo
{
    protected $idcategoria;
    protected $categoria;
    protected $ativo;

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setIdcategoria($valor)
    {
        \Cadastro\Conexao\Validation::validateInt($valor, 'idcategoria');
        $this->idcategoria = $valor;
    }

    public function setCategoria($valor)
    {
        \Cadastro\Conexao\Validation::validateString($valor);
        $this->categoria = utf8_encode($valor);
    }

    public function setAtivo($valor)
    {
        \Cadastro\Conexao\Validation::validateValue($valor, array(0, 1), 'ativo');
        $this->ativo = $valor;
    }

}
