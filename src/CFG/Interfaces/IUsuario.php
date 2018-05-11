<?php

namespace CFG\Interfaces;

interface IUsuario
{
    public function getId();
    public function setId($id);
    public function getNome();
    public function setNome($nome);
    public function getCep();
    public function setCep($cep);
    public function getRua();
    public function setRua($rua);
    public function getNumero();
    public function setNumero($numero);
    public function getComplemento();
    public function setComplemento($complemento);
    public function getBairro();
    public function setBairro($bairro);
    public function getCidade();
    public function setCidade($cidade);
    public function getUf();
    public function setUf($uf);
}