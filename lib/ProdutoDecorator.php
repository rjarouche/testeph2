<?php
/*
 *  Decorator do produto
 */

namespace Cadastro\Decorator;

/**
 * Description of ProdutoDecorator
 *
 * @author Rodrigo
 */
class ProdutoDecorator
{
    public static function getProdutosTable($produtos)
    {
        $table = "<table class='table table-bordered table-hover table-condensed'>
                    <thead>
                      <tr>
                        <th>C&oacute;digo</th>
                        <th>Descri&ccedil;&atilde;o</th>
                        <th>Categoria</th>
                        <th>Pre&ccedil;o</th>
                        <th>Qtd</th>
                        <th>Data cria&ccedil;&atilde;o</th>
                        <th>Data altera&ccedil;&atilde;o</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>";
        foreach ($produtos as $produto) {
            //geração de HASH de segurança, para evitar que outro id seja modificado e se altere outro registro

            

            $table .= "<tr>
                        <td class='tdNumber'>" . $produto->getIdproduto() . "</td>
                        <td>" . utf8_decode($produto->getProduto()) . "</td>
                        <td>" . $produto->getCategoria()[0]->getCategoria() . "</td>
                        <td class='tdNumber'>" . str_replace(".", ",", $produto->getPreco()) . "</td>
                        <td class='tdNumber'>" . $produto->getQuantidade() . "</td>
                        <td class='tdDate'>" . \DateTime::createFromFormat('Y-m-d H:i:s', $produto->getDtcriacao())->format('d/m/Y H:i:s') . "</td>
                        <td class='tdDate'>" . \DateTime::createFromFormat('Y-m-d H:i:s', $produto->getDtalteracao())->format('d/m/Y H:i:s') . "</td>
                        <th class='tdIcon'><button class='clsCasdastro' act='altera' href='ajax/database_ajax.php?action=alteracao&id=" . $produto->getIdproduto() ."' title='Editar'><span class='glyphicon glyphicon-edit'></span></button>
                            &nbsp;
                            &nbsp;
                            <button class='desativa' href='ajax/database_ajax.php?action=desativacao&id=" . $produto->getIdproduto(). "' title='Desativar'><span class='glyphicon glyphicon-remove'></span></button>
                        </th>
                      </tr>";
        }
        $table .= "
                    </tbody>
                  </table>";
        
        return $table;
    }
}
