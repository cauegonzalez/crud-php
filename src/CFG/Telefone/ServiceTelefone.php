<?php

namespace CFG\Telefone;

use CFG\Interfaces\IConnection;
use CFG\Interfaces\IServiceTelefone;
use CFG\Interfaces\ITelefone;

class ServiceTelefone implements IServiceTelefone
{
    private $db;
    private $telefone;

    public function __construct(IConnection $connection, ITelefone $telefone)
    {
        $this->db = $connection->connect();
        $this->telefone = $telefone;
    }

    public function list()
    {
        $sql = "SELECT idusuario,
                       telefone
                  FROM telefone";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($idusuario)
    {
        $sql = "SELECT idusuario,
                       telefone
                  FROM telefone
                 WHERE idusuario = :idusuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idusuario', $idusuario);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function save()
    {
        $sql = "INSERT
                  INTO telefone
                       (idusuario,
                        telefone)
                VALUES (:idusuario,
                        :telefone)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idusuario', $this->telefone->getIdusuario());
        $stmt->bindValue(':telefone', $this->telefone->getTelefone());

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function update()
    {
        $sql = "UPDATE telefone
                   SET idusuario = :idusuario,
                       telefone = :telefone
                 WHERE idusuario = :idusuario
                   AND telefone = :telefone";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idusuario', $this->telefone->getIdusuario());
        $stmt->bindValue(':telefone', $this->telefone->getTelefone());

        $return = $stmt->execute();

        return $return;
    }

    public function delete(int $idusuario)
    {
        $sql = "DELETE
                  FROM telefone
                 WHERE idusuario = :idusuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idusuario', $idusuario);
        $return = $stmt->execute();

        return $return;
    }
}