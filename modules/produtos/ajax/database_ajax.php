<?php
/* 
 * Ações de lateração e pesquisa ajax
 */
//autload do composer
require '../../../vendor/autoload.php';

if($_GET['action'] == 'alteracao'){
    $id = $_GET['id'];    
    $produtoDao = new \Cadastro\Conexao\ProdutoDAO();
    $retorno = $produtoDao->getProdutoById($id)[0]->toArray();
    $retorno['erro'] = 0;
    echo json_encode($retorno);
    
}


if($_GET['action'] == 'atualiza'){
   
    $produto = new \Cadastro\Produto\Produto();
    //santinizado e verificado na classe
    $produto->setCategoria($_POST['selectCategoria']);
    $produto->setProduto($_POST['txtDescricao']);
    $produto->setQuantidade($_POST['txtQtd']);
    $produto->setPreco(str_replace(",", ".", $_POST['txtPreco']));
    $dao = new \Cadastro\Conexao\ProdutoDAO();
    if(trim($_POST['txtCodigo']) == ""){
        $dao->insertProduto($produto);
    }else{
        $produto->setIdproduto($_POST['txtCodigo']);
        $dao->updateProduto($produto);
    }
    $retorno['erro'] = 0;
    echo json_encode($retorno);
}

if($_GET['action'] == 'desativacao'){
    
    $id = $_GET['id'];    
    $produtoDao = new \Cadastro\Conexao\ProdutoDAO();
    $produtoDao->disableProdutoById($id);
    $retorno['erro'] = 0;
    echo json_encode($retorno);
}