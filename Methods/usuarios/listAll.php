<?php

    use Core\Conection;
    use Core\Requisicao;

    $pdo = Conection::init();
    $auth = new Requisicao();

    if ($auth->auth() == false) {

        $return = json_encode(array("error" => true, "message" => "Voce nao tem permissao para realizar essa ação", "response" => $auth->auth()));
        echo $return;
        exit;
        
    } else {

        $get_all = $pdo->prepare("SELECT * FROM usuarios");

        if($get_all->execute())
        {

            if($get_all->rowCount())
            {
            
                $retorno = array("error" => false, "message" => null, "response" => array());
                foreach ( $row = $get_all->fetchAll(PDO::FETCH_ASSOC) as $data )
                {

                    $nome = $data['nome'];
                    $email = $data['email'];
                    $senha = $data['senha'];
                    $id = $data['id'];
                    $requesting = array("id" => $id, "nome" => $nome, "email" => $email, "senha" => $senha);
                    array_push($retorno['response'], $requesting);

                }

                echo json_encode($retorno);
                return true;
                exit;

            }

        }else 
        {
            
            $returned = array("error" => true, "message" => "Nao foi possível executar a consulta");
            echo json_encode($returned);
            return false;
            exit;
 
        }

    }

?>