<?php

class Connection
{
  protected $connection;
  private $servername = null;
  private $database = null;
  private $username = null;
  private $password = null;


  private function conectar()
  {
    $this->servername = is_null($_ENV['MYSQL_HOST']) ? "localhost" : $_ENV['MYSQL_HOST'];
    $this->username = is_null($_ENV['MYSQL_USER']) ? "root" : $_ENV['MYSQL_USER'];
    $this->password = is_null($_ENV['MYSQL_ROOT_PASSWORD']) ? "" : $_ENV['MYSQL_ROOT_PASSWORD'];
    $this->database = is_null($_ENV['MYSQL_DATABASE']) ? "toComFome" : $_ENV['MYSQL_DATABASE'];
    $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
  }

  public function __construct()
  {
    $this->conectar();
  }

  public function query($sql)
  {
    return $this->connection->query($sql);
  }

  function getConexao()
  {

    if (empty($this->connection)) {
      $this->conectar();
    }

    if (empty($this->connection) || ($this->connection->connect_errno)) {
      return "Falha na conexão: " . ' Erro Num: ' . $this->connection->connect_errno . ' - Mensagem: ' . mysqli_connect_error();
    }

    return "Você está conectado";
  }
}
