<?php 

    namespace Core;

    use Core\Conection;

    class Requisicao {

        public $token;
        public $usuario;
        public $client_id;
        
        public function auth() {

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

                return false;
                
            }else {
                
                $pdo = Conection::init();

                $pesquisar_user = $pdo->prepare("SELECT * FROM users_api  WHERE client_id = ? AND usuario = ? AND token = ?");
                $pesquisar_user->bindParam(1, $this->client_id);
                $pesquisar_user->bindParam(2, $this->usuario);
                $pesquisar_user->bindParam(3, $this->token);
                
                if( $pesquisar_user->execute() )
                {

                    if( $pesquisar_user->rowCount() > 0 )
                    {

                        return true;

                    }else {

                        return false;

                    }

                }else {

                    return false;

                }

            }
            
        }

        public function getToken() 
        {
            return $this->token;
        }

        public function getUsuario() 
        {
            return $this->usuario;
        }

        public function getClientId() 
        {
            return $this->client_id;
        }

        public function requestEncode($client_id, $client_token)
        {
            
        }

    }