<?php
    function geraPagina($idPagina) {
        switch($idPagina){
            case 'principal':
		include "paginaPrincipal.php";
	    break;
            case 'novoCampeonato' :
                include 'paginaNovoCampeonato.php';
            break;
            case 'verCampeonato':
                include 'paginaCampeonato.php';
            break;
        }
    }
?>
