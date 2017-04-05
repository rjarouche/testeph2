<?php
/*
 * Classe de acesso de dados para categoria
 */

namespace Cadastro\Conexao;

class CategoriaDAO extends DatabaseDAO
{

    public function getCategoriaById($id)
    {
        Validation::validateInt($id, 'idcategoria');
        $sql = "SELECT idcategoria,
                       categoria,
                       ativo
                FROM  categoria
                WHERE
                idcategoria= :idcategoria";

        $params['idcategoria'] = $id;
        $rs = $this->selectDB($sql, $params);

        return $this->populate($rs);
    }

    public function getAllActiveCategorias()
    {
        $sql = "SELECT idcategoria,
                       categoria,
                       ativo
                FROM  categoria
                WHERE
                ativo= :ativo";

        $params['ativo'] = 1;
        $rs = $this->selectDB($sql, $params);

        return $this->populate($rs);
    }

    protected function populate($rs)
    {
        $i = 0;
        while ($row = $rs->fetch(\PDO::FETCH_ASSOC)) {
            $categoria[$i] = new \Cadastro\Produto\Categoria();
            $categoria[$i]->setIdcategoria($row["idcategoria"]);
            $categoria[$i]->setCategoria($row["categoria"]);
            $categoria[$i]->setAtivo($row["ativo"]);
            $i++;
        }

        return $categoria;
    }

}
