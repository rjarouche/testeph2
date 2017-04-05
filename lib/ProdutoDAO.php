<?php
/*
 * Classe de acesso de dados para produto
 */

namespace Cadastro\Conexao;


class ProdutoDAO extends DatabaseDAO
{
    public function getProdutoById($id)
    {
        Validation::validateInt($id, 'idProduto');
        $sql = "SELECT idproduto,
                       produto,
                       idcategoria,
                       quantidade,
                       preco,
                       dtcriacao,
                       dtalteracao,
                       ativo
                FROM
                    produto 
                WHERE
                idproduto= :idproduto";

        $params['idproduto'] = $id;
        $rs = $this->selectDB($sql, $params);

        return $this->populate($rs);
    }
    
    public function insertProduto($produto)
    {
        $sql = "INSERT INTO produto
                    (
                    produto,
                    idcategoria,
                    quantidade,
                    preco,
                    dtcriacao,
                    dtalteracao,
                    ativo)
                    VALUES
                    (
                    :produto,
                    :idcategoria,
                    :quantidade,
                    :preco ,
                    NOW(),
                    NOW(),
                    1);";
        
          
        $param["produto"] = $produto->getProduto();
        $param["idcategoria"] = $produto->getCategoria()[0]->getIdCategoria();
        $param["quantidade"] = $produto->getQuantidade();
        $param["preco"] = $produto->getPreco();
   
        return $this->insertDB($sql, $param);
    }
    
    
    public function updateProduto($produto)
    {
        $sql = "UPDATE produto
                SET
                produto = :produto,
                idcategoria = :idcategoria,
                quantidade = :quantidade,
                preco = :preco,               
                dtalteracao = NOW()
                WHERE  
                idproduto = :idproduto;";
        
          
        $param["idproduto"] = $produto->getIdproduto();
        $param["produto"] = $produto->getProduto();
        $param["idcategoria"] = $produto->getCategoria()[0]->getIdCategoria();
        $param["quantidade"] = $produto->getQuantidade();
        $param["preco"] = $produto->getPreco();
   
        return $this->updateDB($sql, $param);
    }
    
    
    public function disableProdutoById($id)
    {
        
        Validation::validateInt($id, 'idProduto');
        
        $sql = "UPDATE produto
                SET
                ativo = 0 ,         
                dtalteracao = NOW()
                WHERE  idproduto = :idproduto;";
        
          
         $param["idproduto"] = $id;
   
        return $this->updateDB($sql, $param);
    }
   
    public function getFilteredProdutos($idproduto,$produto,$idcategoria)
    {
        $sql = "SELECT idproduto,
                       produto,
                       idcategoria,
                       quantidade,
                       preco,
                       dtcriacao,
                       dtalteracao,
                       ativo
                FROM
                       produto
                WHERE   
                       ativo = :ativo";
        
       if(trim($idproduto) != ""){
             Validation::validateInt($idproduto, 'idproduto'); 
             $sql.=  " AND idproduto = :idproduto";
             $params['idproduto'] = $idproduto;
       }
       if(trim($produto) != ""){
            Validation::validateString($produto, 'produto');
            $sql.=  " AND produto like :produto";
            $params['produto'] = utf8_encode('%'.$produto.'%');
       }
       if(trim($idcategoria) != ""){
            Validation::validateInt($idcategoria, 'idcategoria');
            $sql.= " AND idcategoria =  :idcategoria"; 
            $params['idcategoria'] = $idcategoria;
       }
       $params['ativo'] = 1;
       $rs = $this->selectDB($sql, $params);
       
 
       
       return $this->populate($rs);
    }

    protected function populate($rs)
    {
        $i = 0;
        $produto = array();
        while ($row = $rs->fetch(\PDO::FETCH_ASSOC)) {
            $produto[$i] = new \Cadastro\Produto\Produto();
            $produto[$i]->setIdproduto($row["idproduto"]);
            $produto[$i]->setProduto($row["produto"]);
            $produto[$i]->setCategoria($row["idcategoria"]);
            $produto[$i]->setQuantidade($row["quantidade"]);
            $produto[$i]->setPreco($row["preco"]);
            $produto[$i]->setDtcriacao($row["dtcriacao"]);
            $produto[$i]->setDtalteracao($row["dtalteracao"]);
            $produto[$i]->setAtivo($row["ativo"]);
            $i++;
        }

        return $produto;
    }

}
