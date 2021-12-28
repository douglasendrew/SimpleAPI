<?php

    require __DIR__ . "/../../vendor/autoload.php";

    // Classe de conexão
    use Core\Conection;

    use SimpleAPI\Body;

    // 
    // Caso precisar recuperar o Body, somente utilziar a variável self::$body.
    //

    $email = Body::body(self::$body)['email'];
    $senha = Body::body(self::$body)['senha'];
    $nome = Body::body(self::$body)['nome'];

    $pao = Conection::init()
        ->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");

    $pao->bindParam(1, $nome);
    $pao->bindParam(2, $email);
    $pao->bindParam(3, $senha);

    if ($pao->execute()) {

        $json = array("error" => false, "message" => "Usuario cadastrado com sucesso");
        echo json_encode($json);
        return false;
        exit;

    } else 
    {
        
        $json = array("error" => true, "message" => "Não foi possível inserir o usuário, tente novamente mais tarde", "response" => []);
        echo json_encode($json);
        return false;
        exit;

    }