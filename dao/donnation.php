<?php
class Donnation extends Connection
{
  private $table = 'donnation';
  private $query = "select d.*, u.name as user, td.name as type, tf.name as food from donnation as d join user as u on d.userId = u.id join typeDonnation as td on d.typeDonnationId = td.id left join typeFood as tf on d.typeFoodId = tf.id";

  public function findAll($userId = null, $typeDonnationId = null, $typeFoodId = null)
  {
    $list = array();

    if ($typeDonnationId || $typeFoodId || $userId) $this->query .= " where";

    if ($typeDonnationId) $this->query .= " td.id = $typeDonnationId and";
    if ($typeFoodId) $this->query .= " tf.id = $typeFoodId and";
    if ($userId) $this->query .= " u.id = $userId and";

    if ($typeDonnationId || $typeFoodId || $userId) $this->query = substr($this->query, 0, -3);

    $result = $this->connection->query($this->query);

    while ($record = $result->fetch_object()) {
      array_push($list, $record);
    }

    $result->close();
    return $list;
  }

  public function findById($id)
  {
    $exists = $this->connection->query($this->query . " where d.id = $id")->fetch_assoc();

    if (is_null($exists)) {
      throw new Exception("Doação não encontrada", 404);
    }

    return $exists;
  }

  public function create($data)
  {
    $user = new User();
    $typeDonnation = new TypeDonnation();
    $typeFood = new TypeFood();

    if (isset($data->typeFoodId)) {
      $typeFoodExists = $typeFood->findById($data->typeFoodId);

      if (is_null($typeFoodExists)) {
        throw new Exception("Tipo de doação de alimento não existe", 404);
      }
    }

    if (isset($data->userId)) {
      $userExists = $user->findById($data->userId);

      if (is_null($userExists)) {
        throw new Exception("Usuário não existe", 404);
      }
    }

    if (isset($data->typeDonnationId)) {
      $typeDonnationExists = $typeDonnation->findById($data->typeDonnationId);

      if (is_null($typeDonnationExists)) {
        throw new Exception("Tipo de doação não existe", 404);
      }
    }

    $typeFoodId = isset($data->typeFoodId) ? $data->typeFoodId : 'default';

    if ($data->value < 1) {
      throw new Exception("Valor da doação não pode ser menor que 1", 404);
    }

    $sql = "insert into " . $this->table . " (userId,typeDonnationId,typeFoodId,value) values (" . $data->userId . "," . $data->typeDonnationId . "," . $typeFoodId . "," . $data->value . ")";

    return $this->connection->query($sql);
  }

  public function update($id, $data)
  {
    $user = new User();
    $typeDonnation = new TypeDonnation();
    $typeFood = new TypeFood();

    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Doação não encontrada", 404);
    }

    $sql = "update " . $this->table . " set";

    if (isset($data->value)) {
      if ($data->value < 1) {
        throw new Exception("Valor da doação não pode ser menor que 1", 404);
      }

      $sql .= " value='" . $data->value . "',";
    }

    if (isset($data->userId)) {
      $userExists = $user->findById($data->userId);

      if (is_null($userExists)) {
        throw new Exception("Usuário não existe", 404);
      }

      $sql .= " userId=" . $data->userId . ",";
    }

    if (isset($data->typeDonnationId)) {
      $typeDonnationExists = $typeDonnation->findById($data->typeDonnationId);

      if (is_null($typeDonnationExists)) {
        throw new Exception("Tipo de doação não existe", 404);
      }

      $sql .= " typeDonnationId=" . $data->typeDonnationId . ",";
    }

    if (isset($data->typeFoodId)) {
      $typeFoodExists = $typeFood->findById($data->typeFoodId);

      if (is_null($typeFoodExists)) {
        throw new Exception("Tipo de doação de alimento não existe", 404);
      }

      $sql .= " typeFoodId=" . $data->typeFoodId . ",";
    }

    $sql = substr($sql, 0, -1);

    return $this->connection->query($sql . " where id = $id");
  }

  public function delete($id)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Doação não encontrada", 404);
    }

    $sql = "delete from " . $this->table . " where id = $id";
    return $this->connection->query($sql);
  }

  public function countAll()
  {
    $sql = "select count(*) total from " . $this->table;

    return $this->connection->query($sql)->fetch_assoc();
  }

  public function countDonnationByMoney()
  {
    $sql = "select sum(value) value from " . $this->table . " where typeDonnationId = 1";

    return $this->connection->query($sql)->fetch_assoc();
  }

  public function countDonnationByFood()
  {
    $sql = "select sum(value) value from " . $this->table . " where typeDonnationId = 2";

    return $this->connection->query($sql)->fetch_assoc();
  }
}
