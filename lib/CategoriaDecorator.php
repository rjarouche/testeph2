<?php
/*
 *Decorador para categorias
 */

namespace Cadastro\Decorator;

class CategoriaDecorator
{
    /*Método construtor privado para pegar os dados através*/
    private function __construct()
    {}
    /*Evita que a classe seja clonada*/
    private function __clone()
    {}
    //Metodo para retornar um select de categorias, parametro é um array de objetos categoria
    public static function getSelectCategorias($categorias, $name)
    {
        $html = "<select class='form-control' id='" . $name . "' name='" . $name . "'>
                      <option value=''></option>";

        foreach ($categorias as $categoria) {
            $html .= "<option value='" . $categoria->getIdcategoria() . "'>" . $categoria->getCategoria() . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

}
