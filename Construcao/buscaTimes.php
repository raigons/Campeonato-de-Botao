<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../BancoDeDados/TimeDao.php");
    $times = new TimeDao();
    $json = "{'clube': [";
    $k = 0;
    foreach($times->getAllTeams() as $tms){
        //print_r($tms);
        if($k++ == 0)
            $json .= "{'id' : '".$tms['id']."', 'nome' : '".utf8_encode($tms['nome'])."', 'escudo': 'img/escudo/".$tms['escudo']."'}";
        else
            $json .= ",{'id' : '".$tms['id']."', 'nome' : '".utf8_encode($tms['nome'])."', 'escudo': 'img/escudo/".$tms['escudo']."'}";
    }
    $json .= "]}";
    echo $json;
?>
