<?php
class News extends Connection
{
  private $table = 'news';
  private $query = "select n.*, tn.name as type, u.name as name from news n join typeNews tn on n.typeNewsId = tn.id join user u on n.userId = u.id";

  public function findAll($userId = null, $typeNewsId = null)
  {
    $list = array();

    if ($typeNewsId || $userId) $this->query .= " where";

    if ($typeNewsId) $this->query .= " tn.id = $typeNewsId and";
    if ($userId) $this->query .= " u.id = $userId and";

    if ($typeNewsId || $userId) $this->query = substr($this->query, 0, -3);

    $result = $this->connection->query($this->query . " order by n.id asc");

    while ($record = $result->fetch_object()) {
      array_push($list, $record);
    }

    $result->close();
    return $list;
  }

  public function findById($id)
  {
    $exists = $this->connection->query($this->query . " where n.id = $id")->fetch_assoc();

    if (is_null($exists)) {
      throw new Exception("Notícia não encontrada", 404);
    }

    return $exists;
  }

  public function create($data)
  {
    $user = new User();
    $typeNews = new TypeNews();

    if (isset($data->typeNewsId)) {
      $typeNewsExists = $typeNews->findById($data->typeNewsId);

      if (is_null($typeNewsExists)) {
        throw new Exception("Tipo de notícia não existe", 404);
      }
    }

    if (isset($data->userId)) {
      $userExists = $user->findById($data->userId);

      if (is_null($userExists)) {
        throw new Exception("Usuário não existe", 404);
      }
    }

    $sql = "insert into " . $this->table . " (userId,typeNewsId,message) values (" . $data->userId . ", " . $data->typeNewsId . ", '" . $data->message . "')";

    return $this->connection->query($sql);
  }

  public function update($id, $data)
  {
    $user = new User();
    $typeNews = new TypeNews();

    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Notícia não encontrada", 404);
    }

    $sql = "update " . $this->table . " set";

    if (isset($data->message)) $sql .= " message='" . $data->message . "',";
    if (isset($data->userId)) {
      $userExists = $user->findById($data->userId);

      if (is_null($userExists)) {
        throw new Exception("Usuário não existe", 404);
      }

      $sql .= " userId=" . $data->userId . ",";
    }

    if (isset($data->typeNewsId)) {
      $typeNewsExists = $typeNews->findById($data->typeNewsId);

      if (is_null($typeNewsExists)) {
        throw new Exception("Tipo de notícia não existe", 404);
      }

      $sql .= " typeNewsId=" . $data->typeNewsId . ",";
    }

    $sql = substr($sql, 0, -1);

    return $this->connection->query($sql . " where id = $id");
  }

  public function delete($id)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Notícia não encontrada", 404);
    }

    $sql = "delete from " . $this->table . " where id = $id";
    return $this->connection->query($sql);
  }

  public function getLast()
  {
    $list = array();

    $sql = "select u.name as user, tn.id as typeId, tn.name as type, n.message as message from news as n join typeNews as tn on tn.id = n.typeNewsId join user as u on u.id = n.userId where n.id in ( select max(id) from news group by typeNewsId )";

    $result = $this->connection->query($sql);

    while ($record = $result->fetch_object()) {
      array_push($list, $record);
    }

    $result->close();
    return $list;
  }
}
