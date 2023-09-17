<?php
namespace sistema\nucleo;
use PDO;
use PDOException;

class Conexao{
    private static $instancia;

    public static function getInstancia(): PDO
    {
        if(empty(self::$instancia)){

            try{
                self::$instancia = new PDO('mysql:host=localhost;port=3306;dbname=web', 'root','',[
                    //garante que o charset do PDO seja omesmodo banco de dados
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    //todo erro através da PDO será uma exceção
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    //converter qualquer resultado como um objeto anonimo
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    //garante que o mesmo nome das colunas do banco de dados seja utilizado
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]);
            }catch(PDOException $ex){
                die("erro de conexão: ".$ex->getMessage());
            }
        }
        return self::$instancia;
    }

    protected function __construct()
    {
        
    }

    private function __clone():void
    {

    }
}