<?php

class Connection
{
  protected $connection;
  private $servername = "localhost";
  private $database = "toComFome";
  private $username = "root";
  private $password = "";


  private function conectar()
  {
    $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
  }

  public function __construct()
  {
    $this->conectar(); // se conecta ao instanciar a classe
  }

  public function query($sql)
  {
    return $this->connection->query($sql);
  }

  // function getConexao()
  // {

  //   if (empty($this->conexao)) {
  //     $this->conectar(); // se conecta case ainda a conexão ainda não exista
  //   }

  //   if (empty($this->conexao) || ($this->conexao->connect_errno)) {
  //     die("Falha na conexão: " . ' Erro Num: ' . $this->conexao->connect_errno . ' - Mensagem: ' . mysqli_connect_error());
  //   }

  //   return $this->conexao;
  // }

  // function closeConexao()
  // {
  //   $status = false;
  //   if (isset($this->conexao)) {
  //     $status = mysqli_close($this->conexao);
  //   }

  //   return $status;
  // }
}
