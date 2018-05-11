<?php

namespace CFG\Interfaces;

interface IServiceUsuario
{
    public function list();

    public function save();

    public function update();

    public function delete(int $id);
}