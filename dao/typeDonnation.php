<?php

class TypeDonnation extends Connection
{
  private $table = "typeDonnation";
  private $query = "select * from typeDonnation";

  public function findAll()
  {
    $result = $this->connection->query($this->query);
    $list = array();

    while ($record = $result->fetch_object()) {
      array_push($list, $record);
    }

    $result->close();
    return $list;
  }

  public function findById($id)
  {
    $exists = $this->connection->query($this->query . " where id = $id")->fetch_assoc();

    if (is_null($exists)) {
      throw new Exception("Tipo de doação não existe", 404);
    }

    return $exists;
  }

  public function create($typeDonnation)
  {
    $sql = "insert into " . $this->table . " (name) values ('" . $typeDonnation . "') ";
    return $this->connection->query($sql);
  }

  public function update($id, $typeDonnation)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Tipo de doação não existe", 404);
    }

    $sql = "update " . $this->table . " set name='" . $typeDonnation . "' where id = $id";
    return $this->connection->query($sql);
  }

  public function delete($id)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Tipo de doação não existe", 404);
    }

    $sql = "delete from " . $this->table . " where id = $id";
    return $this->connection->query($sql);
  }
}
