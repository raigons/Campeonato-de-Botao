<?php
/**
 * Insere um novo Grupo no banco de dados
 *
 * @author RAMONox
 */
require_once("Conexao.php");
class GrupoDao {
    private $pdo;

    public function GrupoDao(){
        $this->pdo = Conexao::Connect();
    }

    public function setNovoGrupo($grupo){
        $sql = "INSERT INTO grupo VALUES('', :grupo, :time1, :time2, :time3, :time4, :idCampeonato)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':grupo', $grupo->getNomeGrupo());
        $query->bindValue(':time1', $grupo->getTime1());
        $query->bindValue(':time2', $grupo->getTime2());
        $query->bindValue(':time3', $grupo->getTime3());
        $query->bindValue(':time4', $grupo->getTime4());
        $query->bindValue(':idCampeonato', $grupo->getIdCampeonato());
        $query->execute();
        $grupo->setIdGrupo($this->pdo->lastInsertId());
    }

    public function getGruposCampeonato($campeonato){
        $sql = "SELECT id FROM grupo WHERE idCampeonato = :idCampeonato";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':idCampeonato', $campeonato);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
