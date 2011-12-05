<?php
/**
 * Classe de conexao com o banco de dados
 *
 * @author RAMONox
 */
require_once("BancoConfig.php");
class Conexao {  
    public static function Connect(){
        try{
            return new PDO("mysql:host=".BancoConfig::$host."; dbname=".BancoConfig::$dataBase."",BancoConfig::$user,BancoConfig::$pass);
        }catch(PDOException $e){
            echo "Não foi possível conectar ao Banco de Dados";
        }
    }
}
?>
