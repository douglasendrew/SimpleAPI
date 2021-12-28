<?php

    // --
    // Classe utilizada para inciar as funções da API.
    // @author Douglasendrew
    // --

    namespace Core;

    use Core\Requisicao;
    use Routes\Rotas;

    class Run
    {

        public static $body;

        public static function init($body)
        {

            self::$body = $body;
            $auth = new Requisicao();

            if ($auth->auth() == false) {

                $return = json_encode(array("error" => true, "message" => "A autenticacao na API falhou", "response" => $auth->auth()));
                echo $return;
                exit;
            } else 
            {

                // Pegar a url atual
                $url = $_SERVER['REQUEST_URI'];

                // Retirar qualquer tipo de caractere que possa causar SQL Injection
                $caracteres = array("'", '"');
                $url = str_replace($caracteres, "", $url);

                // Dividir a url em partes
                $url = explode("/", $url);

                // Legenda atual:
                // $url[2] -> Módulo
                // $url[3] -> Tipo da requisição que está sendo enviada
                // $url[4] -> Método
                $modulo = $url[2];
                $requisicao = $url[3];
                $metodo = $url[4];

                $tipo_requisicao = $_SERVER['REQUEST_METHOD'];

                if (!isset($modulo)) {

                    $json = array("error" => true, "message" => "O módulo da requisição não foi encontrado", "response" => []);
                    echo json_encode($json);
                    return false;
                    exit;

                } else 
                {

                    if (!isset($requisicao)) {

                        $json = array("error" => true, "message" => "O tipo de requisicao nao foi encontrado", "response" => []);
                        echo json_encode($json);
                        return false;
                        exit;

                    } else 
                    {

                        if (!isset($metodo)) {

                            $json = array("error" => true, "message" => "O método de requisição não foi encontrado", "response" => []);
                            echo json_encode($json);
                            return false;
                            exit;

                        } else 
                        {

                            // Se chegou até aqui quer dizer que a url está montada corretamente,
                            // agora só é necessário saber se os dados fornecidos são válidos.
                            // Verificar se o tipo de requisição é válido
                            if (strtolower($requisicao) == "post" or  strtolower($requisicao) == "get") {

                                if (strtolower($tipo_requisicao) != strtolower($requisicao)) {
                                    
                                    $json = array("error" => true, "message" => "Requisição HTTP não compatível", "response" => []);
                                    echo json_encode($json);
                                    return false;
                                    exit;

                                }

                                $nome_strlower = strtolower($modulo);
                                $diretorio = __DIR__ . "/../Methods/" . $nome_strlower . "/" . $metodo . ".php";
                                // Verificar se o método existe
                                if (file_exists($diretorio)) {

                                    // Ao criar metodos, deverá ser criado um arquivo com o nome exato 
                                    // do metodo utilizado no link.
                                    
                                    $rota = $modulo."/".$metodo;

                                    if(Rotas::get($rota) == $tipo_requisicao)
                                    {

                                        require __DIR__ . "/../Methods/" . $nome_strlower . "/" . $metodo . ".php";
                                        

                                    }else
                                    {

                                        if(Rotas::get($rota) == false)
                                        {
                                            $json = array("error" => true, "message" => "Rota não encontrada, favor verificar se todas rotas estão setadas corretamente.", "response" => []);
                                            echo json_encode($json);
                                            return false;
                                            exit;
                                        }

                                    }   

                                } else 
                                {

                                    $json = array("error" => true, "message" => "O método informado nao foi encontrado, entre em contato com nosso suporte.", "response" => []);
                                    echo json_encode($json);
                                    return false;
                                    exit;

                                }

                            } else 
                            {

                                $json = array("error" => true, "message" => "O método de requisição informado não pode ser usado no momento.", "response" => []);
                                echo json_encode($json);
                                return false;
                                exit;
                                
                            }
                        }
                    }
                }
            }
        }
    }
