<?php

class TypeFood extends Connection
{
  private $table = "typeFood";
  private $query = "select * from typeFood";

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
      throw new Exception("Tipo de alimento não existe", 404);
    }

    return $exists;
  }

  public function create($typeFood)
  {
    $sql = "insert into " . $this->table . " (name) values ('" . $typeFood . "') ";
    return $this->connection->query($sql);
  }

  public function update($id, $typeFood)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Tipo de alimento não existe", 404);
    }

    $sql = "update " . $this->table . " set name='" . $typeFood . "' where id = $id";
    return $this->connection->query($sql);
  }

  public function delete($id)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Tipo de alimento não existe", 404);
    }

    $sql = "delete from " . $this->table . " where id = $id";
    return $this->connection->query($sql);
  }
}
