<?php
/**
 * Armazena e busca um jogo da fase de grupos
 *
 * @author RAMONox
 */
 require_once("JogoDao.php");
class JogoGrupoDao extends JogoDao{
    private $bd;
    public function JogoGrupoDao(){
        parent::JogoDao();
        $this->bd = parent::getConexaoBanco();
    }

    public function setNovoJogoGrupo($jogo){        
        $sql = "INSERT INTO jogo (time1, time2, grupo, rodada) VALUES(:time1,:time2,:grupo,:rodada)";
        $query = $this->bd->prepare($sql);
        $query->bindValue(':time1', $jogo->getTime1());
        $query->bindValue(':time2', $jogo->getTime2());
        $query->bindValue(':grupo', $jogo->getFase());
        $query->bindValue(':rodada', $jogo->getRodada());
        $query->execute();
    }
    public function setPlacarJogo($jogoId, $grupo, $golTime1, $golTime2){        
        $sql = "UPDATE jogo SET golTime1 = :golTime1, golTime2 = :golTime2 WHERE id = :id AND grupo = :grupo";
        $query = $this->bd->prepare($sql);
        $query->bindValue(':golTime1', $golTime1);
        $query->bindValue(':golTime2', $golTime2);
        $query->bindValue(':id', $jogoId);
        $query->bindValue(':grupo', $grupo);
        $query->execute();
        return $query->rowCount();
    }
    
    public function getJogosGrupo($grupo){        
        //$sql = "SELECT jogo.*, a.nome AS t1, b.nome AS t2 FROM jogo, time a, time b WHERE jogo.grupo = :grupo AND a.id = jogo.time1 AND b.id = jogo.time2";
        $sql = "SELECT jogo.id AS idJogo, a.nome As t1, a.escudo AS escudoT1, b.nome AS t2,
         b.escudo AS escudoT2, jogo.golTime1, jogo.golTime2, jogo.grupo AS idGrupo,
        jogo.rodada, grupo.grupo, jogo.time1 AS idT1, jogo.time2 AS idT2
        FROM jogo, time a, time b, grupo
        WHERE jogo.grupo = :grupo AND grupo.id = jogo.grupo AND a.id = jogo.time1 AND b.id = jogo.time2";
        $query = $this->bd->prepare($sql);  
        $query->bindValue(':grupo', $grupo);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJogo($idJogo, $idGrupo){
        $sql = "SELECT jogo.*, a.nome AS t1, b.nome AS t2 FROM jogo, time a, time b WHERE jogo.grupo = :grupo AND jogo.id = :idJogo AND a.id = jogo.time1 AND b.id = jogo.time2";
        $query = $this->bd->prepare($sql);
        $query->bindValue(':grupo', $idGrupo);
        $query->bindValue(':idJogo', $idJogo);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
?>
