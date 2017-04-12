/* 
  Arquivo que contém as funções ajax do módulo
 */
function pesquisaProduto(){
    $.post('ajax/table_produtos.php',$('#frmPesq').serialize(),function(json){

           if(json.erro != 0){
               $('#divProducts').html(json.erro);
           }else{
               $('#divProducts').html(json.html);
               $('.clsCasdastro').click(function(){
                    openModal($(this).attr('act'),$(this).attr('href'));
               });
               
           }

    },'json');
}


function formProduto(url){
    $.post(url,$('#frmCadastra').serialize(),function(json){
           if(json.erro != 0){
               alert(json.erro);
           }else{
               $('#txtCodigo').val(json.idproduto);
               $('#txtDescricao').val(json.produto);
               $('#selectCategoria').val(json.idcategoria);
               $('#txtPreco').val(json.preco);
               $('#txtQtd').val(json.quantidade);
           }

    },'json');
}


function atuaLizaProduto(){
    $.post('ajax/database_ajax.php?action=atualiza',$('#frmCadastra').serialize(),function(json){
        if(json.erro != 0){           
               $('#spErroMsg').html('&nbsp;Erro de gravação!');
               $('.alert-danger').removeClass('hide');
               $('.alert-success').addClass('hide');
               return false;
           }else{
               $('.alert-success').removeClass('hide');
               $('.alert-danger').addClass('hide');
               formProduto('ajax/database_ajax.php?action=alteracao&id='+json.id)
               return true; 
           }
    },'json');
}


function desativaProduto(url){
    
    if(confirm('Deseja desativar?')){
        $.post(url,$('#frmCadastra').serialize(),function(json){
               if(json.erro != 0){
                   alert(json.erro);
               }else{
                   alert('Produto desativado!');
                   pesquisaProduto(); 
                   $('#modalCadastro').modal('hide');
               }

        },'json');
    }
}