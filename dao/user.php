<?php
class User extends Connection
{
  private $table = 'user';
  private $query = "select u.*, r.name as role from user as u join role as r on r.id = u.roleId";

  public function findAll($roleId = null)
  {
    $list = array();

    if ($roleId) $this->query .= " where r.id = $roleId";

    $result = $this->connection->query($this->query);

    while ($record = $result->fetch_object()) {
      array_push($list, $record);
    }

    $result->close();
    return $list;
  }

  public function findById($id)
  {
    $exists = $this->connection->query($this->query . " where u.id = $id")->fetch_assoc();

    if (is_null($exists)) {
      throw new Exception("Usuário não encontrado", 404);
    }

    return $exists;
  }

  public function create($data)
  {
    $role = new Role();

    if (isset($data->roleId)) {
      $roleExists = $role->findById($data->roleId);

      if (is_null($roleExists)) {
        throw new Exception("Role não existe", 404);
      }
    }

    $sql = "insert into " . $this->table . " (name,email,password,document,phone,cep,address,district,city,uf,latitude,longitude,roleId) values ('" . $data->name . "', '" . $data->email . "', '" . hash("sha512", $data->password) . "', '" . $data->document . "', '" . $data->phone . "', '" . $data->cep . "', '" . $data->address . "', '" . $data->district . "', '" . $data->city . "', '" . $data->uf . "', " . $data->latitude . ", " . $data->longitude . ", " . $data->roleId . ")";

    return $this->connection->query($sql);
  }

  public function update($id, $data)
  {
    $role = new Role();
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Usuário não encontrado", 404);
    }

    $sql = "update " . $this->table . " set";

    if (isset($data->name)) $sql .= " name='" . $data->name . "',";
    if (isset($data->email)) $sql .= " email='" . $data->email . "',";
    if (isset($data->document)) $sql .= " document='" . $data->document . "',";
    if (isset($data->phone)) $sql .= " phone='" . $data->phone . "',";
    if (isset($data->cep)) $sql .= " cep='" . $data->cep . "',";
    if (isset($data->address)) $sql .= " address='" . $data->address . "',";
    if (isset($data->district)) $sql .= " district='" . $data->district . "',";
    if (isset($data->city)) $sql .= " city='" . $data->city . "',";
    if (isset($data->uf)) $sql .= " uf='" . $data->uf . "',";
    if (isset($data->latitude)) $sql .= " latitude=" . $data->latitude . ",";
    if (isset($data->longitude)) $sql .= " longitude=" . $data->longitude . ",";
    if (isset($data->roleId)) {
      $roleExists = $role->findById($data->roleId);

      if (is_null($roleExists)) {
        throw new Exception("Role não existe", 404);
      }

      $sql .= " roleId=" . $data->roleId . ",";
    }

    $sql = substr($sql, 0, -1);

    return $this->connection->query($sql . " where id = $id");
  }

  public function delete($id)
  {
    $exists = $this->findById($id);

    if (is_null($exists)) {
      throw new Exception("Usuário não encontrado", 404);
    }

    $sql = "delete from " . $this->table . " where id = $id";
    return $this->connection->query($sql);
  }
}
