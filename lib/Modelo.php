<?php
/*
 * Classse abstrata para todas as modelos herdarem
 */

namespace Cadastro\Produto;

abstract class Modelo
{
    public function toArray()
    {
        return get_object_vars($this);
    }
}
