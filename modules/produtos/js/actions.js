$(function(){
   //Máscaras nos campos
   $('#ptxtCodigo').mask('#######');
   $('#txtCodigo').mask('#######');
   $('#txtQtd').mask('#######');
   $('#txtPreco').mask('#.##0,00',{reverse: true});

   
   //Evento ao chamar modal
   $('#modalCadastro').on('show.bs.modal', function(e) {
        // ocultar alerts
        $('.alert-danger').addClass('hide');
        $('.alert-success').addClass('hide');
   });
   
   //chama o Modal de cadastro ao clicar em um objeto de classe clsCastastro
   $('.clsCasdastro').click(function(){
          openModal($(this).attr('act'),$(this).attr('href'));
   });
     
    $('.desativa').click(function(){
       desativaProduto($(this).attr('href'));
    });  
     
     
   //Botão salvar do modal 
   $('#btnSave').click(function(){
       validation = true;
       msg = '';
       
       if($('#txtDescricao').val() == ""){
           validation = false;
           msg += ' Descri&ccedil;&atilde;o';
       }
       
       if($('#selectCategoria').val() == ""){
           validation = false;
           msg += ' Categoria';
       }
       
       
       if($('#txtQtd').val() == ""){
           validation = false;
           msg += ' Quantidade';
       }
       
       if($('#txtPreco').val() == ""){
           validation = false;
           msg += ' Pre&ccedil;o';
       }
       
       if(!validation){
           $('#spErroMsg').html('&nbsp;Os campo(s): ' + msg +' deve(m) ser preenchidos!!!');
           $('.alert-danger').removeClass('hide');
           $('.alert-success').addClass('hide');
       }else{
           atuaLizaProduto();
       }
        
   });
   
   $('#btnPesq').click(function(){
      pesquisaProduto();     
   });
   
});

$(document).ajaxStart(
  $.blockUI({ message: 'Aguarde!!!!',
          css: { backgroundColor: '#f00', color: '#fff'}
} 
)).ajaxComplete( $.unblockUI);





function openModal(act,url){
       $('#modalCadastro').modal({
            keyboard: false,
            backdrop: 'static'
          });
          $('#frmCadastra')[0].reset();
          if(act == 'new' ){
              $('#modalCadastro-header').html('Cadastro de produto');
              $('.desativa').hide();
          }else{
              $('#modalCadastro-header').html('Editar produto');
              $('.desativa').show();
              formProduto(url);
          } 
    
}


