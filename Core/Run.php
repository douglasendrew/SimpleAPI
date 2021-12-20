<?php

    // 
    // Estrutura do link:
    // /Módulo/TipoRequisição/Ação
    // 
    // Exemplo:
    // Produto/get/listAll
    // 

    // 
    // Como funciona?
    // 
    // O sistema verifica se todos parametros da url é válido,
    // apos isso, verifica se o metodo informado na url existe na pasta 'Methods' -> 'Respectivo Modulo' -> 'Metodo'
    // Caso existir, é dado um require no arquivo que está dentro da pasta 'api'.
    // 

    namespace Core;

    use Core\Requisicao;

    class Run
    {

        public static function init()
        {

            $auth = new Requisicao();

            if( $auth == false )
            {
                echo $auth;
                exit;

            }else {
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
    
                    $json = array("error" => true, "message" => "O modulo da requisicao nao foi encontrado", "response" => []);
                    echo json_encode($json);
                    return false;
                    exit;
    
                } else {
    
                    if (!isset($requisicao)) {
    
                        $json = array("error" => true, "message" => "O tipo de requisicao nao foi encontrado", "response" => []);
                        echo json_encode($json);
                        return false;
                        exit;
    
                    } else {
    
                        if (!isset($metodo)) {
    
                            $json = array("error" => true, "message" => "O metodo de requisicao nao foi encontrado", "response" => []);
                            echo json_encode($json);
                            return false;
                            exit;
            
                        } else {
            
                            // Se chegou até aqui quer dizer que a url está montada corretamente,
                            // agora só é necessário saber se os dados fornecidos são válidos.
            
                            // Validar o módulo
                            $diretorio = __DIR__ . "/../api/". $modulo .".php";
    
                            // Verificar se o módulo existe
                            if( !file_exists($diretorio) )
                            {
    
                                $json = array("error" => true, "message" => "O modulo informado nao foi encontrado, entre em contato com nosso suporte.", "response" => []);
                                echo json_encode($json);
                                return false;
                                exit;
                                
                            }else {
    
                                // Verificar se o tipo de requisição é válido
                                if( strtolower($requisicao) == "post" or  strtolower($requisicao) == "get" )
                                {
    
                                    if(strtolower($tipo_requisicao) != strtolower($requisicao))
                                    {
                                        $json = array("error" => true, "message" => "Tipo de requisicao nao compativel", "response" => []);
                                        echo json_encode($json);
                                        return false;
                                        exit;
                                    }
                                    
                                    $nome_strlower = strtolower($modulo);
                                    $diretorio = __DIR__ . "/../Methods/". $nome_strlower ."/". $metodo .".php";
                                    // Verificar se o método existe
                                    if( file_exists($diretorio) )
                                    {
    
                                        // Ao criar metodos, deverá ser criado um arquivo com o nome exato 
                                        // do metodo.
                                        require __DIR__ . "/../Methods/". $nome_strlower ."/". $metodo .".php";
                                        
                                    }else {
    
                                        $json = array("error" => true, "message" => "O metodo informado nao foi encontrado, entre em contato com nosso suporte.", "response" => []);
                                        echo json_encode($json);
                                        return false;
                                        exit;
                                        
                                    }
    
                                } else {
    
                                    $json = array("error" => true, "message" => "O metodo de requisicao informado nao pode ser usado no momento.", "response" => []);
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
        
    }