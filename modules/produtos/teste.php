<?php
      require '../../vendor/autoload.php';
      
      
      $cat = new Cadastro\Conexao\ProdutoDAO();
          $produtoDao = new \Cadastro\Conexao\ProdutoDAO();
          $retorno = $produtoDao->getProdutoById(1)[0]->toArray();
          
          print_r($retorno);

