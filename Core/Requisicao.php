<?php 

    namespace Core;

    class Requisicao {

        public $token;
        public $usuario;
        public $client_id;

        public function __construct() {

            foreach (getallheaders() as $header => $value) {

                if ($header == "Token")
                {
                    $this->token = $value;
                }

                if ($header == "Usuario")
                {
                    $this->usuario = $value;
                }

                if ($header == "Client-Id")
                {
                    $this->client_id = $value;
                }
            }

            if( empty($this->token) or empty($this->usuario) or empty($this->client_id) )
            {

                $return = array("error" => true, "message" => "A autenticacao na API falhou");
                echo json_encode($return);
                return false;

            }else {

            }
            
        }

    }