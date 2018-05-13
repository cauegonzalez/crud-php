<?php

namespace CFG\Interfaces;

interface IServiceTelefone
{
    public function list();

    public function save();

    public function update();

    public function delete(int $idusuario);
}