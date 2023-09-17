<?php

namespace sistema\Modelo;

use Exception;
use sistema\nucleo\Conexao;
class Crud{
    public function create(string $tabela, array $colunas, array $values):bool
    {
        if (count($colunas) !== count($values)) {
            return false; // Retorne falso se não houver correspondência.
        }
        $coluna = implode(", ", $colunas);
        $valores = implode(', ', array_fill(0, count($colunas), '?'));
        //(implode(', ', array_fill(0, count($colunas), '?'));)   são usados em consultas preparadas para indicar onde os valores reais devem ser inseridos na consulta. Quando você executa uma consulta preparada usando o método execute() o mecanismo do banco de dados substitui automaticamente esses marcadores de posição pelos valores reais que você fornece como parâmetros da consulta
        

        $query = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$valores}) ";

        try {
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($values);
            return true;
        } catch (Exception $e) {
            // Lide com qualquer exceção que possa ocorrer durante a execução da consulta.
            // Por exemplo, você pode registrar o erro ou lançar uma exceção personalizada.
            $_COOKIE = $e->getMessage();
        }
        return false;
    }

    public function update(string $tabela, array $colunas, array $values, string $onde):bool
    {

        //UPDATE `usuarios` SET `email` = 'joaol@gmail.com', `senha` = '12345' WHERE `usuarios`.`id` = 1;
        if (count($colunas) !== count($values)) {
            return false; // Retorne falso se não houver correspondência.
        }
        $valores = [];
        for($i = 0; $i<count($colunas); $i++){
            $valores = "{$colunas($i)} = '?' ";
        }
        $arrQuery = implode(", ", $valores);
        $query = "UPDATE {$tabela} SET {$arrQuery} {$onde} ";

        try {
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($values);
            return true;
        } catch (Exception $e) {
            // Lide com qualquer exceção que possa ocorrer durante a execução da consulta.
            // Por exemplo, você pode registrar o erro ou lançar uma exceção personalizada.
            return false;
        }

    }
    public function buscaEmailSenha(string $email,string $senha ): bool | object
    {
        $query = "SELECT * FROM usuarios where email = '{$email}' AND senha = '{$senha}'";
        try{
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetch();

            return $result;
        }catch(Exception $e){
            return false;
        }
        
    }
}