<?php
/* Ajax para exibir a pesquisa de produtos*/

//autload do composer
require '../../../vendor/autoload.php';
$produtos = new Cadastro\Conexao\ProdutoDAO();

//Variável controla o erro
$retorno['erro'] = 0;

// As variáveis são santinizadas dentro das classes 
$idproduto = $_POST["ptxtCodigo"];
$produto=$_POST["ptxtDescricao"];
$idcategoria=$_POST["pselectCategoria"];

session_start();

if($_SESSION['token'] === $_POST['ptoken'] ){


    try {
        $retorno['html'] = utf8_encode(Cadastro\Decorator\ProdutoDecorator::getProdutosTable($produtos->getFilteredProdutos($idproduto,$produto,$idcategoria)));
    } catch (Exception $ex) {
        $retorno['erro'] = utf8_encode(print_r($ex,true));
    }


    echo json_encode($retorno);

}


