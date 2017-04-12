<?php
//Autoload do composer
require '../../vendor/autoload.php';
/* 
  Index do cadastro de produtos
 */
  $cat = new Cadastro\Conexao\CategoriaDAO();
  $categorias = $cat->getAllActiveCategorias();  
  $token = md5('secret'. rand());
  session_start();
  $_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Produtos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <script src="../../js/jquery.js" type="text/javascript"></script>
  <script src="../../js/bootstrap.js" type="text/javascript"></script>
  <!--Máscara para campos-->
  <script src="../../js/jquery.mask.js" type="text/javascript"></script>
  <script src="../../js/jquery.blockUI.js" type="text/javascript"></script>
  <!-- CSS com personalizações da tabela-->
  <link href="../../css/table.css" rel="stylesheet" type="text/css"/>
  <!--Ações de js da página-->
  <script src="js/ajaxFunctions.js" type="text/javascript"></script>
  <script src="js/actions.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
  <h2>Cadastro de produtos</h2>
  <p>Teste para a empresa PH2</p>         
</div>
<div class="container">

    <form action="POST" name="frmPesq" id="frmPesq" onsubmit="return false;">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                  <label for="ptxtCodigo">C&oacute;digo:</label>
                  <input type="text" class="form-control" id="ptxtCodigo" name="ptxtCodigo">
                </div>
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                  <label for="ptxtDescricao">Descri&ccedil;&atilde;o:</label>
                  <input type="text" class="form-control" id="ptxtDescricao" name="ptxtDescricao">
                </div>
            </div> 
            <div class="col-md-5">
                <div class="form-group">
                  <label for="pselectCategoria">Categoria:</label>
                   <?php echo   //pega o select das categorias do decorator
  Cadastro\Decorator\CategoriaDecorator::getSelectCategorias($categorias,'pselectCategoria'); ?>
                </div>
            </div> 
        </div> 
        <div class="row">
           <div class="col-md-offset-8 col-md-2"><button type="button" class="btn btn-secondary btn-block" id="btnPesq"><span class="glyphicon glyphicon-search"></span>&nbsp;Pesquisar</button></div> 
           <div class="col-md-2"><button type="button" class="btn btn-primary btn-block clsCasdastro" id="btnNovo" act="new"><span class="glyphicon glyphicon-plus"></span>&nbsp;Novo</button></div> 
        </div> 
        <input type="hidden" name="ptoken" value="<?php echo $token?>">
    </form>    
</div>

<br/>
<!-- div onde será carregada a tabela de pesquisa -->    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="divProducts"></div>
        </div>
    </div>
</div>



  <!-- Modal para o CRUD -->
  <div class="modal fade" id="modalCadastro" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modalCadastro-header"></h4>
          <p style="color:red;font-style:italic;">*Todos os campos obrigat&oacute;rios</p>  
        </div>
        <div class="modal-body">  <!-- Corpo do Crud -->
            <div class="container">
                <form action="POST" name="frmCadastra" id="frmCadastra" onsubmit="return false;">
                     <input type="hidden" name="token" value="<?php echo $token?>">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                              <label for="txtCodigo">C&oacute;digo:</label>
                              <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" readonly="readOnly">
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="txtDescricao">Descri&ccedil;&atilde;o:</label>
                              <input type="text" class="form-control" id="txtDescricao" name="txtDescricao">
                            </div>
                        </div> 
                    </div>    
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                              <label for="selectCategoria">Categoria:</label>
                              <?php   //pega o select das categorias do decorator
  echo Cadastro\Decorator\CategoriaDecorator::getSelectCategorias($categorias,'selectCategoria'); ?>    
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                              <label for="txtPreco">Pre&ccedil;o:</label>
                              <input type="text" class="form-control" id="txtPreco" name="txtPreco">
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                              <label for="txtQtd">Quantidade:</label>
                              <input type="text" class="form-control" id="txtQtd" name="txtQtd">
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-9">
                        <div class="alert alert-danger" role="alert" >
                            <strong>Erro!</strong><span id="spErroMsg"></span>
                        </div>
                        <div class="alert alert-success"  role="alert" >
                           <strong>OK!</strong>&nbsp;O registro foi salvo!!!
                        </div>
                </form>    
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btnSave"><span class="glyphicon glyphicon-save"></span>&nbsp;Salvar</button>
          &nbsp;
          &nbsp;
          <button class='desativa btn btn-danger' href='ajax/database_ajax.php?action=desativacao' title='Desativar'><span class='glyphicon glyphicon-remove'></span>&nbsp;Desativar</button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

