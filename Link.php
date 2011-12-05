<?php
/*
 * Controla a exibição dos links de redirecionamento no sistema
 */

/*
 * @author RAMONox
 */
class Link {
    public static function getLink(){
        define('URL', str_replace("index.php", "", $_SERVER["PHP_SELF"])); // The base of site
        $codigo = str_replace(URL,"",$_SERVER['REQUEST_URI']);
        return $codigo;
    }
    public static function redirect($dir){        
        $array = array(       
        "novoCampeonato" => "novoCampeonato",
        "verCampeonato"  => "verCampeonato");       
        if(strpos($dir, "?") == 0 && $dir != '')
            return $array[$dir];
        elseif(strpos($dir, "?") > 0)
            return $array[substr($dir, 0, strpos($dir, "?"))];
        else
            return "principal";
    }
}
?>
