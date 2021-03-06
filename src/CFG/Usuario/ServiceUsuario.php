<?php

namespace CFG\Usuario;

use CFG\Interfaces\IConnection;
use CFG\Interfaces\IServiceUsuario;
use CFG\Interfaces\IUsuario;

class ServiceUsuario implements IServiceUsuario
{
    private $db;
    private $usuario;

    public function __construct(IConnection $connection, IUsuario $usuario)
    {
        $this->db = $connection->connect();
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->usuario = $usuario;
    }

    public function list()
    {
        $sql = "SELECT id,
                       nome,
                       cep,
                       rua,
                       numero,
                       complemento,
                       bairro,
                       cidade,
                       uf
                  FROM usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $sql = "SELECT id,
                       nome,
                       cep,
                       rua,
                       numero,
                       complemento,
                       bairro,
                       cidade,
                       uf,
                       (SELECT GROUP_CONCAT(t.telefone SEPARATOR '; ')
                          FROM telefone t
                         WHERE t.idusuario = usuario.id) as telefones
                  FROM usuario
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function save()
    {
        try
        {
            $sql = "INSERT
                      INTO usuario
                           (nome,
                            cep,
                            rua,
                            numero,
                            complemento,
                            bairro,
                            cidade,
                            uf)
                    VALUES (:nome,
                            :cep,
                            :rua,
                            :numero,
                            :complemento,
                            :bairro,
                            :cidade,
                            :uf)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $this->usuario->getNome());
            $stmt->bindValue(':cep', $this->usuario->getCep());
            $stmt->bindValue(':rua', $this->usuario->getRua());
            $stmt->bindValue(':numero', $this->usuario->getNumero());
            $stmt->bindValue(':complemento', $this->usuario->getComplemento());
            $stmt->bindValue(':bairro', $this->usuario->getBairro());
            $stmt->bindValue(':cidade', $this->usuario->getCidade());
            $stmt->bindValue(':uf', $this->usuario->getUf());

            $stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new Exception("Error Processing Request. ".$e->getMessage(), 1);
        }

        return $this->db->lastInsertId();
    }

    public function update()
    {
        $sql = "UPDATE usuario
                   SET nome = :nome,
                       cep = :cep,
                       rua = :rua,
                       numero = :numero,
                       complemento = :complemento,
                       bairro = :bairro,
                       cidade = :cidade,
                       uf = :uf
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->usuario->getId());
        $stmt->bindValue(':nome', $this->usuario->getNome());
        $stmt->bindValue(':cep', $this->usuario->getCep());
        $stmt->bindValue(':rua', $this->usuario->getRua());
        $stmt->bindValue(':numero', $this->usuario->getNumero());
        $stmt->bindValue(':complemento', $this->usuario->getComplemento());
        $stmt->bindValue(':bairro', $this->usuario->getBairro());
        $stmt->bindValue(':cidade', $this->usuario->getCidade());
        $stmt->bindValue(':uf', $this->usuario->getUf());

        $return = $stmt->execute();

        return $return;
    }

    public function delete(int $id)
    {
        $sql = "DELETE
                  FROM usuario
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $return = $stmt->execute();

        $sql = "DELETE
                  FROM telefone
                 WHERE idusuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $return = $stmt->execute();
        // $container['ServiceTelefones']->delete($id);

        return $return;
    }
}