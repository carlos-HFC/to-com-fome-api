<?php
class Auth extends Connection
{
  public function login($data)
  {
    if (empty($data->email) || empty($data->password)) {
      throw new Exception("Não há dados para processar", 400);
    }

    $sql = "select u.id id, u.name name, u.email email, r.name role from user as u join role as r on r.id = u.roleId where email = '" . trim($data->email) . "' && password = '" . hash("sha512", $data->password) . "'";

    $exists = $this->connection->query($sql)->fetch_assoc();

    if (is_null($exists)) {
      throw new Exception("As credenciais estão incorretas", 400);
    }

    return $exists;
  }
}
