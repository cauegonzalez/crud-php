<?php
namespace CFG\Database;

use CFG\Usuario\Usuario;
use CFG\Telefone\Telefone;

class Database
{
    private $conexao;

    public function __construct(IConnection $conexao)
    {
        $this->conexao = $this->conect();
    }

    protected function persist(Cliente $cliente)
    {
        $sqlInsertUsuario = "INSERT
                               INTO usuario
                                    (nome,
                                     cep,
                                     rua,
                                     numero,
                                     complemento,
                                     bairro,
                                     cidade,
                                     uf)
                             VALUES (:nome
                                     :cep
                                     :rua
                                     :numero
                                     :complemento
                                     :bairro
                                     :cidade
                                     :uf)";
        $statement = $this->conexao->prepare($sqlInsertUsuario);

        $statement->bindValue(":id", $usuario->id);
        $statement->bindValue(":nome", $usuario->nome);
        $statement->bindValue(":cep", $usuario->cep);
        $statement->bindValue(":rua", $usuario->rua);
        $statement->bindValue(":numero", $usuario->numero);
        $statement->bindValue(":complemento", $usuario->complemento);
        $statement->bindValue(":bairro", $usuario->bairro);
        $statement->bindValue(":cidade", $usuario->cidade);
        $statement->bindValue(":uf", $usuario->uf);

        $statement->execute();
    }

    public function flush(Usuario $usuario)
    {
        //TODO
    }
}