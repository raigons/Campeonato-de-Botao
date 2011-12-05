<?php

/**
 * Inicializa, atualiza e lê os dados da tabela de classificacao
 *
 * @author RAMONox
 */
require_once("Conexao.php");
class ClassificacaoDao {
    private $pdo;
    public function ClassificacaoDao(){
        $this->pdo = Conexao::Connect();
    }
    /**
     * Quando um campeonato é criado, inicializa a classificacao, com 0 e os times de cada grupo
     * @param <type> $grupo
     *  Objeto Grupo que está sendo iniciado
     */
    public function inicializaClassificao($grupo){
        $sql = "INSERT INTO classificacao (idGrupo, idTime) VALUES (:idGrupo, :idTime1),";
        $sql .= " (:idGrupo, :idTime2),(:idGrupo, :idTime3), (:idGrupo, :idTime4)";
        
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':idGrupo', $grupo->getIdGrupo());        
        $query->bindParam(':idTime1', $grupo->getTime1());
        $query->bindParam(':idTime2', $grupo->getTime2());
        $query->bindParam(':idTime3', $grupo->getTime3());
        $query->bindParam(':idTime4', $grupo->getTime4());
        $query->execute();
    }
    /**
     * Retorna a tabela de classificação de cada grupo, com as posições de cada time,
     * devidamente ordenada
     * @param <type> $grupo
     *  Id do Grupo que está sendo buscada a classificaçaõ
     * @return <type>
     * retorna a tabela do grupo do selecionado
     */
    public function getClassificacaoGrupo($grupo){
        $sql = "SELECT grupo.grupo, time.nome, ((classificacao.vitoria*3) + (classificacao.empate)) AS pontos,
         classificacao.vitoria, classificacao.empate, classificacao.derrota, classificacao.golsPro AS gp,
         classificacao.golsContra as gc, (classificacao.golsPro - classificacao.golsContra) as saldo,
        time.escudo FROM classificacao, grupo, time
        WHERE classificacao.idGrupo = :idGrupo AND grupo.id = classificacao.idGrupo
        AND time.id = classificacao.idTime ORDER BY pontos DESC, saldo DESC, golsPro DESC";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':idGrupo', $grupo);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Atualiza a classificação conforme o placar do jogo setado
     *
     * @param <type> $grupo
     *  Id do grupo que está sendo modificado
     * @param <type> $time
     * Time da casa
     * @param <type> $time2
     * Time fora de casa
     * @param <type> $golsT1
     * Gols do time da casa
     * @param <type> $golsT2
     * gols do time visitante
     * @param <type> $golsOldT1
     * Se o placar está sendo modificado, os gols que estavam armazenados anteriormente
     * @param <type> $golsOldT2
     * Idem ao $golsOldT1
     */
    public function atualizaClassificacao($grupo, $time, $time2, $golsT1, $golsT2, $golsOldT1 = '', $golsOldT2 = ''){
        session_start();
        $sql = "SELECT * FROM classificacao WHERE idGrupo = :grupo AND (idTime = :time1 OR idTime = :time2) LIMIT 0,2";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':grupo', $grupo);
        $query->bindParam(':time1', $time);
        $query->bindParam(':time2', $time2);
        $k = 1;
        $sql2 = "UPDATE classificacao SET golsPro = :golsPro, golsContra = :golsContra,
        vitoria = :vitoria, empate = :empate, derrota = :derrota
        WHERE idGrupo = :grupo AND idTime = :time";
        if($golsOldT1 != '' && $golsOldT2 != ''){
            $this->resetaClassificacao($grupo, $time, $time2, $golsOldT1, $golsOldT2, $sql2, $query);
        }
        $query->execute();
        $row2 = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($row2 as $classificacao){
            $vitoria = $classificacao['vitoria'];
            $derrota = $classificacao['derrota'];
            $empate  = $classificacao['empate'];
            $golsPro = $classificacao['golsPro'];
            $golsContra = $classificacao['golsContra'];
            if($classificacao['idTime'] == $time){
                if(($golsT1 - $golsT2) > 0){                                         
                    $vitoria += 1;
                }elseif(($golsT1 - $golsT2) == 0){                    
                    $empate += 1;
                }elseif(($golsT1 - $golsT2) < 0){                    
                    $derrota += 1;
                }
                $golsPro += $golsT1;
                $golsContra += $golsT2;
                $timeEdita = $time;
            }elseif($classificacao['idTime'] == $time2){
                if(($golsT2 - $golsT1) > 0){
                    $vitoria += 1;
                }elseif(($golsT2 - $golsT1) == 0){
                    $empate += 1;
                }elseif(($golsT2 - $golsT1) < 0){
                    $derrota += 1;
                }
                $golsPro += $golsT2;
                $golsContra += $golsT1;
                $timeEdita = $time2;
            }
            $query2 = $this->pdo->prepare($sql2);
            $query2->bindParam(':golsPro', $golsPro);
            $query2->bindParam(':golsContra', $golsContra);
            $query2->bindParam(':vitoria', $vitoria);
            $query2->bindParam(':empate', $empate);
            $query2->bindParam(':derrota', $derrota);
            $query2->bindParam(':grupo', $grupo);
            $query2->bindParam(':time', $timeEdita);
            $query2->execute();
            $k++;
        }
        $_SESSION['grupo'.$grupo] += 1; 
        echo $_SESSION['grupo'.$grupo];
        if($_SESSION['grupo'.$grupo] == 6){
            //se o grupo estiver finalizado, classifica-se os times
            $sqlClassificados = "SELECT grupo.idCampeonato,
            classificacao.idGrupo, classificacao.idTime,
            ((classificacao.vitoria*3) + (classificacao.empate)) AS pontos, classificacao.vitoria,
            classificacao.empate, classificacao.derrota, classificacao.golsPro AS gp,
            classificacao.golsContra as gc,
            (classificacao.golsPro - classificacao.golsContra) as saldo
            FROM classificacao, grupo, time
            WHERE classificacao.idGrupo = :grupo AND grupo.id = classificacao.idGrupo
            AND time.id = classificacao.idTime ORDER BY pontos DESC, saldo DESC,
            golsPro DESC LIMIT 0, 2";
            $q = $this->pdo->prepare($sqlClassificados);
            $q->bindParam(':grupo', $grupo);
            $q->execute();
            $classificados = $q->fetchAll(PDO::FETCH_ASSOC);
            echo sizeof($classificados);
            require_once("../Construcao/gerenciadores/GerenciaJogosMataMata.php");
            require_once("JogoMataMataDao.php");
            $gerenciaMataMata = new GerenciaJogosMataMata();
            $gerenciaMataMata->setClassificadosPrimeiraFase($classificados, 1);
        }
    }
    /**
     *  Caso o jogo já estivesse armazenado, e o placar esteja sendo modificado,
     * este método reseta a classificação retirando o placar que estava setado,
     * diminuindo os pontos, para que depois o grupo seja atualizado de acordo com
     * o novo placar
     * @param <type> $grupo
     * @param <type> $time
     * @param <type> $time2
     * @param <type> $golsOldT1
     * @param <type> $golsOldT2
     * @param <type> $sql
     * A SQL que reseta a tabela de classificação
     * @param <type> $query
     * O objeto PDO que retorna os dados do banco para realizar operação para atualizar o banco
     */
    private function resetaClassificacao($grupo, $time, $time2, $golsOldT1, $golsOldT2, $sql, $query){
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $classificacao){
            $vitoria = $classificacao['vitoria'];
            $derrota = $classificacao['derrota'];
            $empate  = $classificacao['empate'];
            $golsPro = $classificacao['golsPro'];
            $golsContra = $classificacao['golsContra'];
            if($classificacao['idTime'] == $time){
                if(($golsOldT1 - $golsOldT2) > 0){
                    $vitoria -= 1;
                }elseif(($golsOldT1 - $golsOldT2) == 0){
                    $empate -= 1;
                }elseif(($golsOldT1 - $golsOldT2) < 0){
                    $derrota -= 1;
                }
                $golsPro -= $golsOldT1;
                $golsContra -= $golsOldT2;
                $timeEdita = $time;
            }elseif($classificacao['idTime'] == $time2){
                if(($golsOldT2 - $golsOldT1) > 0){
                    $vitoria -= 1;
                }elseif(($golsOldT2 - $golsOldT1) == 0){
                    $empate -= 1;
                }elseif(($golsOldT2 - $golsOldT1) < 0){
                    $derrota -= 1;
                }
                $golsPro -= $golsOldT2;
                $golsContra -= $golsOldT1;
                $timeEdita = $time2;
            }
            $query2 = $this->pdo->prepare($sql);
            $query2->bindParam(':golsPro', $golsPro);
            $query2->bindParam(':golsContra', $golsContra);
            $query2->bindParam(':vitoria', $vitoria);
            $query2->bindParam(':empate', $empate);
            $query2->bindParam(':derrota', $derrota);
            $query2->bindParam(':grupo', $grupo);
            $query2->bindParam(':time', $timeEdita);
            $query2->execute();
        }
        $_SESSION['grupo'.$grupo] -= 1;
    }
}
?>
