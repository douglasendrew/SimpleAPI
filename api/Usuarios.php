<?php 

    namespace API;

    use Core\Requisicao;

    class Usuarios extends Requisicao {

        public static function list($requisicao)
        {
            $url = Requisicao::UrlGet();
            echo $url[2];
        }
    }
    

    if(Requisicao::UrlGet()[4] == "list")
    {
        echo file_get_contents('php://input');
        foreach (getallheaders() as $header => $value) {
            echo "$header: $value \n";
        }
    }

?>