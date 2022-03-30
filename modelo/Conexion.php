<?php
class Conexaion{
    private $servidor = "us-cdbr-east-05.cleardb.net";
    private $db = "heroku_f916182f849680f";
    private $puerto = "3306";
    private $charset = "utf8";
    private $usuario = "b26f3d5e91387e";
    private $contrasena = "93dca7a8";
    public $pdo = null;
    private $atributos = [PDO::ATTR_CASE=>PDO::CASE_LOWER,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
    function __construct(){
        $this->pdo= new PDO("mysql:dbname={$this->db};host={$this->servidor}; port={$this->puerto};charset{$this->charset}", $this->usuario,$this->contrasena, $this->atributos);
    }
}
?>
