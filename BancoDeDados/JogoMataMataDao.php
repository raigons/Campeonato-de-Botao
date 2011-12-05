<?php
/**
 * Insere um novo jogo na fase de mata-matas
 *
 * @author RAMONox
 */
 require_once("JogoDao.php");
class JogoMataMataDao extends JogoDao{
    private $iniJogoComp = "(:fase, :campeonato, :grupoTime1, :grupoTime2)";
    private $iniJogoSimple = "(:fase, :campeonato)";

    public function JogoMataMataDao(){
        parent::JogoDao();
    }
    public function getSqlMore(){
        return $this->iniJogoComp;
    }
    public function getSqlMoreSimple(){
        return $this->iniJogoSimple;
    }
    public function iniciaMataMata($sqlMore, $fase, $campeonato, $grupoT1 = '', $grupoT2 = ''){
        $bd = parent::getConexaoBanco();
        if($grupoT1 != '' && $grupoT2 != ''){
            $sql = "INSERT INTO jogo_matamata (fase, idCampeonato, grupoTime1, grupoTime2) " . $sqlMore;
            $query = $bd->prepare($sql);
            $query->bindParam(':fase', $fase);
            $query->bindParam(':campeonato', $campeonato);
            $query->bindParam(':grupoTime1', $grupoT1);
            $query->bindParam(':grupoTime2', $grupoT2);
        }else{
            $sql = "INSERT INTO jogo_matamata (fase, idCampeonato) " . $sqlMore;
            $query = $bd->prepare($sql);
            $query->bindParam(':fase', $fase);
            $query->bindParam(':campeonato', $campeonato);
        }        
       // echo $sql . ", $fase, $campeonato";
        $query->execute();
        return $bd->lastInsertId();
    }
    public function setTimeJogoMataMata($i, $time, $grupo, $fase, $campeonato){
        $bd = parent::getConexaoBanco();
        $sql = "UPDATE jogo_matamata SET time".$i." = :time WHERE grupoTime".$i." = :grupo
        AND fase = :fase AND idCampeonato = :campeonato";
        $query = $bd->prepare($sql);
        $query->bindParam(':time', $time);
        $query->bindParam(':grupo', $grupo);
        $query->bindParam(':fase', $fase);
        $query->bindParam(':campeonato', $campeonato);
        $query->execute();
    }
    public function setNovoJogoMataMata($jogo, $campeonato){
        $bd = parent::getConexaoBanco();
        $sql = "INSERT INTO jogo_matamata (time1, time2, fase, campeonato) VALUES(:time1, :time2,:fase,:campeonato)";
        $query = $bd->prepare($sql);
        $query->bindParam(':time1', $jogo->getTime1());
        $query->bindParam(':time2', $jogo->getTime2());
        $query->bindParam(':fase', $jogo->getFase());
        $query->bindParam(':campeonato', $campeonato);
        $query->execute();
    }
    public function setPlacarJogoMataMata($time1, $time2, $golTime1, $golTime2, $idJogo, $faseJogo, $campeonato, $tipo){
        $bd = parent::getConexaoBanco();
        $sql = "UPDATE jogo_matamata SET golTime1 = :golTime1, golTime2 = :golTime2 WHERE id = :id AND fase = :fase";
        $query = $bd->prepare($sql);
        $query->bindParam(':golTime1', $golTime1);
        $query->bindParam(':golTime2', $golTime2);
        $query->bindParam(':id', $idJogo);
        $query->bindParam(':fase', $faseJogo);        
        $query->execute();
        if($query->rowCount() > 0){
            if($faseJogo != 3){
                $faseJogo += 1;
                $this->classificaTime($bd, $golTime1, $golTime2, $time1, $time2, $idJogo, $faseJogo, $campeonato, $tipo);
            }else{
                //por enquanto nada
            }
            return 1;
        }else{
            return 0;
        }
    }
    public function getFases(){
        $bd = parent::getConexaoBanco();
        $sql = "SELECT * FROM fases ORDER BY id ASC";
        $query = $bd->prepare($sql);    
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJogo($fase, $campeonato){
        $bd = parent::getConexaoBanco();
        $sql = "SELECT jogo_matamata.id AS idJogo, jogo_matamata.golTime1,
        jogo_matamata.golTime2, jogo_matamata.time1 AS idT1,
        jogo_matamata.time2 AS idT2, jogo_matamata.grupoTime1 AS gT1, jogo_matamata.grupoTime2 AS gT2
        FROM jogo_matamata
        WHERE jogo_matamata.fase = :fase AND idCampeonato = :campeonato";
        $query = $bd->prepare($sql);
        $query->bindParam(':fase', $fase);
        $query->bindParam(':campeonato', $campeonato);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /**     
     * @param <type> $golT1
     * Gol do time mandante
     * @param <type> $golT2
     * gols do time visitante
     * @param <type> $idT1
     * identificador do time mandante
     * @param <type> $idT2
     * identificador do time visitante
     * @param <int> $idJogo
     * identificador do jogo
     * @param <type> $fase
     * identificador da fase (quartas, semi ou final)
     * @param <type> $campeonato
     * identificador do campeonato
     * @param <type> $tipo
     * se classifica o time que será mandante ou visitante
     */
    private function classificaTime($bd, $golT1, $golT2, $idT1, $idT2, $idJogo, $fase, $campeonato, $tipo) {
        if($golT1 > $golT2) {
            $time = $idT1;
        }elseif($golT1 < $golT2) {
            $time = $idT2;
        }
        $sql2 = "UPDATE jogo_matamata SET time".$tipo." = :time
            WHERE grupoTime".$tipo." = :jogoAnt
            AND fase = :fase AND idCampeonato = :campeonato";
        $query2 = $bd->prepare($sql2);
        $query2->bindParam(':time', $time);
        $query2->bindParam(':jogoAnt', $idJogo);
        $query2->bindParam(':fase', $fase);
        $query2->bindParam(':campeonato', $campeonato);
        $query2->execute();
    }
}
?>
