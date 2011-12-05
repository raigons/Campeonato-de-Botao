<?php
/*
 *
 * @author RAMONox
 */
class GerenciaCampeonatos {

    private static $msg = "<span style='color: red; font-weight: bold'>Nenhum campeonato encontrado</span>";

    public static function getCampeonatosAndamento(){
        $campDao = new CampeonatoDao();
        $row = $campDao->getCampeonatosAndamento();
        $im = "";
        if(sizeof($row) == 0){
            $im = self::$msg;
        }
        foreach($row as $champ){
            //$im .= "<li id='".$champ['id']."'><a href='http://localhost/CampeonatoBotao/index.php?pagina=verCampeonato&campeonato=$champ[id]'>".($champ['nome'])."</a></li>";
            $im .= "<li id='".$champ['id']."'><a href='http://localhost/CampeonatoBotao/verCampeonato?campeonato=$champ[id]'>".($champ['nome'])."</a></li>";
        }
        return $im;
    }

    public static function getCampeonatosFinalizados(){
        $campDao = new CampeonatoDao();
        $row = $campDao->getCampeonatosFinalizados();
        $im = "";
        if(sizeof($row) == 0){
            $im = self::$msg;
        }else
            foreach($row as $champ){
                //$im .= "<li id='".$champ['id']."'><a href='http://localhost/CampeonatoBotao/index.php?pagina=verCampeonato&campeonato=$champ[id]'>".($champ['nome'])."</a></li>";
                $im .= "<li id='".$champ['id']."'><a href='http://localhost/CampeonatoBotao/verCampeonato?campeonato=$champ[id]'>".($champ['nome'])."</a></li>";
            }
        return $im;
    }
}
?>
