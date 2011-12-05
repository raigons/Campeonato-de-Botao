<?php
/**
 * Insere ou busca time do banco
 *
 * @author RAMONox
 */
class TimeDao {
    private $pdo;
    public function TimeDao(){
        $this->pdo = Conexao::Connect();
    }
    public function getAllTeams(){
        $sql = "SELECT * FROM time ORDER BY nome ASC";
        $query = $this->pdo->prepare($sql);        
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTime($id){
        $sql = "SELECT * FROM time WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
