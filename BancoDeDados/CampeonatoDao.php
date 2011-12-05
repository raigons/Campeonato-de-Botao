<?php
/**
 * Armazena o campeonato no banco 
 *
 * @author RAMONox
 */
require_once("Conexao.php");
class CampeonatoDao {

    private $pdo;

    public function CampeonatoDao(){
        $this->pdo = Conexao::Connect();
    }
    public function isFinalizado($camp){
        $sql = "SELECT andamento FROM campeonato WHERE id = :id LIMIT 0,1";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $camp);
        $query->execute();        
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row['andamento'] == 0){
            return true;
        }else{
            echo false;
        }
    }
    public function finalizaCampeonato($campeonato) {
        $sql = "UPDATE campeonato SET andamento = 0 WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $campeonato);
        $query->execute();
        return $query->rowCount();
    }
    public function setNovoCampeonato($champ){
        $sql = "INSERT INTO campeonato (edicao) VALUES(:edicao)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':edicao', $champ->getCampeonato());
        $query->execute();
        $champ->setIdCampeonato($this->pdo->lastInsertId());
    }

    public function getCampeonatosAndamento(){
        $sql = "SELECT id, edicao AS nome FROM campeonato WHERE andamento = '1'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCampeonatosFinalizados(){
        $sql = "SELECT id, edicao AS nome FROM campeonato WHERE andamento = '0'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
