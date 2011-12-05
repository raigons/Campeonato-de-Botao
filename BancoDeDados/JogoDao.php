<?php
/**
 * Armazena um novo jogo no banco de dados
 *
 * @author RAMONox
 */
abstract class JogoDao {
    private $pdo;

    public function JogoDao(){
        $this->pdo = Conexao::Connect();
    }
    public function getConexaoBanco(){
        return $this->pdo;
    }
}
?>