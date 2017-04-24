<?php

/**
 * Classe usada para estabelecer ligação e gerir as ligações
 * a base de dados
 */
class Db{
// Hold the class instance.
  private static $instance = null;
  private $conn;

  private $host = '';
  private $user = '';
  private $pass = '';
  private $name = '';

// The db connection is established in the private constructor.
  private function __construct()
  {
    $host = '127.0.0.1';
    $db   = 'ponchaadvisor';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

  //Permite definir a configuração da base de dados
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";


    $opt = array(
  //Em caso de erro ocorre excepcao
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   
  //Define o comportamento por defeito do fetch
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  //Ativa/desativa emular prepared statements     
      PDO::ATTR_EMULATE_PREPARES   => false,                
      );
    $this->conn = new PDO($dsn, $user, $pass, $opt);   
  }

/**
 * Retorna a instancia unica da class DB,
 * @return DB instancia 
 */
public static function getInstance()
{
  if(!self::$instance){
    self::$instance = new Db();
  }

  return self::$instance;
}

/**
 * Retorna a ligação a base de dados
 *
 * @return     PDO Ligação a base de dados
 */
public function getConnection()
{
  return $this->conn;
}
}