<?php
/*
 * Modelo para produto
 */

namespace Cadastro\Produto;

class Produto extends Modelo
{
    protected $idproduto;
    protected $categoria;
    protected $preco;
    protected $quantidade;
    protected $produto;
    protected $ativo;
    protected $dtcriacao;
    protected $dtalteracao;

    public function getIdproduto()
    {
        return $this->idproduto;
    }

    public function getCategoria($id = 0)
    {
        if (is_null($this->categoria)) {
            $cat = new \Cadastro\Conexao\CategoriaDAO();
            $this->categoria = $cat->getCategoriaById($id);
        }
        return $this->categoria;
    }
    public function getProduto()
    {
        return $this->produto;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getDtcriacao()
    {
        return $this->dtcriacao;
    }

    public function getDtalteracao()
    {
        return $this->dtalteracao;
    }

    public function setIdproduto($valor)
    {
        \Cadastro\Conexao\Validation::validateInt($valor, 'idproduto');
        $this->idproduto = $valor;
    }

    public function setCategoria($id)
    {
        \Cadastro\Conexao\Validation::validateInt($id, 'categoria');
        $this->categoria = $this->getCategoria($id);
    }

    public function setProduto($valor)
    {
        \Cadastro\Conexao\Validation::validateString($valor, 'produto');
        //trunca a descrição do produto em 45
        $this->produto = utf8_encode(substr($valor, 0, 45));
    }

    public function setAtivo($valor)
    {
        \Cadastro\Conexao\Validation::validateValue($valor, array(0, 1), 'ativo');
        $this->ativo = $valor;
    }

    public function setQuantidade($valor)
    {
        \Cadastro\Conexao\Validation::validateInt($valor, 'quantidade');
        $this->quantidade = $valor;
    }

    public function setPreco($valor)
    {
        \Cadastro\Conexao\Validation::validateFloat($valor, 'preco');
        $this->preco = $valor;
    }
    
    public function setDtcriacao($valor)
    {
        $this->dtcriacao = $valor;
    }

    public function setDtalteracao($valor)
    {
        
        $this->dtalteracao = $valor;
    }
    
    //valores por array para geração de retorno json
    public function toArray()
    {
        $array = get_object_vars($this);
        unset($array['categoria']);
        $array['idcategoria'] =  $this->categoria[0]->getIdCategoria();
        $array['preco'] = str_replace(".", ",", $array['preco']);
        return $array;
    }

}
