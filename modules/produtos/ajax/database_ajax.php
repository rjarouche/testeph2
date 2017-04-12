<?php
/*
 * Ações de lateração e pesquisa ajax
 */
//autload do composer
require '../../../vendor/autoload.php';
session_start();


if ($_SESSION['token'] === $_POST['token']) {
    if ($_GET['action'] == 'alteracao') {
        $id = $_GET['id'];
        $produtoDao = new \Cadastro\Conexao\ProdutoDAO();
        $retorno = $produtoDao->getProdutoById($id)[0]->toArray();
        $_SESSION['token2'] = md5('secret' . $retorno['idproduto']);

        $retorno['erro'] = 0;
        echo json_encode($retorno);
    }

    if ($_GET['action'] == 'atualiza') {
        
        $produto = new \Cadastro\Produto\Produto();
        //santinizado e verificado na classe
        $produto->setCategoria($_POST['selectCategoria']);
        $produto->setProduto($_POST['txtDescricao']);
        $produto->setQuantidade($_POST['txtQtd']);
        $produto->setPreco(str_replace(",", ".", $_POST['txtPreco']));
        $dao = new \Cadastro\Conexao\ProdutoDAO();
        if (trim($_POST['txtCodigo']) == "") {
            $retorno['id'] = $dao->insertProduto($produto);
        } else {
            if ($_SESSION['token2'] === md5('secret' . $_POST['txtCodigo'])) {
                $produto->setIdproduto($_POST['txtCodigo']);
                $dao->updateProduto($produto);
                $retorno['id'] = $produto->getIdproduto();
            }else{
                die();
            }
        }
        $retorno['erro'] = 0;
        echo json_encode($retorno);
    }

    if ($_GET['action'] == 'desativacao' && $_SESSION['token2'] === md5('secret' . $_POST['txtCodigo'])) {

        $id = $_POST['txtCodigo'];
        $produtoDao = new \Cadastro\Conexao\ProdutoDAO();
        $produtoDao->disableProdutoById($id);
        $retorno['erro'] = 0;
        echo json_encode($retorno);
    }

}
